<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\InspectionChecklist;
use App\Models\InspectionResponse;
use App\Models\Job;
use Illuminate\Http\Request;

class ResponceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Job::get();
        $checklists = InspectionChecklist::get();
        $show = Job::with('inspectionChecklists','inspectionResponse')->get();
        foreach ($show as $new) {
            $news = $new->inspectionChecklists;
        }
// dd($show);
        // $location->inspectionChecklists()->sync($request->checklists);
        return view('manager.responce.index', compact('locations', 'checklists', 'show', 'news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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


        foreach ($request['rating'] as $key => $value) {
            // Define the criteria for finding the record
            $criteria = [
                'location_id' => $request['location_id'],
                'checklist_id' => $request['checklist_id'][$key],
                'checklist_item_id' => $request['checklist_item_id'][$key],
            ];

            // Data to update or create
            $data = [
                'rating' => $value, // Assuming the field is named 'rating'
                'remarks' => $request['remarks'][$key],
            ];

            // Use updateOrCreate to either update an existing record or create a new one
            InspectionResponse::updateOrCreate($criteria, $data);
        }

        return redirect()->back()->with('success', 'Responses submitted successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = InspectionResponse::with('checklistItem','checklistItem.inspectionChecklist')->where('location_id',$id)->get();
        return view('manager.responce.show', compact('response'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
