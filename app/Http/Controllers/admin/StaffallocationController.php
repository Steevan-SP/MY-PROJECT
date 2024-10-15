<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\StaffAllocation;
use App\Models\User;

class StaffallocationController extends Controller
{
    public function index()
    {
        // Fetch staff allocations from the database
        $staff_allocations = StaffAllocation::all();
        
        // Count the number of staff allocations
        $allocation_count = $staff_allocations->count();
        
        // Pass staff allocations data and count to the view
        return view('admin.staff_allocation.index', [
            'staff_allocations' => $staff_allocations,
            'allocation_count' => $allocation_count
        ]);
    }

    public function create()
    {
        return view('admin.staff_allocation.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'staff_name' => 'required|string',
            'location' => 'required|string',
            'phone_number' => 'required|string',
        ]);

        // Create a new staff allocation record
        StaffAllocation::create([
            'user_id' => auth()->id(), // Assuming you're storing the logged-in user's ID
            'staff_name' => $validatedData['staff_name'],
            'location' => $validatedData['location'],
            'phone_number' => $validatedData['phone_number'],
        ]);

        // Redirect back or to a success page
        return redirect()->route('staff.index')->with('success', 'Staff allocation created successfully.');
    }


    public function destroy($id)
    {
        // Find the staff allocation by ID and delete it
        $staff_allocation = StaffAllocation::findOrFail($id);
        $staff_allocation->delete();

        // Redirect back with a success message
        return redirect()->route('staff.index')->with('success', 'Staff allocation deleted successfully.');
    }
}

