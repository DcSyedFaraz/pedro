<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::all();
        return view('admin.purchase_orders.index', compact('purchaseOrders'));
    }

    public function create()
    {
        return view('admin.purchase_orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier' => 'required|integer', // assuming you have a suppliers table
            'order_ref' => 'required|integer',
            'order_progress' => 'required|string|in:Open,Close',
            'payment_term' => 'required|string|in:Paypal,Stripe', // or other payment terms
            'order_date' => 'required|date',
            'sender' => 'required|string|in:Not Sent,Self',
            'memo_id' => 'required|integer',
            'ship_option' => 'required|string|max:255',
            'sent_date' => 'required|date',
            'receipt_status' => 'required|string|in:Not Received,Received',
            'direct_shipping' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'apt' => 'nullable|string|max:255',
            'tampa' => 'required|string|max:255',
            'fl' => 'required|string|max:255',
            'num' => 'required|string|max:255',
            'item_name.*' => 'required|string|max:255',
            'qty.*' => 'required|integer',
            'unit_price.*' => 'required|numeric',
            'total.*' => 'required|numeric',
            'jobs_id.*' => 'nullable|string|max:255',
            'receipt.*' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // Assuming you are creating a PurchaseOrder
        $purchaseOrder = PurchaseOrder::create([
            'supplier' => $request->supplier,
            'order_ref' => $request->order_ref,
            'order_progress' => $request->order_progress,
            'payment_term' => $request->payment_term,
            'order_date' => $request->order_date,
            'sender' => $request->sender,
            'memo_id' => $request->memo_id,
            'ship_option' => $request->ship_option,
            'sent_date' => $request->sent_date,
            'receipt_status' => $request->receipt_status,
            'direct_shipping' => $request->direct_shipping,
            'location' => $request->location,
            'street' => $request->street,
            'apt' => $request->apt,
            'tampa' => $request->tampa,
            'fl' => $request->fl,
            'num' => $request->num,
            'description' => $request->description,
        ]);

        foreach ($request->item_name as $key => $itemName) {
            PurchaseOrderItem::create([
                'purchase_order_id' => $purchaseOrder->id,
                'item_name' => $itemName,
                'qty' => $request->qty[$key],
                'unit_price' => $request->unit_price[$key],
                'total' => $request->total[$key],
                'jobs_id' => $request->jobs_id[$key],
                'receipt' => $request->receipt[$key],
            ]);
        }
        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase Order created successfully');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('admin.purchase_orders.show', compact('purchaseOrder'));
    }

    public function edit(PurchaseOrder $purchaseOrder)
    {
        return view('admin.purchase_orders.edit', compact('purchaseOrder'));
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->update($request->all());
        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase Order updated successfully');
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase Order deleted successfully');
    }
}
