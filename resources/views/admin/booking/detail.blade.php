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
        
        <!-- 1. Header Navigation -->
        <div class="detail-header-row mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.booking.management') }}" class="back-link">
                    <i class="bi bi-chevron-left text-dark"></i>
                </a>
                <h2 class="booking-title">Booking Detail</h2>
            </div>
            <div class="status-indicator">
                <span class="status-pill-riden {{ $booking->status === 'ongoing' ? 'bg-danger' : 'bg-success' }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
        </div>

        <!-- 2. Booking ID & Date Row -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="booking-badge-elite">
                Booking ID #{{ $booking->booking_id }}
            </div>
            <div class="booking-date-elite text-muted fw-bold">
                {{ $booking->created_at->format('l F d, Y') }}
            </div>
        </div>

        <!-- 3. Main Content Grid -->
        <div class="booking-detail-grid">
            
            <!-- Left Side: Route Map Placeholder -->
            <div class="grid-col-map">
                <div class="map-placeholder-card">
                    {{-- High-fidelity placeholder for map as requested to skip dynamic map for now --}}
                    <div class="map-visual-placeholder" style="background-image: url('{{ asset('assets/images/placeholders/map-mockup.png') }}');">
                        <div class="map-zoom-controls">
                            <button><i class="bi bi-plus"></i></button>
                            <button><i class="bi bi-dash"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Interaction Cards -->
            <div class="grid-col-info">
                <div class="elite-ride-card">
                    <h3 class="ride-header-title">{{ $booking->status === 'ongoing' ? 'Ongoing' : 'Previous' }} Ride</h3>

                    <!-- Driver Section -->
                    <div class="premium-section-label">Driver</div>
                    <div class="driver-info-elite mb-3">
                        <div class="user-meta-riden">
                            <img src="{{ $booking->driver->avatar ? asset('storage/'.$booking->driver->avatar) : asset('assets/images/user-placeholder.png') }}" class="avatar-elite" alt="Driver">
                            <div class="meta-text">
                                <h4 class="name-elite">{{ $booking->driver->first_name }} {{ $booking->driver->last_name }}</h4>
                                <span class="stats-elite">43 Rides (31 reviews)</span>
                            </div>
                        </div>
                        <div class="action-circles">
                            <a href="#" class="circle-btn-riden"><i class="bi bi-telephone-fill"></i></a>
                            <a href="#" class="circle-btn-riden"><i class="bi bi-chat-dots-fill"></i></a>
                        </div>
                    </div>

                    <div class="vehicle-strip-elite mb-4">
                        <i class="bi bi-circle-fill dot-indicator"></i> 
                        <span class="vehicle-text">
                            {{ $booking->driver->vehicle->color ?? 'Black' }} {{ $booking->driver->vehicle->model ?? 'Suzuki Alto' }}, ({{ $booking->driver->vehicle->license_plate ?? 'BKG-220' }})
                        </span>
                    </div>

                    <!-- Booking Details Timeline -->
                    <div class="premium-section-label">Booking Details</div>
                    <div class="elite-timeline mb-4">
                        <div class="timeline-item-riden">
                            <div class="icon-origin"><i class="bi bi-circle-fill"></i></div>
                            <div class="timeline-data">
                                <h5>Office</h5>
                                <p>{{ $booking->pickup_location }}</p>
                            </div>
                        </div>
                        <div class="timeline-item-riden">
                            <div class="icon-destination"><i class="bi bi-geo-alt-fill"></i></div>
                            <div class="timeline-data">
                                <h5>Coffee shop</h5>
                                <p>{{ $booking->dropoff_location }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Ride Stats Bar -->
                    <div class="elite-stats-strip mb-4">
                        <div class="stat-unit">
                            <span class="label-stat">EST Distance</span>
                            <span class="val-stat">{{ $booking->distance ?? '0.2 km' }}</span>
                        </div>
                        <div class="stat-unit">
                            <span class="label-stat">EST Time</span>
                            <span class="val-stat">{{ $booking->duration ?? '2 min' }}</span>
                        </div>
                        <div class="stat-unit">
                            <span class="label-stat">EST Fare</span>
                            <span class="val-stat">${{ number_format($booking->fare, 2) }}</span>
                        </div>
                    </div>

                    <!-- Passenger Section -->
                    <div class="premium-section-label">Passenger</div>
                    <div class="passenger-info-elite mb-4">
                        <div class="user-meta-riden">
                            <img src="{{ $booking->passenger->avatar ? asset('storage/'.$booking->passenger->avatar) : asset('assets/images/user-placeholder.png') }}" class="avatar-elite" alt="Passenger">
                            <div class="meta-text">
                                <h4 class="name-elite">{{ $booking->passenger->first_name }} {{ $booking->passenger->last_name }}</h4>
                                <span class="stats-elite">43 Rides (31 reviews)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Footer -->
                    <div class="elite-payment-footer">
                        <span class="pay-label">Payment Method</span>
                        <div class="payment-brand-box">
                            <img src="https://img.icons8.com/color/48/000000/visa.png" width="30">
                            <div class="brand-details">
                                <span class="brand-name">{{ $booking->payment_method ?? 'Visa' }}</span>
                                <span class="brand-sub">********{{ $booking->card_last_four ?? '234' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
