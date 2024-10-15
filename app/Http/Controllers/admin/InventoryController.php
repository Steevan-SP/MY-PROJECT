<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\InventoryStoreRequest; // Make sure this request class exists and is properly set up
use App\Models\Inventory;
use App\Models\User;

class InventoryController extends Controller
{
    // Show the list of inventories
    public function index()
    {
        $inventories = Inventory::all(); // Fetch all inventories
        return view('admin.inventory.index', compact('inventories'));
    }

    // Show form to create a new inventory item
    public function create()
    {
        return view('admin.inventory.create');
    }

    // Store a new inventory item
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        $code = 'INV-' . strtoupper(uniqid());

        $inventory = new Inventory();
        $inventory->user_id = auth()->id(); // Using auth()->id() is more concise
        $inventory->item_name = $request->input('item_name');
        $inventory->quantity = $request->input('quantity');
        $inventory->code = $code;
        // Removed status assignment

        $inventory->save();

        return redirect()->route('inventory.index')->with('success', 'Inventory item added successfully.');
    }

    // Show details of a single inventory item
    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('admin.inventory.show', compact('inventory'));
    }

    // Show form to edit an existing inventory item
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('admin.inventory.edit', compact('inventory'));
    }

    // Update an existing inventory item
    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            // Removed status validation
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->item_name = $request->input('item_name');
        $inventory->code = $request->input('code');
        $inventory->quantity = $request->input('quantity');
        // No need to update status

        $inventory->save();

        return redirect()->route('inventory.index')->with('success', 'Inventory item updated successfully.');
    }

    // Delete an inventory item
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventory.index')->with('success', 'Inventory item deleted successfully.');
    }
}
