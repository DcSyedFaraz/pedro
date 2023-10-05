<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\CompanyDocuments;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = User::where('id', auth()->user()->id)->with('userdetail','files')->first();
        return view('vendor.profile.profile', compact('vendor'));
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
        // return $request;
        $this->validate($request, [
            'areas_of_work' => 'required',
            'services_performed' => 'required',
            // 'document.*' => 'file|mimes:pdf,doc,docx|max:2048',
        ]);

        $input = $request->all();
        $user = User::find($id);

        $profileData = [
            'areas_of_work' => $request->input('areas_of_work'),
            'services_performed' => $request->input('services_performed'),

        ];

        // Check if the user already has a profile; if not, create one
        $user->userdetail()->updateOrCreate(
            ['vendor_id' => $user->id],
            $profileData
        );
        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $file) {
                $fileName = Str::random(15) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('company_documents', $fileName, 'public');

                CompanyDocuments::create([
                    'vendor_id' => $user->id,
                    'filename' => $path,
                ]);
            }

        }
        return redirect()->back()->with('success', 'Files uploaded and deatiles saved successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = CompanyDocuments::findOrFail($id);
        $file->delete();
        return redirect()->back()->with('error', 'File Deleted successfully.');
    }
}
