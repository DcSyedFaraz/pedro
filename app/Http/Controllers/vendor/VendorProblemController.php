<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\ProblemReporting;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $problemReports = ProblemReporting::where('createdBy', auth()->user()->id)->get();
        $job = Job::get();
        // return $problem;
        return view('vendor.problem.index', compact('problemReports', 'job'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $job = Job::whereHas('workOrder', function ($query) {
            $query->where('vendor_id', auth()->user()->id)->where('status', 'accepted');
        })->get();
        return view('vendor.problem.create', compact('job'));
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
            $request['createdBy'] = auth()->user()->id;
            ProblemReporting::create($request->all());
            return redirect()->route('userproblem.index')->with('success', 'New Report Created Successfully');
        } catch (QueryException $e) {
            return redirect()->route('userproblem.index')->with('error', 'An error occurred while creating the report: ' . $e->getMessage());
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
        $problemReport = ProblemReporting::findOrFail($id);
        return view('vendor.problem.show', compact('problemReport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {


            $problemReport = ProblemReporting::findOrFail($id);

            $job = Job::whereHas('workOrder', function ($query) {
                $query->where('vendor_id', auth()->user()->id)->where('status', 'accepted');
            })->get();
            ;


            return view('vendor.problem.edit', compact('problemReport', 'job'));
        } catch (\Exception $e) {


            return back()->with('error', 'An error occurred while retrieving the data: ' . $e->getMessage());
        }

    }



    public function update(Request $request, $id)
    {
        try {
            $problemReport = ProblemReporting::findOrFail($id);
            $problemReport->update($request->all());
            return redirect()->route('userproblem.index')->with('success', 'Report Updated Successfully');
        } catch (QueryException $e) {
            return redirect()->route('userproblem.index')->with('error', 'An error occurred while updating the report: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $problemReport = ProblemReporting::findOrFail($id);
            $problemReport->delete();

            DB::commit();

            return redirect()->route('userproblem.index')->with('success', 'Report Deleted Successfully');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('userproblem.index')->with('error', 'An error occurred while deleting the report: ' . $e->getMessage());
        }
    }

}
