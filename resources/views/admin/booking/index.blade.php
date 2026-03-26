@extends('admin.layout.master')

@section('title')
    Booking Management
@endsection

@push('styles')
    <link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">
    <div class="booking-management-wrapper px-3 px-md-4">
        <div class="booking-management-container">
        
        <!-- 1. Header Row -->
        <div class="booking-header-row">
            <h4 class="booking-title">Booking Management</h4>
            <div class="date-range-picker">
                <i class="bi bi-calendar-range"></i>
                <span>23/04/2025 - 23/04/2025</span>
            </div>
        </div>

        <!-- 2. Tabs Row -->
        <div class="booking-tabs-container">
            <a href="#" class="booking-tab-item active">Ongoing Bookings</a>
            <a href="#" class="btn-previous-bookings">Previous Bookings</a>
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
                        @php
                            $bookings = [
                                ['id' => '#34567', 'passenger' => 'Wade Warren', 'driver' => 'Theresa Webb', 'fare' => '$45.00', 'status' => 'Completed'],
                                ['id' => '#34567', 'passenger' => 'Wade Warren', 'driver' => 'Ralph Edwards', 'fare' => '$45.00', 'status' => 'Cancelled'],
                                ['id' => '#34567', 'passenger' => 'Wade Warren', 'driver' => 'Dianne Russell', 'fare' => '$45.00', 'status' => 'Completed'],
                                ['id' => '#34567', 'passenger' => 'Wade Warren', 'driver' => 'Esther Howard', 'fare' => '$45.00', 'status' => 'Completed'],
                                ['id' => '#34567', 'passenger' => 'Wade Warren', 'driver' => 'Darlene Robertson', 'fare' => '$45.00', 'status' => 'Completed'],
                                ['id' => '#34567', 'passenger' => 'Wade Warren', 'driver' => 'Cody Fisher', 'fare' => '$45.00', 'status' => 'Completed'],
                                ['id' => '#34567', 'passenger' => 'Wade Warren', 'driver' => 'Ronald Richards', 'fare' => '$45.00', 'status' => 'Cancelled'],
                                ['id' => '#34567', 'passenger' => 'Wade Warren', 'driver' => 'Floyd Miles', 'fare' => '$45.00', 'status' => 'Completed'],
                                ['id' => '#34567', 'passenger' => 'Wade Warren', 'driver' => 'Albert Flores', 'fare' => '$45.00', 'status' => 'Completed'],
                                ['id' => '#34567', 'passenger' => 'Wade Warren', 'driver' => 'Marvin McKinney', 'fare' => '$45.00', 'status' => 'Completed'],
                            ];
                        @endphp
                        @foreach ($bookings as $booking)
                        <tr>
                            <td class="ps-4 booking-id">{{ $booking['id'] }}</td>
                            <td>{{ $booking['passenger'] }}</td>
                            <td>{{ $booking['driver'] }}</td>
                            <td>{{ $booking['fare'] }}</td>
                            <td>
                                <span class="status-badge {{ $booking['status'] == 'Completed' ? 'status-completed' : 'status-cancelled' }}">
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
