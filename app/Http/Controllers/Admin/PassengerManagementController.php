<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PassengerManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passengers = Passenger::latest()->paginate(10);
        return view('admin.passenger.index', compact('passengers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.passenger.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female,Other',
        ]);

        Passenger::create([
            'unique_id' => 'RIDEN-P' . strtoupper(Str::random(6)),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'status' => 'Active',
        ]);

        return redirect()->route('admin.passenger.management')
            ->with('success', 'Passenger added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $passenger = Passenger::findOrFail($id);
        return view('admin.passenger.detail', compact('passenger'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $passenger = Passenger::findOrFail($id);
        return view('admin.passenger.edit', compact('passenger'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $passenger = Passenger::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email,' . $id,
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female,Other',
            'password' => 'nullable|string|min:8',
        ]);

        $data = $request->except(['password']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $passenger->update($data);

        return redirect()->route('admin.passenger.detail', $passenger->id)
            ->with('success', 'Passenger updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();

        return redirect()->route('admin.passenger.management')
            ->with('success', 'Passenger deleted successfully.');
    }

    /**
     * Toggle the status of the passenger (Block/Unblock).
     */
    public function toggleStatus(string $id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->status = ($passenger->status == 'Active') ? 'inactive' : 'Active';
        $passenger->save();

        $message = $passenger->status == 'Active' ? 'Passenger unblocked successfully.' : 'Passenger blocked successfully.';
        
        return redirect()->back()->with('success', $message);
    }
}
