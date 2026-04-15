<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;

class BookingManagementController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'ongoing');
        
        $query = Booking::with(['passenger', 'driver'])->whereNotNull('driver_id')->where('status', '!=', 'pending');

        if ($activeTab === 'ongoing') {
            $query->where('status', 'ongoing');
        } else {
            $query->whereIn('status', ['completed', 'cancelled']);
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('booking_id', 'like', "%{$search}%")
                  ->orWhereHas('passenger', function($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('driver', function($dq) use ($search) {
                      $dq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        return view('admin.booking.index', compact('bookings', 'activeTab'));
    }

    public function show($id)
    {
        $booking = Booking::with(['passenger', 'driver.vehicle'])->findOrFail($id);
        
        return view('admin.booking.detail', compact('booking'));
    }
}
