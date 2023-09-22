<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChecklistItem;
use App\Models\Inspection;
use App\Models\InspectionChecklist;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklist = InspectionChecklist::get();
        return view('admin.inspection.inspection', compact('checklist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $checklist = InspectionChecklist::get();
        return view('manager.inspection.index', compact('checklist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'checklist_items' => 'array', // Ensure checklist_items is an array
    ]);

    // Create a new inspection checklist
    $inspectionChecklist = InspectionChecklist::create([
        'name' => $request->input('name'),
    ]);

    // Add checklist items to the inspection checklist
    $checklistItems = $request->input('checklist_items');
    foreach ($checklistItems as $itemText) {
        if (!empty($itemText)) { // Ensure the item is not empty
            $checklistItem = new ChecklistItem([
                'description' => $itemText,
            ]);
            $inspectionChecklist->checklistItems()->save($checklistItem);
        }
    }

    // Redirect back with a success message or to a different page
    return redirect()->route('checklists.create')->with('success', 'Checklist created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show(Inspection $inspection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inspection $inspection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ProductandService = ChecklistItem::where('inspection_checklist_id', $id)->get();

        if ($ProductandService->count() > 0) {
            // Delete all the primary contacts found
            foreach ($ProductandService as $ProductandServices) {
                $ProductandServices->delete();
            }
        }
        $job = InspectionChecklist::findOrFail($id);
        $job->delete();
        return redirect()->back()->with('error','Sheet deleted Successfully');
    }
}
