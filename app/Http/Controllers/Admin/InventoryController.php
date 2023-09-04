<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::get();
        return view('admin.inventory.index', compact('inventory'));
    }

    public function create()
    {
        return view('admin.inventory.create');
    }

    public function store(Request $request)
    {
        $inventory = Inventory::create($request->all());
        return redirect()->route('inventory.index')
            ->with('success', 'Inventory created successfully');
    }

    public function show(Inventory $Inventory)
    {
        return view('admin.inventory.show', compact('Inventory'));
    }

    public function edit(Inventory $Inventory)
    {
        return view('admin.inventory.edit', compact('Inventory'));
    }

    public function update(Request $request, Inventory $Inventory)
    {
        $Inventory->update($request->all());
        return redirect()->route('inventory.index')
            ->with('success', 'Inventory updated successfully');
    }

    public function destroy(Inventory $Inventory)
    {
        $Inventory->delete();
        return redirect()->route('inventory.index')
            ->with('success', 'Inventory deleted successfully');
    }
}
