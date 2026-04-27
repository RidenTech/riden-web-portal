<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportTicketController extends Controller
{
    /**
     * List tickets for the authenticated user (Driver or Passenger)
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $userType = $request->get('user_type'); // Expecting 'driver' or 'passenger'

            if (!$userType) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'user_type parameter is required'
                ], 400);
            }

            $query = SupportTicket::where('user_type', $userType);

            if ($userType === 'driver') {
                $query->where('driver_id', $user->id);
            } else {
                $query->where('passenger_id', $user->id);
            }

            $tickets = $query->latest()->paginate(15);

            return response()->json([
                'status' => 'success',
                'message' => 'Support tickets retrieved successfully',
                'data' => $tickets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve tickets: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create a new support ticket from the mobile app or admin portal
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_type' => 'required|in:driver,passenger',
            'complaint_type' => 'required|string|max:255',
            'description' => 'required|string',
            'booking_id' => 'nullable|exists:bookings,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'passenger_id' => 'nullable|exists:passengers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = $request->user();
            
            // Auto-generate Ticket ID like #34567
            $ticketId = '#' . rand(10000, 99999);

            // Logic: If driver_id/passenger_id is provided in request (Admin), use that.
            // Otherwise, use the authenticated user's ID (Mobile App).
            $finalDriverId = $request->driver_id ?? ($request->user_type === 'driver' ? $user->id : null);
            $finalPassengerId = $request->passenger_id ?? ($request->user_type === 'passenger' ? $user->id : null);

            $ticket = SupportTicket::create([
                'ticket_id' => $ticketId,
                'user_type' => $request->user_type,
                'driver_id' => $finalDriverId,
                'passenger_id' => $finalPassengerId,
                'booking_id' => $request->booking_id,
                'complaint_type' => $request->complaint_type,
                'description' => $request->description,
                'status' => 'pending',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Support ticket created successfully',
                'data' => $ticket
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create ticket: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get details of a single ticket
     */
    public function show($id)
    {
        try {
            $ticket = SupportTicket::with(['driver', 'passenger', 'booking'])->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ticket not found'
            ], 404);
        }
    }
}
