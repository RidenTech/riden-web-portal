<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Passenger;
use App\Models\Driver;

class BookingManagementController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'ongoing');
        
        $query = Booking::with(['passenger', 'driver.vehicle'])
            ->whereNotNull('driver_id');

        // Priority Logic for Ongoing vs Previous
        if ($activeTab === 'ongoing') {
            $query->whereIn('status', ['pending', 'ongoing']);
        } else {
            $query->whereIn('status', ['completed', 'cancelled']);
        }

        // Date Range Filtering
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
        }

        // Search Logic (Booking ID, Passenger, Driver)
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('booking_id', 'like', "%{$search}%")
                  ->orWhereHas('passenger', function($pq) use ($search) {
                      $pq->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('driver', function($dq) use ($search) {
                      $dq->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        return view('admin.booking.index', compact('bookings', 'activeTab'));
    }

    public function show($id)
    {
        // Eager load everything for the high-fidelity detail view
        $booking = Booking::with([
            'passenger', 
            'driver.vehicle', 
            'driver.reviews', // For counting rides and ratings
            'vehicle'
        ])->findOrFail($id);
        
        return view('admin.booking.detail', compact('booking'));
    }

    public function create()
    {
        $passengers = Passenger::orderBy('first_name')->get();
        $drivers = Driver::orderBy('first_name')->get();

        return view('admin.booking.create', compact('passengers', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'passenger_id' => 'required|exists:passengers,id',
            'driver_id' => 'required|exists:drivers,id',
            'pickup_location' => 'required|string',
            'dropoff_location' => 'required|string',
            'fare' => 'required|numeric',
        ]);

        // Generate a professional unique booking ID (e.g., #48291)
        $bookingId = '#' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        Booking::create([
            'booking_id' => $bookingId,
            'passenger_id' => $request->passenger_id,
            'driver_id' => $request->driver_id,
            'pickup_location' => $request->pickup_location,
            'dropoff_location' => $request->dropoff_location,
            'fare' => $request->fare,
            'distance' => $request->distance ?? '0.0 km',
            'duration' => $request->duration ?? '0 min',
            'status' => 'pending', // Defaulting to pending for new admin bookings
            'payment_method' => 'Cash', // Default for now
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('admin.booking.management')
            ->with('success', 'New booking ' . $bookingId . ' has been created successfully!');
    }
}
