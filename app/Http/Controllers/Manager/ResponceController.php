<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\InspectionChecklist;
use App\Models\InspectionResponse;
use App\Models\Job;
use App\Models\Notes;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResponceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklists = InspectionChecklist::get();
        $show = Job::with('inspectionChecklists','inspectionResponse')->whereHas('workOrder', function ($query){
            $query->where('vendor_id', auth()->user()->id)->where('status','accepted');
        })->get();

// dd($show);
        // $location->inspectionChecklists()->sync($request->checklists);
        return view('manager.responce.index', compact('checklists', 'show'));
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

        try {
            DB::beginTransaction();

            foreach ($request['rating'] as $key => $value) {
                $criteria = [
                    'location_id' => $request['location_id'],
                    'checklist_id' => $request['checklist_id'][$key],
                    'checklist_item_id' => $request['checklist_item_id'][$key],
                ];

                $data = [
                    'rating' => $value,
                    'remarks' => $request['remarks'][$key],
                ];

                $some = InspectionResponse::updateOrCreate($criteria, $data);
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $file->getClientOriginalName() . Str::random(5) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('inspection', $fileName, 'public');
            }

            $job_id = $request['location_id'];
            $notes = ['notes' => $request['notes']];

            if (isset($path)) {
                $notes['file'] = $path;
            }

            Notes::updateOrcreate(
                ['job_id' => $job_id],
                $notes
            );

            DB::commit();

            return redirect()->back()->with('success', 'Responses submitted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return redirect()->back()->with('error', 'An error occurred. Please try again.'.$e->getMessage());
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
        $response = InspectionResponse::selectRaw('MAX(id) as id, checklist_id, MAX(rating) as rating, MAX(remarks) as remarks')->with('checklistItem', 'checklistItem.inspectionChecklist')
    ->where('location_id', $id)
    ->groupBy('checklist_id')
    ->get();
    $new = InspectionResponse::where('location_id', $id)->first();
// dd($response);
        return view('manager.responce.show', compact('response','new'));
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
