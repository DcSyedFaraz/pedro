<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\ProblemReporting;
use Illuminate\Http\Request;

class ProblemReportingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $problemReports = ProblemReporting::all();
        $job = Job::get();
        // return $problem;
        return view('admin.problem.index', compact('problemReports','job'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $job = Job::get();
        return view('admin.problem.create', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProblemReporting::create($request->all());
        return redirect()->route('problem.index')->with('success', 'New Report Created Successfully');
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
        return view('admin.problem.show', compact('problemReport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $problemReport = ProblemReporting::findOrFail($id);
        $job = Job::get();
        return view('admin.problem.edit', compact('problemReport','job'));
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
        $problemReport = ProblemReporting::findOrFail($id);
        $problemReport->update($request->all());
        return redirect()->route('problem.index')->with('success', 'Report Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $problemReport = ProblemReporting::findOrFail($id);
        $problemReport->delete();
        return redirect()->route('problem.index')->with('error', 'Report Deleted Successfully');
    }
}
