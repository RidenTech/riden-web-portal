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
            <div class="riden-search-bar">
                <div class="riden-search-icon">
                    <i class="bi bi-search"></i>
                </div>
                <input type="text" placeholder="Search by ID, passenger or driver">
            </div>
            <div class="date-range-picker">
                <i class="bi bi-calendar-range"></i>
                <span>23/04/2025 - 23/04/2025</span>
            </div>
        </div>

        <!-- 2. Tabs Row -->
        <div class="riden-tabs-container">
            @php
                $currentType = request()->get('type', 'ongoing');
            @endphp
            <a href="{{ route('admin.booking.management', ['type' => 'ongoing']) }}" class="riden-tab-item {{ $currentType == 'ongoing' ? 'active' : '' }}">Ongoing Bookings</a>
            <a href="{{ route('admin.booking.management', ['type' => 'previous']) }}" class="riden-tab-item {{ $currentType == 'previous' ? 'active' : '' }}">Previous Bookings</a>
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
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Row -->
            <div class="booking-pagination">
                <a href="#" class="pg-link"><i class="bi bi-chevron-left"></i></a>
                <a href="#" class="pg-link active">1</a>
                <a href="#" class="pg-link">2</a>
                <a href="#" class="pg-link">3</a>
                <span class="pg-dots">...</span>
                <a href="#" class="pg-link">5</a>
                <a href="#" class="pg-link nav-btn"><i class="bi bi-chevron-right"></i></a>
            </div>
        </div>

    </div>
</div>
@endsection
