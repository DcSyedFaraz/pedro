<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobPrimaryContact;
use App\Models\User;
use App\Models\job_Category;
use App\Models\JobSubCategory;
use App\Models\job_priority_category;
use App\Models\job_source_category;
use App\Models\Task;
use File;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {

        $now = now();
        $next72Hours = now()->addHours(72);

        $job = Job::with('customer', 'job_category', 'job_prioirty')->whereNull('scheduled_at') // Change 'scheduled_at' to your actual column name
            ->orWhere(function ($query) use ($now, $next72Hours) {
                $query->where('scheduled_at', '>', $next72Hours);
                //   ->orWhere('due_at', '<', $now);
            })->get();
            $manager = User::withRole('account manager')->get();


        // $job = Job::with('customer','job_category','job_prioirty','job_source')->get();
        return view('admin.job.index', compact('job','manager'));
    }

    public function create()
    {
        $customer = User::withRole('customer')->get();
        $agent = User::withRole('agent')->get();
        $jobCategories = job_Category::get();
        $job_prioirty = job_priority_category::get();
        $job_source = job_source_category::get();

        return view('admin.job.create', compact('customer', 'jobCategories', 'job_prioirty', 'job_source', 'agent'));
    }

    public function store(Request $request)
    {
        // return $request;

        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust the validation rules as needed
        //     'document' => 'required|mimes:pdf,doc,docx', // Adjust the validation rules as needed
        // ]);



        $job = new Job();
        $job->name = $request->name;
        $job->customer_id = $request->customer_id;
        $job->first_name = $request->first_name;
        $job->last_name = $request->last_name;
        //Array Value
        $job->location_name = $request->location_name;
        $job->location_gated_property = $request->location_gated_property;
        $job->location_address = $request->location_address;
        $job->location_unit = $request->location_unit;
        $job->location_city = $request->location_city;
        $job->location_state = $request->location_state;
        $job->location_zipcode = $request->location_zipcode;
        $job->job_cat_id = $request->job_cat_id;
        $job->job_sub_cat_id = $request->job_sub_cat_id;
        $job->job_sub_description = $request->job_sub_description;
        $job->job_description = $request->job_description;
        $job->po_no = $request->po_no;
        $job->job_source = $request->job_source;
        $job->job_priority = $request->job_priority;
        $job->agent = $request->agent;
        // Job customer Fields
        $job->customer_homeowner = $request->customer_homeowner;
        $job->customer_unit_cordination = $request->customer_unit_cordination;
        //Job Picture

        if ($request->hasFile('image')) {
            $file = request()->file('image');
            $fileName = md5($file->getClientOriginalName() . time()) . "img." . $file->getClientOriginalExtension();
            $file->move('uploads/image/', $fileName);
            $image = asset('uploads/image/' . $fileName);
        }


        //Job document
        if ($request->hasFile('document')) {
            $file = request()->file('document');
            $fileName = md5($file->getClientOriginalName() . time()) . "doc." . $file->getClientOriginalExtension();
            $file->move('uploads/document/', $fileName);
            $document = asset('uploads/document/' . $fileName);
        }
        // Job Information
        //Job image
        $job->image = $image;
        //Job document
        $job->document = $document;
        $job->current_status = $request->current_status;
        $job->start_date = $request->start_date;
        $job->end_date = $request->end_date;
        $job->start_time = $request->start_time;
        $job->end_time = $request->end_time;
        $job->start_duration = $request->start_duration;
        $job->end_duration = $request->end_duration;
        $job->assigned_tech = $request->assigned_tech;
        $job->notify_tech_assign = $request->notify_tech_assign;
        $job->notes_for_tech = $request->notes_for_tech;
        $job->completion_notes = $request->completion_notes;
        $job->save();

        foreach ($request['phone'] as $key => $value) {
            JobPrimaryContact::create([
                'job_id' => $job->id,
                'phone' => $value,
                'ext' => $request['ext'][$key],
                'email' => $request['email'][$key],

            ]);
        }

        return redirect()->route('job.index')->with('success', 'Job Created successfully');
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('admin.job.show', compact('job'));
    }

    public function edit(Job $job)
    {
        $customer = User::withRole('customer')->get();
        $agent = User::withRole('agent')->get();
        $jobCategories = job_Category::get();
        $job_prioirty = job_priority_category::get();
        $job_source = job_source_category::get();
        // dd($job->jobPri);
        return view('admin.job.edit', compact('job', 'customer', 'jobCategories', 'job_prioirty', 'job_source', 'agent', ));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $job = Job::findOrFail($id);

        $job->customer_id = $request->customer_id;
        $job->name = $request->name;
        $job->first_name = $request->first_name;
        $job->last_name = $request->last_name;
        //Array Value
        $job->location_name = $request->location_name;
        $job->location_gated_property = $request->location_gated_property;
        $job->location_address = $request->location_address;
        $job->location_unit = $request->location_unit;
        $job->location_city = $request->location_city;
        $job->location_state = $request->location_state;
        $job->location_zipcode = $request->location_zipcode;
        $job->job_cat_id = $request->job_cat_id;
        $job->job_sub_cat_id = $request->job_sub_cat_id;
        $job->job_sub_description = $request->job_sub_description;
        $job->job_description = $request->job_description;
        $job->po_no = $request->po_no;
        $job->job_source = $request->job_source;
        $job->job_priority = $request->job_priority;
        $job->agent = $request->agent;
        // Job customer Fields
        $job->customer_homeowner = $request->customer_homeowner;
        $job->customer_unit_cordination = $request->customer_unit_cordination;
        //Job Picture




        //Job document

        // Job Information
        //Job image
        if ($request->image != null) {
            // Delete the old image if it exists
            if (File::exists(public_path($job->image))) {
                File::delete(public_path($job->image));
            }
// dd('hasfile');
            // Upload and store the new image
            $file = $request->file('image');
            $fileName = md5($file->getClientOriginalName() . time()) . "img." . $file->getClientOriginalExtension();
            $file->move('uploads/image/', $fileName);
            $job->image = asset('uploads/image/' . $fileName);
        } else {
            // dd('not hasfile');
            $job->image = $job['image'];
        }
        if ($request->document != null) {

            if ($request->hasFile('document')) {
                $file = request()->file('document');
                $fileName = md5($file->getClientOriginalName() . time()) . "doc." . $file->getClientOriginalExtension();
                $file->move('uploads/document/', $fileName);
                $job->document = asset('uploads/document/' . $fileName);
            }
        } else {
            $job->document = $job['document'];

        }
        //Job document
        $job->current_status = $request->current_status;
        $job->start_date = $request->start_date;
        $job->end_date = $request->end_date;
        $job->start_time = $request->start_time;
        $job->end_time = $request->end_time;
        $job->start_duration = $request->start_duration;
        $job->end_duration = $request->end_duration;
        $job->assigned_tech = $request->assigned_tech;
        $job->notify_tech_assign = $request->notify_tech_assign;
        $job->notes_for_tech = $request->notes_for_tech;
        $job->completion_notes = $request->completion_notes;
        $job->save();

        $ProductandService = JobPrimaryContact::where('job_id', $id)->get();

        if ($ProductandService->count() > 0) {
            // Delete all the primary contacts found
            foreach ($ProductandService as $ProductandServices) {
                $ProductandServices->delete();
            }
        }

        foreach ($request['phone'] as $key => $value) {
            JobPrimaryContact::create([
                'job_id' => $job->id,
                'phone' => $value,
                'ext' => $request['ext'][$key],
                'email' => $request['email'][$key],

            ]);
        }
        return redirect()->route('job.index')->with('success', 'Job updated successfully');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect()->route('job.index');
    }
    public function job_pri($id)
    {
        $job = JobPrimaryContact::findOrFail($id);
        $job->delete();
        return redirect()->back()->with('success', 'Primary Contact Deleted Successfully');
    }

    public function getSubcategories(Request $request)
    {
        $categoryId = $request->get('category_id');
        $subcategories = JobSubCategory::where('job_cat_id', $categoryId)->get();

        return response()->json($subcategories);
    }

    public function getSubDescription(Request $request)
    {
        $subcategoryId = $request->get('subcategory_id');

        $subDescription = JobSubCategory::where('job_cat_id', $subcategoryId)->first();
        return response()->json(['subdescription' => $subDescription ? $subDescription->description : '']);
    }

    public function TodaySchedule()
    {
        //today
        $today = now(); // Current date and time
        $startOfDay = $today->copy()->startOfDay()->format('Y-m-d'); // Today's start time
        $endOfDay = $today->copy()->endOfDay()->format('Y-m-d'); // Today's end time
        //Schedule Today
        $schedule_today = Job::whereBetween('start_date', [$startOfDay, $endOfDay])
            ->whereBetween('end_date', [$startOfDay, $endOfDay])
            ->get();

        return view('admin.job.schedule_today', compact('schedule_today'));
    }
    //48 hours
    public function Next48Hours()
    {
        //today
        $now = now(); // Current date and time
        $endOfNext48Hours = $now->copy()->addHours(48); // Today's end time

        //Schedule Today
        $next_48_hours = Job::whereBetween('start_date', [$now, $endOfNext48Hours])
            ->whereBetween('end_date', [$now, $endOfNext48Hours])
            ->get();

        return view('admin.job.next_48_hours', compact('next_48_hours'));
    }
    public function JobsNeedingScheduling()
    {

        $now = now(); // Current date and time
        // Jobs that need scheduling (start_date or end_date is null or in the past)
        $jobs_needing_scheduling = Job::where(function ($query) use ($now) {
            $query->whereNull('start_date')
                ->orWhere('start_date', '<=', $now);
        })
            ->orWhere(function ($query) use ($now) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '<=', $now);
            })->get();

        return view('admin.job.job_needing_scheduling', compact('jobs_needing_scheduling'));
    }

    public function JobsInProgress()
    {

        // Retrieve jobs in progress based on the current_status field
        $jobs_in_progress = Job::where('current_status', 7)->get();
        return view('admin.job.job_in_progress', compact('jobs_in_progress'));

    }

    public function JobsInCompleted()
    {

        //Retrieve completed jobs based on the current_status field
        $completed_jobs = Job::where('current_status', 9)->get();
        return view('admin.job.jobs_completed', compact('completed_jobs'));

    }
    public function job_assign(Request $request, $id)
    {

        $input = $request->all();


        $user = Job::with('task')->find($id);

        $user->update($input);
if($user->task != null){
            $task = Task::where('job_id',$id)->first();

            $task->manager_id = $user->account_manager_id;
            $task->save();
        }

        return redirect()->back()
                        ->with('success','Job Assigned Successfully');
    }
}
