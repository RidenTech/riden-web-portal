@extends('admin.layout.master')

@section('title')
    Booking Detail
@endsection

@push('styles')
    <link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .booking-detail-wrapper {
            padding: 20px 0;
        }
      
        .back-btn {
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #111;
            text-decoration: none;
            font-size: 20px;
        }
        .header-title-group h2 {
            font-size: 24px;
            font-weight: 800;
            margin: 0;
        }
        .booking-id-badge {
            background: #fff;
            border: 1.5px solid #111;
            border-radius: 8px;
            padding: 5px 12px;
            font-weight: 800;
            font-size: 16px;
            margin-top: 15px;
            color:#111;
            display: inline-block;
        }
        .header {
            text-align: right;
        }
        .status-header-badge {
            background: #10b981;
            color: #fff;
            padding: 8px 25px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
        }
        .header-date {
            margin-top: 15px;
            font-weight: 700;
            color: #444;
            font-size: 16px;
        }

        /* Grid Layout */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        /* Map Section */
        .map-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #E5E7EB;
            overflow: hidden;
            box-shadow: var(--riden-shadow);
            margin-bottom: 25px;
        }
        #map {
            height: 400px;
            width: 100%;
        }

        /* Review Card */
        .side-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #E5E7EB;
            padding: 20px;
            box-shadow: var(--riden-shadow);
            margin-bottom: 20px;
        }
        .card-header-red {
            background: var(--riden-red);
            color: #fff;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        .rating-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .stars {
            color: #FFB800;
            font-size: 18px;
        }
        .review-text {
            color: #555;
            font-size: 14px;
            line-height: 1.6;
        }
        .tip-info {
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }
        .tip-amount {
            color: var(--riden-red);
            font-weight: 800;
        }

        /* Main Info Column (Right) */
        .info-card {
            background: #fff;
            border-radius: 25px;
            border: 1px solid #E5E7EB;
            padding: 25px;
            box-shadow: var(--riden-shadow);
        }
        .ride-title {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 20px;
        }
        .section-label {
            background: var(--riden-red);
            color: #fff;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            display: inline-block;
            width: 100%;
            margin-bottom: 15px;
        }
        .user-info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .user-meta {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            object-fit: cover;
        }
        .user-details h4 {
            font-size: 16px;
            font-weight: 800;
            margin: 0 0 2px 0;
        }
        .user-details p {
            font-size: 12px;
            color: #777;
            margin: 0;
        }
        .call-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid var(--riden-red);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--riden-red);
            text-decoration: none;
        }
        .vehicle-info {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f5f5f5;
            margin-bottom: 20px;
        }
        .vehicle-img {
            width: 80px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
        }
        .vehicle-name {
            font-weight: 700;
            font-size: 15px;
            color: #111;
        }

        /* Timeline */
        .booking-timeline {
            position: relative;
            padding-left: 25px;
            margin-bottom: 25px;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-item:last-child {
            margin-bottom: 0;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -18px;
            top: 5px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            z-index: 2;
        }
        .item-start::before { background: currentColor; }
        .item-end::before {
            content: '\F3E8';
            font-family: 'bootstrap-icons';
            left: -20px;
            top: 2px;
            font-size: 16px;
            color: var(--riden-red);
            background: none;
        }
        .timeline-line {
            position: absolute;
            left: 12px;
            top: 15px;
            bottom: 15px;
            width: 0;
            border-left: 2px dashed #ddd;
        }
        .timeline-content h5 {
            font-size: 15px;
            font-weight: 800;
            margin: 0 0 2px 0;
        }
        .timeline-content p {
            font-size: 12px;
            color: #777;
            margin: 0;
        }

        /* Trip Stats */
        .trip-stats {
            display: flex;
            justify-content: space-between;
            background: #fff;
            padding: 15px 0;
            border-top: 1px solid #f5f5f5;
            border-bottom: 1px solid #f5f5f5;
            margin-bottom: 25px;
        }
        .stat-item {
            text-align: center;
            flex: 1;
        }
        .stat-label {
            font-size: 10px;
            text-transform: uppercase;
            font-weight: 700;
            color: #999;
            display: block;
            margin-bottom: 5px;
        }
        .stat-value {
            font-size: 14px;
            font-weight: 800;
            color: #111;
        }

        /* Payment */
        .payment-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
        }
        .payment-label {
            font-size: 12px;
            font-weight: 700;
            color: #111;
        }
        .card-meta {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-brand {
            font-weight: 800;
            font-size: 13px;
        }
        .card-number {
            font-size: 12px;
            color: #777;
        }

        @media (max-width: 992px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
<div class="col-12">
    <div class="booking-detail-wrapper">
        
        <!-- Header Section -->
        @php
            $status = request()->get('status', 'Completed');
        @endphp
        <!-- Header Section -->
        @php
            $status = request()->get('status', 'Completed');
        @endphp
        <div class="d-flex flex-column gap-3 w-100 border-bottom pb-3 mb-4">
     
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-1">
                    <a href="{{ route('admin.booking.management') }}" class="back-btn p-0 border-0 bg-transparent">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <h2 class="mb-0" style="font-size: 24px; font-weight: 800;">Booking Detail</h2>
                </div>
                <span class="status-header-badge" style="background: {{ $status == 'Cancelled' ? '#ff5c5c' : ($status == 'Ongoing' ? 'var(--riden-red)' : '#10b981') }}; padding: 8px 20px; border-radius: 8px; color: #fff; font-weight: 700; font-size: 14px;">
                    {{ $status }}
                </span>
            </div>
            
            <!-- Row 2: Booking ID & Date -->
            <div class="d-flex justify-content-between align-items-end">
                <span class="booking-id-badge m-0" style="background: #fff; border: 1.5px solid #111; border-radius: 8px; padding: 5px 12px; font-weight: 800; font-size: 16px; color: #111;">
                    Booking ID #{{ $id }}
                </span>
                <p class="header-date m-0" style="font-weight: 700; color: #444; font-size: 16px;">
                    Sunday March 23, 2023
                </p>
            </div>
        </div>

        <!-- Detail Grid -->
        <div class="detail-grid">
            
            <!-- Left Column: Map & Reviews -->
            <div class="detail-left">
                <div class="map-card">
                    <iframe class="w-100" 
                            style="border:0; height: 400px; border-radius: 20px;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1469550.0538914043!2d-80.443189!3d43.834789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cd44b1c1d1a8d05%3A0xe10ad5de81c4e7ab!2sToronto%2C%20ON%2C%20Canada!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                @if($status !== 'Ongoing')
                <!-- Ratings & Reviews Card -->
                <div class="side-card">
                    <div class="card-header-red">
                        <i class="bi bi-chat-square-text-fill"></i>
                        Ratings & Reviews
                    </div>
                    <div class="rating-group">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                        </div>
                        <span class="review-text">(4.0)</span>
                    </div>
                    <p class="review-text">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>

                    <div class="card-header-red mt-4">
                        <i class="bi bi-cash-stack"></i>
                        Tip
                    </div>
                    <p class="tip-info">
                        The Passenger “Guy Hawkins” gives <span class="tip-amount">$10</span> as a tip to the driver “Sergio Morsis”
                    </p>
                </div>
                @endif
            </div>

            <!-- Right Column: Trip Info -->
            <div class="detail-right">
                <div class="info-card">
                    <h3 class="ride-title">{{ $status == 'Ongoing' ? 'Ongoing' : ($status == 'Cancelled' ? 'Cancelled' : 'Completed') }} Ride</h3>

                    <!-- Driver Section -->
                    <div class="section-label">Driver</div>
                    <div class="user-info-row">
                        <div class="user-meta">
                            <img src="https://i.pravatar.cc/150?u=sergio" class="user-avatar" alt="Driver">
                            <div class="user-details">
                                <h4>Sergio Morsis</h4>
                                <p>43 Rides (31 reviews)</p>
                            </div>
                        </div>
                        <a href="tel:+123456789" class="call-btn">
                            <i class="bi bi-telephone-fill"></i>
                        </a>
                    </div>
                    <div class="vehicle-info">
                        <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&q=80&w=200" class="vehicle-img" alt="Vehicle">
                        <div class="vehicle-details">
                            <span class="vehicle-name"><i class="bi bi-circle-fill me-2" style="font-size: 8px;"></i> Black Suzuki Alto, (BKG-220)</span>
                        </div>
                    </div>

                    <!-- Booking Details (Timeline) -->
                    <div class="section-label">Booking Details</div>
                    <div class="booking-timeline">
                        <div class="timeline-line"></div>
                        <div class="timeline-item item-start">
                            <div class="timeline-content">
                                <h5>Office</h5>
                                <p>2972 Westheimer Rd. Santa Ana, Illinois 85486</p>
                            </div>
                        </div>
                        <div class="timeline-item item-end">
                            <div class="timeline-content">
                                <h5>Coffee shop</h5>
                                <p>1901 Thornridge Cir. Shiloh, Hawaii 81063</p>
                            </div>
                        </div>
                    </div>

                    <!-- Trip Stats -->
                    <div class="trip-stats">
                        <div class="stat-item">
                            <span class="stat-label">Est Distance</span>
                            <span class="stat-value">0.2 km</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Est Time</span>
                            <span class="stat-value">2 min</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Est Fare</span>
                            <span class="stat-value">$25.00</span>
                        </div>
                    </div>

                    <!-- Passenger Section -->
                    <div class="section-label">Passenger</div>
                    <div class="user-info-row">
                        <div class="user-meta">
                            <img src="https://i.pravatar.cc/150?u=guy" class="user-avatar" alt="Passenger">
                            <div class="user-details">
                                <h4>Guy Hawkins</h4>
                                <p>43 Rides (31 reviews)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="payment-section">
                        <span class="payment-label">Payment Method</span>
                        <div class="card-meta">
                            <img src="https://img.icons8.com/color/48/000000/visa.png" width="30" alt="Visa">
                            <span class="card-brand">Visa</span>
                            <span class="card-number">********234</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
