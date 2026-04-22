<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    /**
     * List all bookings for Admin
     */
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'ongoing');
        
        $query = Booking::with(['passenger', 'driver.vehicle']);

        if ($activeTab === 'ongoing') {
            $query->whereIn('status', ['pending', 'ongoing']);
        } else {
            $query->whereIn('status', ['completed', 'cancelled']);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('booking_id', 'like', "%{$search}%")
                  ->orWhereHas('passenger', function($pq) use ($search) {
                      $pq->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                  });
            });
        }

        $bookings = $query->latest()->paginate($request->get('per_page', 10));

        return response()->json([
            'status' => 'success',
            'data' => $bookings
        ]);
    }

    /**
     * Show booking detail
     */
    public function show($id)
    {
        $booking = Booking::with(['passenger', 'driver.vehicle', 'vehicle'])->find($id);

        if (!$booking) {
            return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $booking
        ]);
    }

    /**
     * Cancel or Update Status
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
        }

        $booking->update(['status' => $request->status]);

        return response()->json([
            'status' => 'success',
            'message' => 'Booking status updated to ' . $request->status
        ]);
    }
}
