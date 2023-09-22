<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Technicians;
use Carbon\Carbon;

class TechniciansController extends Controller
{
    public function index()
    {
        $technicians = Technicians::all();
        return view('admin.technicians.index', compact('technicians'));
    }

    public function create()
    {
        return view('admin.technicians.create');
    }

    public function store(Request $request)
    {
        Technicians::create($request->all());
        return redirect()->route('technicians.index');
    }

    public function show($id)
    {
        $technicians = Technicians::findOrFail($id);
        return view('admin.technicians.show', compact('technicians'));
    }

    public function edit($id)
    {
        $technicians = Technicians::findOrFail($id);
        return view('admin.technicians.edit', compact('technicians'));
    }

    public function update(Request $request, $id)
    {
        $technician = Technicians::findOrFail($id);
        $technician->update($request->all());
        return redirect()->route('technicians.index');
    }

    public function destroy($id)
    {
        $technician = Technicians::findOrFail($id);
        $technician->delete();
        return redirect()->route('technicians.index')->with('error', 'Technician Removed Successfully');
    }

}
