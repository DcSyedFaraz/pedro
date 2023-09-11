<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
use App\Models\job_Category;
use App\Models\JobSubCategory;
use App\Models\job_priority_category;
use App\Models\job_source_category;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {

        $now = now();
        $next72Hours = now()->addHours(72);

        $job = Job::with('customer','job_category','job_prioirty','job_source')->whereNull('scheduled_at')  // Change 'scheduled_at' to your actual column name
            ->orWhere(function ($query) use ($now, $next72Hours) {
                $query->where('scheduled_at', '>', $next72Hours);
                    //   ->orWhere('due_at', '<', $now);
            })->get();


        // $job = Job::with('customer','job_category','job_prioirty','job_source')->get();
        return view('admin.job.index', compact('job'));
    }

    public function create()
    {
        $customer = User::withRole('customer')->get();
        $agent = User::withRole('agent')->get();
        $jobCategories = job_Category::get();
        $job_prioirty = job_priority_category::get();
        $job_source = job_source_category::get();
        $job_img = Job::count('image');
        $job_doc = Job::count('document');
        return view('admin.job.create',compact('customer','jobCategories','job_prioirty','job_source','job_img','job_doc','agent'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust the validation rules as needed
            'document' => 'required|mimes:pdf,doc,docx', // Adjust the validation rules as needed
        ]);

        $job =new Job();
        $job->customer_id                   = $request->customer_id;
        $job->first_name                    = $request->first_name;
        $job->last_name                     = $request->last_name;
        //Array Value
        $job->phone                         = $request->phone;
        $job->ext_id                        = $request->ext_id;
        $job->ext                           = $request->ext;
        $job->email                         = $request->email;
        $job->location_name                 = $request->location_name;
        $job->location_gated_property       = $request->location_gated_property;
        $job->location_address              = $request->location_address;
        $job->location_unit                 = $request->location_unit;
        $job->location_city                 = $request->location_city;
        $job->location_state                = $request->location_state;
        $job->location_zipcode              = $request->location_zipcode;
        $job->job_cat_id                    = $request->job_cat_id;
        $job->job_sub_cat_id                = $request->job_sub_cat_id;
        $job->job_sub_description           = $request->job_sub_description;
        $job->job_description               = $request->job_description;
        $job->job_source                    = $request->job_source;
        $job->job_priority                  = $request->job_priority;
        $job->agent                         = $request->agent;
        // Job customer Fields
        $job->customer_homeowner            = $request->customer_homeowner;
        $job->customer_unit_cordination     = $request->customer_unit_cordination;
        //Job Picture

        if($request->hasFile('image'))
        {
            $file = request()->file('image');
            $fileName = md5($file->getClientOriginalName() . time()) . "img." . $file->getClientOriginalExtension();
            $file->move('uploads/image/', $fileName);
            $image = asset('uploads/image/'.$fileName);
        }


        //Job document
        if($request->hasFile('document'))
			{
				$file = request()->file('document');
				$fileName = md5($file->getClientOriginalName() . time()) . "doc." . $file->getClientOriginalExtension();
				$file->move('uploads/document/', $fileName);
				$document = asset('uploads/document/'.$fileName);
			}
        // Job Information
        //Job image
        $job->image                         = $image;
        //Job document
        $job->document                       = $document;
        $job->current_status                = $request->current_status;
        $job->start_date                    = $request->start_date;
        $job->end_date                      = $request->end_date;
        $job->start_time                    = $request->start_time;
        $job->end_time                      = $request->end_time;
        $job->start_duration                = $request->start_time_duration;
        $job->end_duration                  = $request->end_time_duration;
        $job->assigned_tech                 = $request->assigned_tech;
        $job->notify_tech_assign            = $request->notify_tech_assign;
        $job->notes_for_tech                = $request->notes_for_tech;
        $job->completion_notes              = $request->completion_notes;
        $job->save();
        return redirect()->route('job.index');
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('admin.job.show', compact('job'));
    }

    public function edit($id)
    {
        $customer = User::get();
        $job_category = Job_Category::get();
        $job_prioirty = Job_priority_category::get();
        $job_source = Job_source_category::get();
        $job = Job::findOrFail($id);
        return view('admin.job.edit',compact('job','customer','job_category','job_prioirty','job_source'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $job->update($request->all());
        return redirect()->route('job.index');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect()->route('job.index');
    }

    public function getSubcategories(Request $request)
    {
        $categoryId = $request->get('category_id');
        $subcategories = JobSubCategory::where('job_cat_id', $categoryId)->get();

        return response()->json($subcategories);
    }

    public function getSubDescription(Request $request)
    {
        $subcategoryId = $request->get('subcategory_id');

        $subDescription = JobSubCategory::where('job_cat_id', $subcategoryId)->first();
        return response()->json(['subdescription' => $subDescription ? $subDescription->description : '']);
    }

    public function TodaySchedule(){
        //today
        $today = now(); // Current date and time
        $startOfDay = $today->copy()->startOfDay()->format('Y-m-d'); // Today's start time
        $endOfDay = $today->copy()->endOfDay()->format('Y-m-d'); // Today's end time
        //Schedule Today
        $schedule_today = Job::whereBetween('start_date', [$startOfDay, $endOfDay])
        ->whereBetween('end_date', [$startOfDay, $endOfDay])
        ->get();

        return view('admin.job.schedule_today',compact('schedule_today'));
    }
    //48 hours
    public function Next48Hours(){
        //today
        $now = now(); // Current date and time
        $endOfNext48Hours = $now->copy()->addHours(48); // Today's end time

        //Schedule Today
        $next_48_hours = Job::whereBetween('start_date', [$now, $endOfNext48Hours])
        ->whereBetween('end_date', [$now, $endOfNext48Hours])
        ->get();

        return view('admin.job.next_48_hours',compact('next_48_hours'));
    }
    public function JobsNeedingScheduling(){

        $now = now(); // Current date and time
        // Jobs that need scheduling (start_date or end_date is null or in the past)
        $jobs_needing_scheduling = Job::where(function ($query) use ($now) {
            $query->whereNull('start_date')
                ->orWhere('start_date', '<=', $now);
        })
        ->orWhere(function ($query) use ($now) {
            $query->whereNull('end_date')
                ->orWhere('end_date', '<=', $now);
        })->get();

        return view('admin.job.job_needing_scheduling',compact('jobs_needing_scheduling'));
    }

    public function JobsInProgress(){

        // Retrieve jobs in progress based on the current_status field
        $jobs_in_progress = Job::where('current_status',7)->get();
        return view('admin.job.job_in_progress',compact('jobs_in_progress'));

    }

    public function JobsInCompleted(){

        //Retrieve completed jobs based on the current_status field
        $completed_jobs = Job::where('current_status',9)->get();
        return view('admin.job.jobs_completed',compact('completed_jobs'));

    }
}
