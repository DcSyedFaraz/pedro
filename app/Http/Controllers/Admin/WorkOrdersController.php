<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        $technicians = Technicians::get();
        return view('admin.work_orders.create',compact('technicians'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'technician_id' => 'nullable',
        ]);

        WorkOrders::create($validatedData);
        return redirect()->route('work-orders.index')->with('success', 'Work order created successfully!');
    }

    public function show($id)
    {
        $workOrders = WorkOrders::findOrFail($id);
        return view('admin.work_orders.show', compact('workOrders'));
    }

    public function edit(WorkOrders $workOrder)
    {
        return view('admin.work_orders.edit', compact('workOrder'));
    }


    public function update(Request $request, $id)
    {
        $workOrder = WorkOrders::findOrFail($id);
        $workOrder->update($request->all());
        return redirect()->route('work-orders.index')->with('success', 'Work order updated successfully!');
    }
    public function destroy($id)
    {
        $workOrder = WorkOrders::findOrFail($id);
        $workOrder->delete();
        return redirect()->route('work-orders.index')->with('success', 'Work order deleted successfully!');
    }
   
}
