@extends('admin.layout.master')

@section('title')
    Support Tickets
@endsection

@push('styles')
    <link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .riden-support-wrapper {
            padding: 20px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .support-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .support-title {
            font-size: 24px;
            font-weight: 800;
            color: #000;
        }
        .riden-tabs-container {
            display: flex;
            background: #fff;
            border: 1px solid #FF2E2E;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .support-tab {
            flex: 1;
            text-align: center;
            padding: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: #FF2E2E;
        }
        .support-tab.active {
            background: #FF2E2E;
            color: #fff;
        }
        .ticket-id {
            color: #000;
            font-weight: 700;
        }
        .status-badge {
            padding: 6px 15px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
        }
        .status-pending {
            background: #FFEBEB;
            color: #FF2E2E;
        }
        .status-resolved {
            background: #EBFBF5;
            color: #2ED47E;
        }
        .btn-add-ticket {
            background: #000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        /* Modal Styles */
        .modal-riden .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }
        .modal-riden .modal-header {
            background: #000;
            color: #fff;
            padding: 20px;
        }
        .modal-riden .modal-title {
            font-weight: 800;
        }
        .form-label-riden {
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }
        .form-control-riden {
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #eee;
            background: #fcfcfc;
        }
        .btn-save-ticket {
            background: #FF2E2E;
            color: #fff;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 800;
            border: none;
            width: 100%;
        }
    </style>
@endpush

@section('content')
<div class="col-12">
    <div class="riden-support-wrapper">
        
        <!-- Header -->
        <div class="support-header">
            <h2 class="support-title">Support Ticket</h2>
            <div class="header-actions d-flex align-items-center">
                <div class="riden-global-search" style="width: 300px;">
                    <form action="{{ route('admin.support.index') }}" method="GET">
                        <input type="hidden" name="tab" value="{{ $activeTab }}">
                        <div class="input-group-riden" style="background: #f5f5f5; border-radius: 50px; padding: 5px 20px;">
                            <i class="bi bi-search text-muted mr-2"></i>
                            <input type="text" name="search" value="{{ request('search') }}" style="border:none; background:transparent; width: 100%;" placeholder="Search by name, ID or phone">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- NEW HIGH-VISIBILITY BUTTON POSITION -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-danger btn-lg shadow-sm" style="background: #FF2E2E; border: none; border-radius: 12px; font-weight: 800; padding: 15px 40px;" data-bs-toggle="modal" data-bs-target="#addTicketModal">
                <i class="bi bi-plus-circle-fill mr-2"></i> CREATE NEW TICKET
            </button>
        </div>

        <!-- Tabs -->
        <div class="riden-tabs-container">
            <a href="{{ route('admin.support.index', ['tab' => 'driver']) }}" class="support-tab {{ $activeTab === 'driver' ? 'active' : '' }}">
                Driver Complaints
            </a>
            <a href="{{ route('admin.support.index', ['tab' => 'passenger']) }}" class="support-tab {{ $activeTab === 'passenger' ? 'active' : '' }}">
                Passenger Complaints
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background: #FFF5F5;">
                        <th class="py-3">Date & Time</th>
                        <th class="py-3">Ticket ID</th>
                        <th class="py-3">Booking ID</th>
                        <th class="py-3">{{ $activeTab === 'driver' ? 'Driver Name' : 'Passenger Name' }}</th>
                        <th class="py-3">Complaint Type</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                    <tr>
                        <td class="py-3">{{ $ticket->created_at->format('d F Y g:i a') }}</td>
                        <td class="py-3 ticket-id">{{ $ticket->ticket_id }}</td>
                        <td class="py-3 text-danger fw-bold">#{{ $ticket->booking_id ?? 'N/A' }}</td>
                        <td class="py-3">{{ $ticket->user_name }}</td>
                        <td class="py-3">{{ $ticket->complaint_type }}</td>
                        <td class="py-3">
                            <form action="{{ route('admin.support.updateStatus', $ticket->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="status-badge status-{{ $ticket->status }}" style="border:none; outline:none; cursor:pointer;">
                                    <option value="pending" {{ $ticket->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">No tickets found for this category.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $tickets->appends(request()->query())->links('vendor.pagination.riden') }}
        </div>
    </div>
</div>

<!-- Add Ticket Modal -->
<div class="modal fade modal-riden" id="addTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Support Ticket</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.support.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label-riden">Complaint For</label>
                            <select name="user_type" class="form-select form-control-riden" id="userTypeSelect" required>
                                <option value="driver" {{ $activeTab === 'driver' ? 'selected' : '' }}>Driver</option>
                                <option value="passenger" {{ $activeTab === 'passenger' ? 'selected' : '' }}>Passenger</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label-riden">Complaint Type</label>
                            <select name="complaint_type" class="form-select form-control-riden" required>
                                <option value="Type 1">Behavior Issue</option>
                                <option value="Type 2">Fare Issue</option>
                                <option value="Type 3">Technical Problem</option>
                                <option value="Type 4">Safety Concern</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3" id="driverSelectGroup">
                            <label class="form-label-riden">Select Driver</label>
                            <select name="driver_id" class="form-select form-control-riden">
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->first_name }} {{ $driver->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3 d-none" id="passengerSelectGroup">
                            <label class="form-label-riden">Select Passenger</label>
                            <select name="passenger_id" class="form-select form-control-riden">
                                <option value="">Select Passenger</option>
                                @foreach($passengers as $passenger)
                                    <option value="{{ $passenger->id }}">{{ $passenger->first_name }} {{ $passenger->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label-riden">Relate to Booking (Optional)</label>
                            <select name="booking_id" class="form-select form-control-riden">
                                <option value="">Select Booking</option>
                                @foreach($bookings as $booking)
                                    <option value="{{ $booking->id }}">#{{ $booking->id }} - {{ $booking->pickup_location }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label-riden">Description / Content</label>
                            <textarea name="description" class="form-control form-control-riden" rows="6" placeholder="Enter complaint details here..." required></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label-riden">Initial Status</label>
                            <select name="status" class="form-select form-control-riden">
                                <option value="pending">Pending</option>
                                <option value="resolved">Resolved</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="submit" class="btn-save-ticket">Save Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userTypeSelect = document.getElementById('userTypeSelect');
        const driverGroup = document.getElementById('driverSelectGroup');
        const passengerGroup = document.getElementById('passengerSelectGroup');

        userTypeSelect.addEventListener('change', function() {
            if (this.value === 'driver') {
                driverGroup.classList.remove('d-none');
                passengerGroup.classList.add('d-none');
            } else {
                driverGroup.classList.add('d-none');
                passengerGroup.classList.remove('d-none');
            }
        });

        // Trigger change on load to set initial state
        userTypeSelect.dispatchEvent(new Event('change'));
    });
</script>
@endpush
