<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\Driver;
use App\Models\Vehicle;

class AdminController extends Controller
{

    /**
     * List all support tickets
     */
    public function getSupportTickets()
    {
        // Senior developer note: If model doesn't exist yet, return structured empty data 
        // to help the React developer build the UI.
        return response()->json([
            'status' => 'success',
            'data' => [
                'tickets' => [],
                'counts' => [
                    'open' => 0,
                    'closed' => 0,
                    'pending' => 0
                ]
            ]
        ]);
    }

    /**
     * Get ticket detail
     */
    public function getSupportTicket($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $id,
                'subject' => 'Issue with booking',
                'messages' => []
            ]
        ]);
    }

    /**
     * Reply to ticket
     */
    public function replySupportTicket(Request $request, $id)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Reply sent successfully'
        ]);
    }

    /**
     * List all admin users with their roles
     */
    public function getRoles()
    {
        try {
            $admins = Admin::select('id', 'name', 'email', 'phone', 'modules', 'is_super')->get();
            return response()->json([
                'status' => 'success',
                'data' => $admins
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch admins: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new admin user
     */
    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
            'modules' => 'required|array',
            'is_super' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'modules' => $request->modules,
            'is_super' => $request->is_super ?? false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Admin created successfully',
            'data' => $admin
        ]);
    }

    /**
     * Update existing admin
     */
    public function updateRole(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:admins,email,' . $id,
            'modules' => 'sometimes|array',
            'is_super' => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $admin->update($request->only(['name', 'email', 'modules', 'is_super']));

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
            $admin->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Admin updated successfully',
            'data' => $admin
        ]);
    }

    /**
     * Delete Admin
     */
    public function destroyRole($id)
    {
        $admin = Admin::findOrFail($id);
        
        if ($admin->is_super) {
            return response()->json(['status' => 'error', 'message' => 'Super admin cannot be deleted'], 403);
        }

        $admin->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Admin deleted successfully'
        ]);
    } 
    
    /**
     * List all promo codes
     */
    public function getPromos()
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'promo_codes' => []
            ]
        ]);
    }

    /**
     * Get promo detail
     */
    public function getPromo($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $id,
                'code' => 'WELCOME50',
                'discount' => '50%',
                'status' => 'active'
            ]
        ]);
    }

    /**
     * Create Promo
     */
    public function storePromo(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Promo code created successfully'
        ]);
    }
    /**
     * Get Dashboard Stats for React Frontend
     */
    public function getStats()
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'total_bookings' => Booking::count(),
                'pending_bookings' => Booking::where('status', 'pending')->count(),
                'ongoing_bookings' => Booking::where('status', 'ongoing')->count(),
                'completed_bookings' => Booking::where('status', 'completed')->count(),
                'total_passengers' => Passenger::count(),
                'total_drivers' => Driver::count(),
                'total_vehicles' => Vehicle::count(),
                'revenue' => Booking::where('status', 'completed')->sum('fare'),
            ]
        ]);
    }

    /**
     * Get Analytics Data
     */
    public function getAnalytics()
    {
        // Senior standard: Return chart-ready data
        $recentBookings = Booking::selectRaw('DATE(created_at) as date, count(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'booking_trends' => $recentBookings,
                'passenger_growth' => Passenger::selectRaw('DATE(created_at) as date, count(*) as total')
                    ->groupBy('date')
                    ->orderBy('date', 'desc')
                    ->limit(7)
                    ->get()
            ]
        ]);
    }
    /**
     * Admin Login via API (Sanctum)
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Generate Token
        $token = $admin->createToken('admin-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'admin' => $admin
            ]
        ]);
    }

    /**
     * Get Authenticated Admin Profile
     */
    public function me(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $request->user()
        ]);
    }

    /**
     * Admin Logout
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }
}
