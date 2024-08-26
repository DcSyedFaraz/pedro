<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Files;
use App\Models\Job;
use App\Models\JobLocation;
use App\Models\User;
use App\Models\WorkOrders;
use App\Notifications\UserNotification;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Str;

class VendorController extends Controller
{
    public function index()
    {
        $WorkOrders = WorkOrders::where('vendor_id', auth()->user()->id)
            ->whereNotIn('status', ['declined'])
            ->orderby('priority', 'asc')->get();
        // return $WorkOrders;
        return response()->json($WorkOrders, 200);
    }
    public function show($id)
    {
        $job = Job::with('workOrder.JobLocation')->findOrFail($id);
        return response()->json($job, 200);
    }
    public function acceptWorkOrder($id)
    {
        // Find the work order by ID
        $workOrder = WorkOrders::findOrFail($id);

        // Check if the work order exists and is in 'Pending' status
        if ($workOrder && $workOrder->status === 'pending') {
            // Update the status to 'Accepted'
            $workOrder->status = 'accepted';
            $workOrder->save();

            if ($workOrder->jobname) {
                $workOrder->jobname->current_status = 7;
                $workOrder->jobname->save();
            }
            // Notification
            $user = auth()->user();
            $admin = User::find(1);
            $message = "accepted the Work Order# {$id}";
            $admin->notify(new UserNotification($user, $message));
            return response()->json(['success' => true, 'message' => 'Work Order Accepted Successfully', 'workOrder' => $workOrder]);
        }
        return response()->json(['success' => false, 'message' => 'Work Order is not pending or not found']);

    }

    public function declineWorkOrder($id)
    {
        $workOrder = WorkOrders::findOrFail($id);

        if ($workOrder && $workOrder->status === 'pending') {
            $workOrder->status = 'declined';
            $workOrder->save();
            // Notification
            $user = auth()->user();
            $admin = User::find(1);
            $message = "declined the Work Order# {$id}";
            $admin->notify(new UserNotification($user, $message));
            return response()->json(['success' => true, 'message' => 'Work Order Declined Successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Work Order is not pending or not found']);

    }
    public function doc($id)
    {
        // Artisan::call('storage:link');
        $workOrders = WorkOrders::findOrFail($id);
        return response()->json($workOrders, 200);
    }

    public function upload(Request $request, $id)
    {
        $workOrders = WorkOrders::findOrFail($id);

        $request->validate([
            'files.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            // Adjust validation rules as needed
        ]);

        // Start a database transaction to ensure data consistency
        DB::beginTransaction();

        try {
            // Handle file uploads
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $fileName = Str::random(15) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('uploads/image', $fileName, 'public');

                    Files::create([
                        'job_id' => $workOrders->job_id,
                        'filename' => asset('storage/' . $path),
                    ]);
                }

            }

            // Save notes in the 'workorders' table
            $workOrders->note = $request->input('notes');
            $workOrders->save();

            // Commit the transaction
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Files uploaded and notes saved successfully.']);

        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            return response()->json(['success' => false, 'message' => 'An error occurred while uploading files and saving notes. ' . $e->getMessage()]);
        }
    }
    public function alert($id)
    {
        try {

            // Send SMS to the vendor about new work order
            $job = Job::select('customer_id', 'location_name')->where('id', $id)->with('customer')->first();
            if ($job != null) {
                $message1 = "On-the-way Jobsite Alert:
            Vendor is on the way for the job, location:{$job->location_name}. Please prepare for the service.
            ";
                // dd($job->customer->phone);
                if ($job->customer->phone != null) {

                    //$this->twilioService->sendSMS($job->customer->phone, $message1);
                }
                // Notification
                $user = auth()->user();
                $admin = User::find(1);
                $message = "is on-the-way jobsite alert for the job, location: '{$job->location_name}'.";
                $admin->notify(new UserNotification($user, $message));

                return response()->json(['success' => true, 'message' => 'Alert Sent successfully.']);

            } else {
                return response()->json(['success' => false, 'message' => 'Job Not Found.']);

            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => "Error sending alert $e"]);
        }
    }
    public function delete($id)
    {
        $file = Files::findOrFail($id);
        $file->delete();
        return redirect()->back()->with('error', 'File Deleted successfully.');
    }
    public function quick_pay($id)
    {
        $workOrder = WorkOrders::find($id);
        // dd(!$workOrder->payment_info != 'quick_pay');
        if ($workOrder && $workOrder->payment_info != 'quick_pay') {
            // Update the status to 'Accepted'
            $workOrder->payment_info = 'quick_pay';
            $workOrder->save();

            $user = auth()->user();
            $admin = User::find(1);
            $message = "applied for Quick Pay for Work Order# {$id}";
            $admin->notify(new UserNotification($user, $message));

            return response()->json(['success' => true, 'message' => "Successfully Applied For Quick Pay"]);
        } else {

            return response()->json(['success' => false, 'message' => "You Already Applied For Quick Pay"]);
        }

    }
    public function attendance($id)
    {
        $attendance = Attendance::where('work_orders_id', $id)->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return response()->json($attendance, 200);
    }
    public function attendanceStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'job' => 'required|exists:work_orders,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'address' => 'required|string',
        ]);

        $job = JobLocation::where('work_orders_id', $request->job)->first();
        $userLat = $request->latitude; // User's latitude
        $userLon = $request->longitude;

        $jobLat = $job->latitude;
        $jobLon = $job->longitude;

        $thresholdDistance = 30;

        $distance = $this->calculateDistance($userLat, $userLon, $jobLat, $jobLon);

        if ($distance <= $thresholdDistance) {
            $checkIn = Attendance::where('user_id', Auth::User()->id)
                ->where('work_orders_id', $request->job)
                ->where('attendance', 'checkIn')
                ->first();
            if ($checkIn) {
                $attendanceStatus = 'checkOut';

                $startDate = $checkIn->created_at;
                $endDate = Carbon::now();

                $diffInTime = $startDate->diff($endDate)->format('%H:%I:%S');
                // dd($diffInTime);
                $time = $diffInTime;
            } else {
                $time = '';
                $attendanceStatus = 'checkIn';

            }
            Attendance::create([
                "user_id" => Auth::User()->id,
                "address" => $request->address,
                "work_orders_id" => $request->job,
                "attendance" => $attendanceStatus,
                "duration" => $time,
            ]);

            return response()->json([
                'success' => true,
                'distance' => $distance,
                'message' => 'Attendance marked: User is within 30 meters.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'distance' => $distance,
                'message' => 'Attendance not marked: User is outside 30 meters.',
            ]);
        }
    }
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371e3;
        $φ1 = deg2rad($lat1);
        $φ2 = deg2rad($lat2);
        $Δφ = deg2rad($lat2 - $lat1);
        $Δλ = deg2rad($lon2 - $lon1);

        $a = sin($Δφ / 2) * sin($Δφ / 2) +
            cos($φ1) * cos($φ2) *
            sin($Δλ / 2) * sin($Δλ / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $R * $c;
        return $distance;
    }

}
