@extends('admin.layout.master')

@section('title')
    Booking Management
@endsection

@push('styles')
    <link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">
    <div class="booking-management-wrapper">
        <div class="booking-management-container">
        
        <!-- 1. Header Row -->
        <div class="booking-header-row riden-list-header">
            <form action="{{ route('admin.booking.management') }}" method="GET" class="riden-search-bar">
                <input type="hidden" name="tab" value="{{ $activeTab }}">
                <div class="riden-search-icon">
                    <i class="bi bi-search"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by ID, passenger or driver" onchange="this.form.submit()">
            </form>
            <div class="date-range-picker">
                <i class="bi bi-calendar-range"></i>
                <span>{{ now()->format('d/m/Y') }} - {{ now()->format('d/m/Y') }}</span>
            </div>
        </div>

        <!-- 2. Tabs Row -->
        <div class="riden-tabs-container">
            <a href="{{ route('admin.booking.management', ['tab' => 'ongoing']) }}" class="riden-tab-item {{ $activeTab === 'ongoing' ? 'active' : '' }}">Ongoing Bookings</a>
            <a href="{{ route('admin.booking.management', ['tab' => 'previous']) }}" class="riden-tab-item {{ $activeTab === 'previous' ? 'active' : '' }}">Previous Bookings</a>
        </div>

        <!-- 3. Table Card -->
        <div class="booking-card">
            <div class="table-responsive">
                <table class="table mb-0 booking-table">
                    <thead>
                        <tr>
                            <th class="ps-4">Booking ID</th>
                            <th>Passenger</th>
                            <th>Driver</th>
                            <th>Fare</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                        <tr>
                            <td class="ps-4 booking-id">
                                <a href="{{ route('admin.booking.detail', $booking->id) }}" class="text-dark text-decoration-none">
                                    {{ $booking->booking_id }}
                                </a>
                            </td>
                            <td>{{ $booking->passenger->name ?? 'N/A' }}</td>
                            <td>{{ $booking->driver->name ?? 'Unassigned' }}</td>
                            <td>${{ number_format($booking->fare, 2) }}</td>
                            <td>
                                <span class="status-badge {{ in_array($booking->status, ['completed', 'ongoing']) ? 'status-completed' : ($booking->status === 'cancelled' ? 'status-cancelled' : '') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No bookings found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Row -->
            <div class="booking-pagination">
                {{ $bookings->links('vendor.pagination.riden') }}
            </div>
        </div>

    </div>
</div>
@endsection
