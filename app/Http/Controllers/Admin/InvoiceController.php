<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\ProductandService;
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
        // return $request;
        $Invoice = Invoice::create([

            'drive_time' => $request['drive_time'],
            'labor_time' => $request['labor_time'],
            'payments_and_deposits_input' => $request['payments_and_deposits_input'],
            'amount_description' => $request['amount_description'],
            'amount' => $request['amount'],
            'note_to_cust' => $request['note_to_cust'],
        ]);

        foreach ($request['description'] as $key => $value) {
            ProductandService::create([
                'invoice_id' => $Invoice->id,
                'description' => $value,
                'warehouse' => $request['warehouse'][$key],
                'qty_hrs' => $request['qty_hrs'][$key],
                'rate' => $request['rate'][$key],
                'total' => $request['total'][$key],
                'cost' => $request['cost'][$key],
                'margin_tax' => $request['margin_tax'][$key],
            ]);
        }

        return redirect()->route('invoice.index')
            ->with('success', 'Invoice created successfully');
    }

    public function show(Invoice $Invoice)
    {
        return view('admin.invoice.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        return view('admin.invoice.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $Invoice)
    {
        // dd($request->id);
        $ProductandService = ProductandService::where('invoice_id', $Invoice->id)->get();

        if ($ProductandService->count() > 0) {
            // Delete all the primary contacts found
            foreach ($ProductandService as $ProductandServices) {
                $ProductandServices->delete();
            }
        }
        foreach ($request['description'] as $key => $value) {
            ProductandService::create([
                'invoice_id' => $Invoice->id,
                'description' => $value,
                'warehouse' => $request['warehouse'][$key],
                'qty_hrs' => $request['qty_hrs'][$key],
                'rate' => $request['rate'][$key],
                'total' => $request['total'][$key],
                'cost' => $request['cost'][$key],
                'margin_tax' => $request['margin_tax'][$key],
            ]);
        }
        $Invoice->drive_time = $request['drive_time'];
        $Invoice->labor_time = $request['labor_time'];
        $Invoice->payments_and_deposits_input = $request['payments_and_deposits_input'];
        $Invoice->amount_description = $request['amount_description'];
        $Invoice->amount = $request['amount'];
        $Invoice->note_to_cust = $request['note_to_cust'];
        $Invoice->save();
        
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
