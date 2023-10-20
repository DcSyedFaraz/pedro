<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Estimate;
use App\Models\Job;
use Illuminate\Http\Request;

class userEstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $job = Estimate::where('customer_id', $user->id)->get();
// dd($job);
    return view('users.job.estimate', compact('job'));

    }
    public function accept($id)
    {
        // Find the work order by ID
        $estimate = Estimate::find($id);
        // dd($estimate);
        // Check if the work order exists and is in 'Pending' status
        if ($estimate && $estimate->client_status === 'pending') {
            // Update the status to 'Accepted'
            // dd('d');
            $estimate->client_status = 'accepted';
            $estimate->save();
        }

        return redirect()->back()->with('success', 'Estimate Accepted Successfully');
    }

    public function decline($id)
    {
        $estimate = Estimate::find($id);

        if ($estimate && $estimate->client_status === 'pending') {
            // Update the status to 'Accepted'
            $estimate->client_status = 'declined';
            $estimate->save();
        }

        return redirect()->back()->with('warning', 'Estimate Declined Successfully');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Estimate::findOrFail($id);
        return view('users.job.show', compact('job'));
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
