<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estimate;
use App\Models\EstimatePrimaryContact;
use App\Models\Job;
use App\Models\User;
use App\Models\job_Category;
use App\Models\JobSubCategory;
use App\Models\job_priority_category;
use App\Models\job_source_category;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEstimate;


class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = now();
        $next72Hours = now()->addHours(72);
        $estimates = Estimate::with('customer', 'job_category', 'job_prioirty', 'job_source')->whereNull('scheduled_at') // Change 'scheduled_at' to your actual column name
            ->orWhere(function ($query) use ($now, $next72Hours) {
                $query->where('scheduled_at', '>', $next72Hours);
                //   ->orWhere('due_at', '<', $now);
            })->get();
        $jobs = Job::get();
        return view('admin.estimates.index', compact('estimates', 'jobs'));
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
        return view('admin.estimates.create', compact('customer', 'jobCategories', 'job_prioirty', 'job_source', 'job_img', 'job_doc', 'agent'));
    }

    public function store(Request $request)
    {
        // return $request;
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust the validation rules as needed
        //     'document' => 'required|mimes:pdf,doc,docx', // Adjust the validation rules as needed
        // ]);

        $job = new Estimate();
        $job->customer_id = $request->customer_id;
        $job->first_name = $request->first_name;
        $job->last_name = $request->last_name;
        $job->location_name = $request->location_name;
        $job->location_gated_property = $request->location_gated_property;
        $job->location_address = $request->location_address;
        $job->location_unit = $request->location_unit;
        $job->location_city = $request->location_city;
        $job->location_state = $request->location_state;
        $job->location_zipcode = $request->location_zipcode;
        $job->job_cat_id = $request->job_cat_id;
        $job->job_sub_cat_id = $request->job_sub_cat_id;
        $job->job_sub_description = $request->job_sub_description;
        $job->job_description = $request->job_description;
        $job->po_no = $request->po_no;
        $job->job_source = $request->job_source;
        $job->agent = $request->agent;
        // Job customer Fields
        $job->customer_homeowner = $request->customer_homeowner;
        $job->customer_unit_cordination = $request->customer_unit_cordination;
        //Job Picture



        if ($request->hasFile('image')) {
            $file = request()->file('image');
            $fileName = md5($file->getClientOriginalName() . time()) . "img." . $file->getClientOriginalExtension();
            $file->move('uploads/image/', $fileName);
            $image = asset('uploads/image/' . $fileName);
        }


        //Job document
        if ($request->hasFile('document')) {
            $file = request()->file('document');
            $fileName = md5($file->getClientOriginalName() . time()) . "doc." . $file->getClientOriginalExtension();
            $file->move('uploads/document/', $fileName);
            $document = asset('uploads/document/' . $fileName);
        }
        // Job Information
        //Job image
        $job->image = $image;
        //Job document
        $job->document = $document;
        $job->requested_on = $request->requested_on;
        $job->current_status = $request->current_status;
        $job->opportunity_rating = $request->opportunity_rating;
        $job->opportunity_owner = $request->opportunity_owner;
        $job->referral_source = $request->referral_source;
        $job->start_date = $request->start_date;
        $job->end_date = $request->end_date;
        $job->arrival_start = $request->arrival_start;
        $job->arrival_end = $request->arrival_end;
        $job->time_duration = $request->time_duration;
        $job->start_duration = $request->start_duration;
        $job->end_duration = $request->end_duration;
        $job->end_duration = $request->end_duration;
        $job->assigned_tech = $request->assigned_tech;
        $job->notify_tech_assign = $request->notify_tech_assign;
        $job->notes_for_tech = $request->notes_for_tech;
        $job->completion_notes = $request->completion_notes;
        $job->save();


        foreach ($request['phone'] as $key => $value) {
            EstimatePrimaryContact::create([
                'estimate_id' => $job->id,
                'phone' => $value,
                'ext' => $request['ext'][$key],
                'email' => $request['email'][$key],

            ]);
        }

        return redirect()->route('estimates.index')->with('success', 'Estimate Created Successfully');
    }
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'client_name'           => 'required',
    //         'total_amount'          => 'required|numeric',
    //         'valid_until'           => 'required|date',
    //     ]);

    //     $estimate = Estimate::create($data);

    //     Mail::to($request->input('client_email'))->send(new SendEstimate($estimate));
    //     return redirect()->route('estimates.index')->with('success', 'Estimate created successfully');
    // }

    public function edit(Estimate $estimate)
    {
        // dd($estimate->prim_cont);
        $customer = User::withRole('customer')->get();
        $agent = User::withRole('agent')->get();
        $jobCategories = job_Category::get();
        $job_prioirty = job_priority_category::get();
        $job_source = job_source_category::get();
        return view('admin.estimates.edit', compact('estimate', 'customer', 'jobCategories', 'job_prioirty', 'job_source', 'agent'));
    }

    public function update(Request $request, Estimate $estimate)
    {
        // return $request;
        $job = Estimate::findOrFail($estimate->id);
        $job->customer_id = $request->customer_id;
        $job->first_name = $request->first_name;
        $job->last_name = $request->last_name;
        $job->location_name = $request->location_name;
        $job->location_gated_property = $request->location_gated_property;
        $job->location_address = $request->location_address;
        $job->location_unit = $request->location_unit;
        $job->location_city = $request->location_city;
        $job->location_state = $request->location_state;
        $job->location_zipcode = $request->location_zipcode;
        $job->job_cat_id = $request->job_cat_id;
        $job->job_sub_cat_id = $request->job_sub_cat_id;
        $job->job_sub_description = $request->job_sub_description;
        $job->job_description = $request->job_description;
        $job->po_no = $request->po_no;
        $job->job_source = $request->job_source;
        $job->agent = $request->agent;
        // Job customer Fields
        $job->customer_homeowner = $request->customer_homeowner;
        $job->customer_unit_cordination = $request->customer_unit_cordination;
        //Job Picture
        //Job image
        if ($request->image != null) {
            // Delete the old image if it exists
            if (File::exists(public_path($job->image))) {
                File::delete(public_path($job->image));
            }
            // dd('hasfile');
            // Upload and store the new image
            $file = $request->file('image');
            $fileName = md5($file->getClientOriginalName() . time()) . "img." . $file->getClientOriginalExtension();
            $file->move('uploads/image/', $fileName);
            $job->image = asset('uploads/image/' . $fileName);
        } else {
            // dd('not hasfile');
            $job->image = $job['image'];
        }
        if ($request->document != null) {

            if ($request->hasFile('document')) {
                $file = request()->file('document');
                $fileName = md5($file->getClientOriginalName() . time()) . "doc." . $file->getClientOriginalExtension();
                $file->move('uploads/document/', $fileName);
                $job->document = asset('uploads/document/' . $fileName);
            }
        } else {
            $job->document = $job['document'];

        }

        $job->requested_on = $request->requested_on;
        $job->current_status = $request->current_status;
        $job->opportunity_rating = $request->opportunity_rating;
        $job->opportunity_owner = $request->opportunity_owner;
        $job->referral_source = $request->referral_source;
        $job->start_date = $request->start_date;
        $job->end_date = $request->end_date;
        $job->arrival_start = $request->arrival_start;
        $job->arrival_end = $request->arrival_end;
        $job->time_duration = $request->time_duration;
        $job->start_duration = $request->start_duration;
        $job->end_duration = $request->end_duration;
        $job->end_duration = $request->end_duration;
        $job->assigned_tech = $request->assigned_tech;
        $job->notify_tech_assign = $request->notify_tech_assign;
        $job->notes_for_tech = $request->notes_for_tech;
        $job->completion_notes = $request->completion_notes;
        $job->save();

        $ProductandService = EstimatePrimaryContact::where('estimate_id', $estimate->id)->get();

        if ($ProductandService->count() > 0) {
            // Delete all the primary contacts found
            foreach ($ProductandService as $ProductandServices) {
                $ProductandServices->delete();
            }
        }

        foreach ($request['phone'] as $key => $value) {
            EstimatePrimaryContact::create([
                'estimate_id' => $job->id,
                'phone' => $value,
                'ext' => $request['ext'][$key],
                'email' => $request['email'][$key],

            ]);
        }

        return redirect()->route('estimates.index')->with('success', 'Estimate updated successfully');
    }

    public function destroy(Estimate $estimate)
    {
        $estimate->delete();
        return redirect()->route('estimates.index')->with('success', 'Estimate deleted successfully');
    }
    public function est_pri($id)
    {
        $job = EstimatePrimaryContact::findOrFail($id);
        $job->delete();
        return redirect()->back()->with('success', 'Primary Contact deleted successfully');
    }

    public function updateSelectedJobs(Request $request)
    {
        $SelectJob = $request->selectedJobs;
        foreach ($SelectJob as $jobs) {
            $job = Job::where('id', $jobs)->first();
            $job->estimate_id = $request->estimate_id;
            $job->mark_description = $request->markDescription;
            $job->save();
        }
        return redirect()->route('estimates.index')->with('success', 'Job Selected Successfully');
    }
}
