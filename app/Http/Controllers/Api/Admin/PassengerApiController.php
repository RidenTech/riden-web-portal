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
