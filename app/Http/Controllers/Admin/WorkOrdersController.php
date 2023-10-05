<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use App\Models\WorkOrders;
use App\Models\Technicians;
use Carbon\Carbon;

class WorkOrdersController extends Controller
{
    public function index()
    {
        $WorkOrders = WorkOrders::get();

        return view('admin.work_orders.index', compact('WorkOrders'));
    }

    public function create()
    {
        $jobs = Job::all();
        $vendors = User::withRole('vendor')->get();
        return view('admin.work_orders.create',compact('jobs','vendors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'job_id' => 'required',
            'vendor_id' => 'required',
            'deadline' => 'required',
        ]);

        WorkOrders::create($validatedData);
        return redirect()->route('work_orders.index')->with('success', 'Work order created successfully!');
    }

    public function show($id)
    {
        $workOrders = WorkOrders::findOrFail($id);
        return view('admin.work_orders.show', compact('workOrders'));
    }

    public function edit(WorkOrders $workOrder)
    {
        $jobs = Job::all();
        $vendors = User::withRole('vendor')->get();
        return view('admin.work_orders.edit', compact('workOrder','jobs','vendors'));
    }


    public function update(Request $request, $id)
    {
        $workOrder = WorkOrders::findOrFail($id);

        // Check if vendor_id is being changed
        if ($workOrder->vendor_id != $request->input('vendor_id')|| $workOrder->job_id != $request->input('job_id')) {
            $request->merge(['status' => 'pending','payment_info' => '---']);
        }

        $workOrder->update($request->all());

        return redirect()->route('work_orders.index')->with('success', 'Work order updated successfully!');
    }
    public function destroy($id)
    {
        $workOrder = WorkOrders::findOrFail($id);
        $workOrder->delete();
        return redirect()->route('work_orders.index')->with('success', 'Work order deleted successfully!');
    }

}
