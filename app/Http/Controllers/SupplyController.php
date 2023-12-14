<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserNotification;
use App\Models\SupplyRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $user = auth()->user();
            if ($user->hasRole('Admin')) {
                $supply = SupplyRequest::orderBy('id', 'desc')->get();
                return view('supply.index', compact('supply'));

            } else {
                $supply = SupplyRequest::where('createdBy', $user->id)->get();
                return view('supply.index', compact('supply'));
            }


            // dd($add);


        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
            // view('invoice.index',  ['message' => $e->getMessage()]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supply.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        try {
            $rules = [
                'order_progress' => 'required|string|max:255',
                'order_date' => 'required|date',
                'po_num' => 'required|string|max:255',
                'manager_email' => 'required|email|max:255',
                'sent_date' => 'required|date',
                'receipt_status' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'street' => 'required|string|max:255',
                'apt' => 'required|string|max:255',
                'tampa' => 'required|string|max:255',
                'fl' => 'required|string|max:255',
                'num' => 'required|string|max:255',
                'item_name' => 'required|string|max:255',
                'qty' => 'required|integer',
                'job_assign' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ];

            $validatedData = $request->validate($rules);
            $validatedData['order_ref'] = Str::uuid()->toString();
            $validatedData['createdBy'] = auth()->user()->id;

            $supply = SupplyRequest::create($validatedData);

            $admin = User::find(1);
            $user = auth()->user();
            $message = "created an estimate request# {$supply->id}";
            $admin->notify(new UserNotification($user, $message));

            return redirect()->route('supply.index')->with('success', 'Supply Request Sent Successfully');
        } catch (\Exception $e) {
            // Handle the exception here
            // You can log the error, display an error message, or perform other error-handling tasks.
            // For example:
            return redirect()->back()->with('error', 'An error occurred while processing the supply request: ' . $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplyRequest = SupplyRequest::find($id);
        return view('supply.show', compact('supplyRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplyRequest = SupplyRequest::find($id);
        return view('supply.edit', compact('supplyRequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        try {
            $supply = SupplyRequest::find($id);

            if ($supply) {
                $request['order_ref'] = $supply->order_ref;
                $request['createdBy'] = $supply->createdBy;
                $supply->update($request->all());
                if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('account manager')) {

                    $admin = User::find($supply->createdBy);
                    $user = auth()->user();
                    $message = "updated a supply request# {$id}";
                    $admin->notify(new UserNotification($user, $message));
                } else {

                    $admin = User::find(1);
                    $user = auth()->user();
                    $message = "updated a supply request# {$id}";
                    $admin->notify(new UserNotification($user, $message));
                }
            } else {
                return redirect()->back()->with('error', 'An error occurred while finding the supply request: ');
            }

            return redirect()->route('supply.index')->with('success', 'Request Updated Successfully');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'An error occurred while processing the supply request: ' . $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $supply = SupplyRequest::find($id);
            $supply->delete();
            return redirect()->back()->with('error', 'Supply Request Deleted Successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred while processing the supply request: ' . $e->getMessage());
        }

    }
}
