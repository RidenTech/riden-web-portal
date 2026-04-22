<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AdminDashboardApiController extends Controller
{
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
}
