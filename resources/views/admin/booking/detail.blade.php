@extends('admin.layout.master')

@section('title')
    Booking Detail
@endsection

@push('styles')
    <link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">
    <div class="booking-detail-wrapper">
        
        <!-- Header Top Row -->
        <div class="detail-header-top">
            <a href="{{ route('admin.booking.management') }}" class="back-link">
                <i class="bi bi-chevron-left"></i> Booking Detail
            </a>
            <div class="status-pill {{ $booking->status === 'cancelled' ? 'bg-danger' : 'bg-success' }}">
                {{ ucfirst($booking->status) }}
            </div>
        </div>

        <div class="detail-header-bottom d-flex justify-content-between align-items-center mb-4">
            <div class="booking-id-tag">
                Booking ID {{ $booking->booking_id }}
            </div>
            <div class="detail-date">
                {{ $booking->created_at->format('l F d, Y') }}
            </div>
        </div>

        <div class="booking-main-grid">
            <!-- Left Side: Map & Reviews -->
            <div class="grid-left">
                <div class="map-box" style="background-image: url('{{ asset('map_placeholder_1776062199850.png') }}');">
                    <div class="map-controls">
                        <button class="map-ctrl-btn"><i class="bi bi-plus"></i></button>
                        <button class="map-ctrl-btn"><i class="bi bi-dash"></i></button>
                    </div>
                </div>

                @if(in_array($booking->status, ['completed', 'cancelled']))
                <div class="review-card">
                    <div class="section-label">
                        <i class="bi bi-chat-square-text-fill"></i> Ratings & Reviews
                    </div>
                    <div class="review-star-row">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star text-muted"></i>
                        <span class="ms-2 fw-bold">(4.0)</span>
                    </div>
                    <p class="review-text">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                    
                    <div class="section-label">
                        <i class="bi bi-gift-fill"></i> Tip
                    </div>
                    <p class="tip-message mb-0">
                        The Passenger “{{ $booking->passenger->name }}” gives <strong>$10</strong> as a tip to the driver “{{ $booking->driver->name }}”
                    </p>
                </div>
                @endif
            </div>

            <!-- Right Side: Details -->
            <div class="grid-right">
                <div class="white-card detail-card-inner">
                    <h2 class="ride-type-title">{{ ucfirst($booking->status) }} Ride</h2>

                    <!-- Driver Section -->
                    <div class="section-label">Driver</div>
                    <div class="person-row">
                        <div class="person-basics">
                            <img src="{{ asset('assets/images/user-placeholder.png') }}" class="person-avatar">
                            <div>
                                <h4 class="person-name">{{ $booking->driver->name }}</h4>
                                <span class="person-meta">43 Rides (31 reviews)</span>
                            </div>
                        </div>
                        <a href="#" class="call-circle">
                            <i class="bi bi-telephone-fill"></i>
                        </a>
                    </div>

                    <div class="vehicle-row">
                        <img src="{{ asset('black_suzuki_alto_1776062634304.png') }}" class="vehicle-img">
                        <span class="vehicle-text"><i class="bi bi-dot"></i> {{ $booking->driver->vehicle->color ?? 'Black' }} {{ $booking->driver->vehicle->model ?? 'Suzuki Alto' }}, ({{ $booking->driver->vehicle->license_plate ?? 'BKG-220' }})</span>
                    </div>

                    <!-- Booking Details Section -->
                    <div class="section-label">Booking Details</div>
                    <div class="path-container">
                        <div class="path-point">
                            <div class="point-icon origin"><i class="bi bi-circle-fill"></i></div>
                            <div class="point-labels">
                                <h7>Office</h7>
                                <p>{{ $booking->pickup_location }}</p>
                            </div>
                        </div>
                        <div class="path-point">
                            <div class="point-icon dest"><i class="bi bi-geo-alt-fill"></i></div>
                            <div class="point-labels">
                                <h7>Coffee shop</h7>
                                <p>{{ $booking->dropoff_location }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="stats-grid-row">
                        <div class="stat-item">
                            <h8>EST Distance</h8>
                            <p>0.2 km</p>
                        </div>
                        <div class="stat-item">
                            <h8>EST Time</h8>
                            <p>2 min</p>
                        </div>
                        <div class="stat-item">
                            <h8>EST Fare</h8>
                            <p>${{ number_format($booking->fare, 2) }}</p>
                        </div>
                    </div>

                    <!-- Passenger Section -->
                    <div class="section-label">Passenger</div>
                    <div class="person-row mb-0">
                        <div class="person-basics">
                            <img src="{{ asset('assets/images/user-placeholder.png') }}" class="person-avatar">
                            <div>
                                <h4 class="person-name">{{ $booking->passenger->name }}</h4>
                                <span class="person-meta">43 Rides (31 reviews)</span>
                            </div>
                        </div>
                    </div>

                    <div class="pay-footer mt-4">
                        <h9>Payment Method</h9>
                        <div class="card-brand">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" width="40">
                            <div class="brand-info">
                                <strong>Visa</strong>
                                <span>********234</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
