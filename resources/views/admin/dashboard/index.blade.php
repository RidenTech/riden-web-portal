@extends('admin.layout.master')

@section('title', 'Dashboard')

@push('styles')
    <link href="{{ asset('assets/css/dashboard.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 dashboard-wrapper">

    <!-- Top KPI Cards -->
    <div class="kpi-cards-row">
        <!-- Active Drivers -->
        <div class="kpi-card">
            <div class="kpi-card-info">
                <h3 class="kpi-card-title">Active Drivers</h3>
                <p class="kpi-card-value">43</p>
            </div>
            <div class="kpi-chart">
                <div class="chart-bar green" style="height: 50%;"></div>
                <div class="chart-bar green" style="height: 40%;"></div>
                <div class="chart-bar green" style="height: 75%;"></div>
                <div class="chart-bar green" style="height: 100%;"></div>
                <div class="chart-bar green" style="height: 60%;"></div>
                <div class="chart-bar green" style="height: 25%;"></div>
            </div>
        </div>

        <!-- Ongoing Rides -->
        <div class="kpi-card">
            <div class="kpi-card-info">
                <h3 class="kpi-card-title">Ongoing Rides</h3>
                <p class="kpi-card-value">24</p>
            </div>
            <div class="kpi-chart">
                <div class="chart-bar yellow" style="height: 100%;"></div>
                <div class="chart-bar yellow" style="height: 75%;"></div>
                <div class="chart-bar yellow" style="height: 40%;"></div>
                <div class="chart-bar yellow" style="height: 60%;"></div>
                <div class="chart-bar yellow" style="height: 45%;"></div>
                <div class="chart-bar yellow" style="height: 20%;"></div>
            </div>
        </div>
    </div>

    <!-- Interactive Map Section -->
    <div class="dashboard-map-container">
        <!-- Embedded Google Maps (Canada / Map Placeholder) -->
        <iframe class="dashboard-map-iframe" 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1469550.0538914043!2d-80.443189!3d43.834789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cd44b1c1d1a8d05%3A0xe10ad5de81c4e7ab!2sToronto%2C%20ON%2C%20Canada!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
        </iframe>

        <!-- Map Marker Overlays (Abstract placing for mockup presentation) -->
        <div class="map-marker marker-green" style="top: 20%; left: 30%;">
            <div class="map-marker-inner"><i class="bi bi-person-fill"></i></div>
        </div>
        <div class="map-marker marker-green" style="top: 40%; left: 60%;">
            <div class="map-marker-inner"><i class="bi bi-person-fill"></i></div>
        </div>
        <div class="map-marker marker-yellow" style="top: 50%; left: 45%;">
            <div class="map-marker-inner"><i class="bi bi-taxi-front-fill"></i></div>
        </div>
        <div class="map-marker marker-yellow" style="top: 70%; left: 80%;">
            <div class="map-marker-inner"><i class="bi bi-taxi-front-fill"></i></div>
        </div>

        <!-- Ongoing Ride Overlay Detail Card -->
        <div class="ongoing-ride-card">
            <h4 class="ongoing-ride-header">Ongoing Ride</h4>
            
            <div class="ongoing-driver-info">
                <div class="ongoing-driver-left">
                    <img src="https://i.pravatar.cc/150?img=11" alt="Driver" class="ongoing-driver-avatar">
                    <div>
                        <h5 class="ongoing-driver-name">Sergio Morsis</h5>
                        <p class="ongoing-driver-stats">43 Rides (31 reviews)</p>
                    </div>
                </div>
                <a href="#" class="btn-call"><i class="bi bi-telephone"></i></a>
            </div>

            <!-- Vertical Route Timeline -->
            <div class="ride-timeline">
                <div class="timeline-point">
                    <div class="timeline-icon-start"></div>
                    <h6 class="timeline-title">Office</h6>
                    <p class="timeline-address">2972 Westheimer Rd. Santa Ana, Illinois 85486</p>
                </div>
                <div class="timeline-point">
                    <div class="timeline-icon-end"><i class="bi bi-geo-alt-fill"></i></div>
                    <h6 class="timeline-title">Coffee shop</h6>
                    <p class="timeline-address">1901 Thornridge Cir. Shiloh, Hawaii 81063</p>
                </div>
            </div>

            <!-- Ride Metrics Grid -->
            <div class="ride-metrics-grid">
                <div class="metric-item">
                    <span class="metric-label">Distance</span>
                    <span class="metric-value">0.2 km</span>
                </div>
                <div class="metric-item">
                    <span class="metric-label">Time</span>
                    <span class="metric-value">2 min</span>
                </div>
                <div class="metric-item">
                    <span class="metric-label">Fare</span>
                    <span class="metric-value">$25.00</span>
                </div>
            </div>

            <!-- Vehicle Detail -->
            <div class="ongoing-vehicle">
                <img src="https://images.unsplash.com/photo-1549317661-bc32c0734c11?auto=format&fit=crop&q=80&w=200" alt="Car" class="vehicle-thumb">
                <span class="vehicle-desc"><i class="bi bi-circle-fill text-dark" style="font-size: 6px; margin-right: 6px; vertical-align: middle;"></i> Black Suzuki Alto, (BKG-220)</span>
            </div>
        </div>
    </div>
</div>
@endsection
