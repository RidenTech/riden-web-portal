<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    /**
     * List all bookings for the authenticated passenger
     */
    public function index(Request $request)
    {
        try {
            $bookings = Booking::with(['driver', 'vehicle'])
                ->where('passenger_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(15);

            return response()->json([
                'status' => 'success',
                'message' => 'Bookings retrieved successfully',
                'data' => $bookings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve bookings',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create a new booking from the mobile app
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pickup_location' => 'required|string|max:500',
            'dropoff_location' => 'required|string|max:500',
            'pickup_time' => 'required|date',
            'fare' => 'required|numeric|min:0',
            'distance' => 'nullable|string|max:50',
            'duration' => 'nullable|string|max:50',
            'payment_method' => 'required|string|in:Cash,Card,Wallet',
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $booking = Booking::create([
                'passenger_id' => $request->user()->id,
                'pickup_location' => $request->pickup_location,
                'dropoff_location' => $request->dropoff_location,
                'pickup_time' => $request->pickup_time,
                'distance' => $request->distance,
                'duration' => $request->duration,
                'fare' => $request->fare,
                'payment_method' => $request->payment_method,
                'payment_status' => ($request->payment_method == 'Cash') ? 'Unpaid' : 'Paid',
                'status' => 'pending', // Fixed: Must be lowercase to match database enum
                'vehicle_id' => $request->vehicle_id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Booking created successfully',
                'data' => $booking->load(['passenger'])
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal server error while creating booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get specific booking details
     */
    public function show(Request $request, $id)
    {
        try {
            $booking = Booking::with(['passenger', 'driver', 'vehicle'])
                ->where('id', $id)
                ->where('passenger_id', $request->user()->id) // Security: Must own the booking
                ->first();

            if (!$booking) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Booking not found or unauthorized access'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error retrieving booking details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel a booking
     */
    public function cancel(Request $request, $id)
    {
        try {
            $booking = Booking::where('id', $id)
                ->where('passenger_id', $request->user()->id)
                ->first();

            if (!$booking) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Booking not found or unauthorized'
                ], 404);
            }

            if (!in_array($booking->status, ['Pending', 'Confirmed'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This booking cannot be cancelled in its current state (' . $booking->status . ')'
                ], 400);
            }

            $booking->update(['status' => 'Cancelled']);

            return response()->json([
                'status' => 'success',
                'message' => 'Booking cancelled successfully',
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error during cancellation process',
                'error' => $e->getMessage()
            ], 500);
        }
    }
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
