<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\ProductandService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        try {

            $user = auth()->user();
            if ($user->hasRole('Admin')) {

                $invoice = Invoice::where('status', 'unpaid')->with('service', 'unpaid')->get();
                $paid = Invoice::where('status', 'paid')->with('service', 'unpaid')->get();
                $recur = Invoice::where('status', 'recurring')->with('service', 'unpaid')->get();
                $all = Invoice::with('service', 'unpaid')->get();
                $add = ProductandService::sum('total');
                return view('invoice.index', compact('invoice', 'paid', 'recur', 'all', 'add'));

            } else {
                $invoice = Invoice::where('createdBy', $user->id)->where('status', 'unpaid')->with('service', 'unpaid')->get();
                $paid = Invoice::where('createdBy', $user->id)->where('status', 'paid')->with('service', 'unpaid')->get();
                $recur = Invoice::where('createdBy', $user->id)->where('status', 'recurring')->with('service', 'unpaid')->get();
                $all = Invoice::where('createdBy', $user->id)->with('service', 'unpaid')->get();
                $invoices = Invoice::where('createdBy', $user->id)->get();
                // $add = 0;
                // foreach ($invoices as $invoicess) {
                //     foreach ($invoicess->service as $some) {
                //         $add += $some->total;
                //     }
                // }
                return view('invoice.index', compact('invoice', 'paid', 'recur', 'all'));
            }


            // dd($add);


        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
            // view('invoice.index',  ['message' => $e->getMessage()]);
        }
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->hasRole('Admin')) {

            $job = Job::get();
        } else {

            $job = Job::whereHas('workOrder', function ($query) {
                $query->where('vendor_id', auth()->user()->id)
                    ->where('status', 'accepted');
                    })->get();

        }
        return view('invoice.create', compact('job'));
    }

    public function store(Request $request)
    {
        // return $request;
        $Invoice = Invoice::create([
            'createdBy' => auth()->user()->id,
            'job_id' => $request['job_id'],
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

    public function show($id)
    {
        $invoice = Invoice::with('service', 'job')->find($id);
        // dd($invoice);
        return view('invoice.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        return view('invoice.edit', compact('invoice'));
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
        $Invoice->createdBy = auth()->user()->id;
        $Invoice->status = $request['status'];
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
            ->with('error', 'Invoice deleted successfully');
    }
}
