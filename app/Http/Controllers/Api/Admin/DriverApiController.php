<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverApiController extends Controller
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
     * Show driver detail
     */
    public function show($id)
    {
        $driver = Driver::with(['vehicle', 'bookings'])->find($id);

        if (!$driver) {
            return response()->json(['status' => 'error', 'message' => 'Driver not found'], 404);
        }

        return response()->json([
            'status' => 'success',
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
