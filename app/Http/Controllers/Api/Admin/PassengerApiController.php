<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerApiController extends Controller
{
    /**
     * List all passengers for Admin
     */
    public function index(Request $request)
    {
        $query = Passenger::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $passengers = $query->latest()->paginate($request->get('per_page', 10));

        return response()->json([
            'status' => 'success',
            'data' => $passengers
        ]);
    }

    /**
     * Store new passenger
     */
    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers',
            'phone' => 'required|string|unique:passengers',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $passenger = Passenger::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'status' => 'active',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Passenger created successfully',
            'data' => $passenger
        ], 201);
    }

    /**
     * Show passenger detail
     */
    public function show($id)
    {
        $passenger = Passenger::with(['bookings'])->find($id);

        if (!$passenger) {
            return response()->json(['status' => 'error', 'message' => 'Passenger not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $passenger
        ]);
    }

    /**
     * Update passenger
     */
    public function update(Request $request, $id)
    {
        $passenger = Passenger::findOrFail($id);

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:passengers,email,' . $id,
            'phone' => 'sometimes|string|unique:passengers,phone,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $passenger->update($request->only(['first_name', 'last_name', 'email', 'phone']));

        if ($request->filled('password')) {
            $passenger->password = \Illuminate\Support\Facades\Hash::make($request->password);
            $passenger->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Passenger updated successfully',
            'data' => $passenger
        ]);
    }

    /**
     * Toggle Status
     */
    public function toggleStatus($id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->status = ($passenger->status === 'active' ? 'inactive' : 'active');
        $passenger->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Passenger status updated successfully',
            'data' => $passenger
        ]);
    }

    /**
     * Delete Passenger
     */
    public function destroy($id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Passenger deleted successfully'
        ]);
    }
}
