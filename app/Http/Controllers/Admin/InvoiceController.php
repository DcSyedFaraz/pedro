<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::get();
        return view('admin.invoice.index', compact('invoice'));
    }

    public function create()
    {
        return view('admin.invoice.create');
    }

    public function store(Request $request)
    {
        
        $Invoice = Invoice::create($request->all());
        return redirect()->route('invoice.index')
            ->with('success', 'Invoice created successfully');
    }

    public function show(Invoice $Invoice)
    {
        return view('admin.invoice.show', compact('invoice'));
    }

    public function edit(Invoice $Invoice)
    {
        return view('admin.invoice.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $Invoice)
    {
        $Invoice->update($request->all());
        return redirect()->route('invoice.index')
            ->with('success', 'Invoice updated successfully');
    }

    public function destroy(Invoice $Invoice)
    {
        $Invoice->delete();
        return redirect()->route('invoice.index')
            ->with('success', 'Invoice deleted successfully');
    }
}
