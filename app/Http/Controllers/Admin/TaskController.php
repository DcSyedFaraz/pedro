<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::with('jobs')->get();
        $user = User::withRole('User')->get();
        $manager = User::withRole('account manager')->get();
        $jobs = Job::whereNull('user_id')->get();
        $newjob = Job::get();

        // dd($task);
        return view('admin.task.index', compact('task','user','manager','jobs'));
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
        // dd($request);
        $job = Job::find($request->job_id);
        $job->user_id = $request->user_id;
        $job->save();


        Task::create([
            'job_id' => $request['job_id'],
            'manager_id' => $job->account_manager_id,
            'user_id' => $request['user_id'],
            'description' => $request['description'],
        ]);
        return redirect()->back()->with('success', 'Task Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $task = Task::find($id);
        $task->update($request->all());
        $job = Job::find($task->job_id);
        // dd($job);
        $job->user_id = $request->user_id;
        $job->save();
        return redirect()->back()->with('success', 'Task updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->back()->with('success', 'Task deleted successfully');
    }
}
