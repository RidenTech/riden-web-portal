<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\Driver;
use App\Models\Passenger;
use App\Models\Booking;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'driver'); // 'driver' or 'passenger'
        
        $query = SupportTicket::where('user_type', $activeTab)
            ->with(['driver', 'passenger', 'booking']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('ticket_id', 'like', "%{$search}%")
                  ->orWhere('complaint_type', 'like', "%{$search}%")
                  ->orWhereHas('driver', function($dq) use ($search) {
                      $dq->where('first_name', 'like', "%{$search}%")->orWhere('last_name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('passenger', function($pq) use ($search) {
                      $pq->where('first_name', 'like', "%{$search}%")->orWhere('last_name', 'like', "%{$search}%");
                  });
            });
        }

        $tickets = $query->latest()->paginate(10);
        
        // Data for the "Add Ticket" Modal
        $drivers = Driver::orderBy('first_name')->get();
        $passengers = Passenger::orderBy('first_name')->get();
        $bookings = Booking::orderBy('id', 'desc')->take(50)->get();

        return view('admin.support.index', compact('activeTab', 'tickets', 'drivers', 'passengers', 'bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_type' => 'required|in:driver,passenger',
            'complaint_type' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,resolved',
        ]);

        // Auto-generate Ticket ID like #34567
        $ticketId = '#' . rand(10000, 99999);

        SupportTicket::create([
            'ticket_id' => $ticketId,
            'user_type' => $request->user_type,
            'driver_id' => $request->driver_id,
            'passenger_id' => $request->passenger_id,
            'booking_id' => $request->booking_id,
            'complaint_type' => $request->complaint_type,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.support.index', ['tab' => $request->user_type])
            ->with('status', 'Ticket ' . $ticketId . ' created successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $ticket->update(['status' => $request->status]);

        return redirect()->back()->with('status', 'Ticket status updated to ' . $request->status);
    }
}
