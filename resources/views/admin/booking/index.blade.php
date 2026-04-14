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
            @php
                $currentType = request()->get('type', 'ongoing');
            @endphp
            <a href="{{ route('admin.booking.management', ['type' => 'ongoing']) }}" class="riden-tab-item {{ $currentType == 'ongoing' ? 'active' : '' }}">Ongoing Bookings</a>
            <a href="{{ route('admin.booking.management', ['type' => 'previous']) }}" class="riden-tab-item {{ $currentType == 'previous' ? 'active' : '' }}">Previous Bookings</a>
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
                            <th>Driver</th>
                            <th>Passenger</th>
                            <th>Fare</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            if ($currentType == 'previous') {
                                $bookings = [
                                    ['id' => '#34567', 'driver' => 'Wade Warren', 'passenger' => 'Theresa Webb', 'fare' => '$45.00', 'status' => 'Completed'],
                                    ['id' => '#34567', 'driver' => 'Jacob Jones', 'passenger' => 'Ralph Edwards', 'fare' => '$45.00', 'status' => 'Cancelled'],
                                    ['id' => '#34567', 'driver' => 'Bessie Cooper', 'passenger' => 'Dianne Russell', 'fare' => '$45.00', 'status' => 'Completed'],
                                    ['id' => '#34567', 'driver' => 'Theresa Webb', 'passenger' => 'Esther Howard', 'fare' => '$45.00', 'status' => 'Completed'],
                                    ['id' => '#34567', 'driver' => 'Jerome Bell', 'passenger' => 'Darlene Robertson', 'fare' => '$45.00', 'status' => 'Completed'],
                                    ['id' => '#34567', 'driver' => 'Robert Fox', 'passenger' => 'Cody Fisher', 'fare' => '$45.00', 'status' => 'Completed'],
                                    ['id' => '#34567', 'driver' => 'Kathryn Murphy', 'passenger' => 'Ronald Richards', 'fare' => '$45.00', 'status' => 'Cancelled'],
                                    ['id' => '#34567', 'driver' => 'Savannah Nguyen', 'passenger' => 'Floyd Miles', 'fare' => '$45.00', 'status' => 'Completed'],
                                    ['id' => '#34567', 'driver' => 'Floyd Miles', 'passenger' => 'Albert Flores', 'fare' => '$45.00', 'status' => 'Completed'],
                                    ['id' => '#34567', 'driver' => 'Devon Lane', 'passenger' => 'Marvin McKinney', 'fare' => '$45.00', 'status' => 'Completed'],
                                ];
                            } else {
                                $bookings = [
                                    ['id' => '#34567', 'driver' => 'Theresa Webb', 'passenger' => 'Wade Warren', 'fare' => '$45.00', 'status' => 'Ongoing'],
                                    ['id' => '#34567', 'driver' => 'Ralph Edwards', 'passenger' => 'Wade Warren', 'fare' => '$45.00', 'status' => 'Ongoing'],
                                    ['id' => '#34567', 'driver' => 'Dianne Russell', 'passenger' => 'Wade Warren', 'fare' => '$45.00', 'status' => 'Ongoing'],
                                    ['id' => '#34567', 'driver' => 'Esther Howard', 'passenger' => 'Wade Warren', 'fare' => '$45.00', 'status' => 'Ongoing'],
                                    ['id' => '#34567', 'driver' => 'Darlene Robertson', 'passenger' => 'Wade Warren', 'fare' => '$45.00', 'status' => 'Ongoing'],
                                ];
                            }
                        @endphp
                        @foreach ($bookings as $booking)
                        @php
                            $detailUrl = route('admin.booking.detail', ['id' => trim($booking['id'], '#'), 'status' => $booking['status']]);
                        @endphp
                        <tr onclick="window.location='{{ $detailUrl }}'" style="cursor: pointer;">
                            <td class="ps-4 booking-id">
                                {{ $booking['id'] }}
                            </td>
                            <td>{{ $booking['driver'] }}</td>
                            <td>{{ $booking['passenger'] }}</td>
                            <td>{{ $booking['fare'] }}</td>
                            <td>
                                <span class="status-badge {{ in_array($booking['status'], ['Completed', 'Ongoing']) ? 'status-completed' : 'status-cancelled' }}">
                                    {{ $booking['status'] }}
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
