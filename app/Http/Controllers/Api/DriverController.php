<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * List all drivers for Admin
     */
    public function index(Request $request)
    {
        $query = Driver::with(['vehicle']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $drivers = $query->latest()->paginate($request->get('per_page', 10));

        return response()->json([
            'status' => 'success',
            'data' => $drivers
        ]);
    }

    /**
     * Store new driver
     */
    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers',
            'phone' => 'required|string|unique:drivers',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $driver = Driver::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'status' => 'active',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Driver created successfully',
            'data' => $driver
        ], 201);
    }

    /**
     * Show driver detail
     */
    public function show($id)
    {
        $driver = Driver::with(['vehicle', 'bookings', 'receivedReviews'])->find($id);

        if (!$driver) {
            return response()->json(['status' => 'error', 'message' => 'Driver not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $driver
        ]);
    }

    /**
     * Update driver
     */
    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:drivers,email,' . $id,
            'phone' => 'sometimes|string|unique:drivers,phone,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $driver->update($request->only(['first_name', 'last_name', 'email', 'phone']));

        if ($request->filled('password')) {
            $driver->password = \Illuminate\Support\Facades\Hash::make($request->password);
            $driver->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Driver updated successfully',
            'data' => $driver
        ]);
    }

    /**
     * Toggle Status
     */
    public function toggleStatus($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->status = ($driver->status === 'active' ? 'inactive' : 'active');
        $driver->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Driver status updated successfully',
            'data' => $driver
        ]);
    }

    /**
     * Delete Driver
     */
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Driver deleted successfully'
        ]);
    }
}
