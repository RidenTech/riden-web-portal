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
        return response()->json(['status' => 'success', 'data' => $passengers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['status' => 'success', 'data' => []]);
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'status' => 'Active',
        ];

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('passengers/avatars', 'public');
        }

        Passenger::create($data);

        return response()->json(['status' => 'success', 'message' => 'Passenger added successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $passenger = Passenger::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $passenger]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $passenger = Passenger::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $passenger]);
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['password', 'avatar']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('passengers/avatars', 'public');
        }

        $passenger->update($data);

        return response()->json(['status' => 'success', 'message' => 'Passenger updated successfully.', 'data' => $passenger]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();

        return response()->json(['status' => 'success', 'message' => 'Passenger deleted successfully.']);
    }

    /**
     * Toggle the status of the passenger (Block/Unblock).
     */
    public function toggleStatus(string $id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->status = ($passenger->status == 'Active') ? 'inactive' : 'Active';
        
        // Instant Mobile Sync: Revoke tokens if blocked
        if ($passenger->status !== 'Active') {
            $passenger->tokens()->delete();
        }
        
        $passenger->save();

        $message = $passenger->status == 'Active' ? 'Passenger unblocked successfully.' : 'Passenger blocked successfully.';
        
        return response()->json(['status' => 'success', 'message' => $message]);
    }
}
