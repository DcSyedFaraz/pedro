<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
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
        PurchaseOrder::create($request->all());
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
