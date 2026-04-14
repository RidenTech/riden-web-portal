@extends('admin.layout.master')

@section('title', 'Passenger Profile')

@push('styles')
    <link href="{{ asset('assets/css/drivers.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 driver-detail-wrapper px-0">
    <!-- 1. Profile Header -->
    <div class="profile-row-driver">
        <div class="profile-card-left">
            <a href="{{ route('admin.passenger.management') }}" class="back-btn-driver">
                <i class="bi bi-chevron-left"></i>
            </a>
            <div class="driver-avatar-view-wrapper">
                @if($passenger->avatar)
                    <img src="{{ asset('storage/'.$passenger->avatar) }}" class="driver-avatar-view-img" alt="">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($passenger->first_name . ' ' . $passenger->last_name) }}&background=random" class="driver-avatar-view-img" alt="">
                @endif
            </div>
            <div class="driver-identity">
                <h4>{{ $passenger->first_name }} {{ $passenger->last_name }}</h4>
                <div class="driver-rating-line">
                    <div class="stars text-warning d-flex gap-1">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill" style="opacity: 0.3;"></i>
                    </div>
                    <span class="ms-2 fw-semibold">(4.5)</span>
                    <span class="ms-3 status-badge {{ strtolower($passenger->status) == 'active' ? 'online' : (strtolower($passenger->status) == 'blocked' ? 'blocked' : 'suspended') }}">{{ $passenger->status }}</span>
                </div>
            </div>
        </div>
        <div class="since-date-view text-muted">
            Registered: {{ $passenger->created_at->format('M d, Y') }}
        </div>
    </div>

    <!-- 2. Stats Banner -->
    <div class="driver-stats-banner mt-2">
        <div class="driver-stat-unit">
            <div class="driver-stat-circle">
                <i class="bi bi-truck"></i>
            </div>
            <div class="driver-stat-data">
                <label>Total Rides</label>
                <div class="stat-value">0</div>
            </div>
        </div>
        <div class="driver-divider"></div>
        <div class="driver-stat-unit">
            <div class="driver-stat-circle">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="driver-stat-data">
                <label>Completed</label>
                <div class="stat-value">0</div>
            </div>
        </div>
        <div class="driver-divider"></div>
        <div class="driver-stat-unit">
            <div class="driver-stat-circle">
                <i class="bi bi-slash-circle-fill" style="color: #666;"></i>
            </div>
            <div class="driver-stat-data">
                <label>Cancelled</label>
                <div class="stat-value">0</div>
            </div>
        </div>
    </div>

    <!-- 3. Navigation & Detail Grid -->
    <div class="row g-2 mt-0">
        <!-- Sidebar Navigation -->
        <div class="col-lg-4">
            <div class="driver-nav-list pt-1" id="passengerTabList" role="tablist">
                <a href="#personal" class="driver-nav-item active border-0 w-100 text-start text-decoration-none" data-bs-toggle="pill" data-bs-target="#personal" role="tab">
                    <div class="icon-wrapper"><i class="bi bi-person-fill"></i></div>
                    Personal Information
                </a>
                <a href="#rides" class="driver-nav-item border-0 w-100 text-start text-decoration-none" data-bs-toggle="pill" data-bs-target="#rides" role="tab">
                    <div class="icon-wrapper"><i class="bi bi-truck"></i></div>
                    All Rides
                </a>
                <a href="#payment" class="driver-nav-item border-0 w-100 text-start text-decoration-none" data-bs-toggle="pill" data-bs-target="#payment" role="tab">
                    <div class="icon-wrapper"><i class="bi bi-credit-card-fill"></i></div>
                    Payment Methods
                </a>
            </div>

            <!-- Action Buttons -->
            <div class="driver-action-buttons">
                @if($passenger->status == 'Active')
                    <form action="{{ route('admin.passenger.toggleStatus', $passenger->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn-driver-action btn-driver-solid-red">
                            <i class="bi bi-slash-circle-fill"></i> Block Passenger
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.passenger.toggleStatus', $passenger->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn-driver-action btn-driver-solid-red" >
                            <i class="bi bi-check-circle-fill"></i> Unblock Passenger
                        </button>
                    </form>
                @endif

                <button class="btn-driver-action btn-driver-outline-red" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="bi bi-trash-fill text-danger"></i> Delete Passenger
                </button>
            </div>
        </div>

        <!-- Detail Content -->
        <div class="col-lg-8">
            <div class="tab-content h-100" id="passengerTabContent">
                <!-- Personal Info Section -->
                <div class="tab-pane fade show active" id="personal">
                    <div class="driver-info-card">
                        <div class="driver-info-card-header" style="background: var(--riden-red) !important; display: flex; justify-content: space-between; align-items: center;">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-person-fill"></i>
                                <h5>Personal Details</h5>
                            </div>
                            <a href="{{ route('admin.passenger.edit', $passenger->id) }}" class="text-white text-decoration-none small fw-bold">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                        </div>
                        <div class="driver-info-grid">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="label-view">Full Name</label>
                                    <p class="value-view">{{ $passenger->first_name }} {{ $passenger->last_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="label-view">Email Address</label>
                                    <p class="value-view">{{ $passenger->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="label-view">Phone Number</label>
                                    <p class="value-view">{{ $passenger->phone }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="label-view">Gender</label>
                                    <p class="value-view">{{ $passenger->gender }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="label-view">Unique ID</label>
                                    <p class="value-view red-text">{{ $passenger->unique_id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- All Rides Section -->
                <div class="tab-pane fade" id="rides">
                    <div class="driver-info-card">
                        <div class="driver-info-card-header" style="background: var(--riden-red) !important;">
                            <i class="bi bi-car-front-fill"></i>
                            <h5>Recent Ride History</h5>
                        </div>
                        <div class="driver-info-grid text-center py-5">
                            <img src="{{ asset('assets/img/no-data.svg') }}" alt="" style="width: 150px; opacity: 0.5;">
                            <p class="text-muted mt-3">No ride data available yet.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Methods Section -->
                <div class="tab-pane fade" id="payment">
                    <div class="driver-info-card">
                        <div class="driver-info-card-header" style="background: var(--riden-red) !important;">
                            <i class="bi bi-credit-card-fill"></i>
                            <h5>Payment Methods</h5>
                        </div>
                        <div class="driver-info-grid">
                            <h6 class="text-danger fw-semibold mb-4 mt-2">Primary Methods</h6>
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width:40px; text-align:center;"><img src="https://img.icons8.com/color/48/visa.png" width="32"></div>
                                    <span class="value-view">Visa</span>
                                </div>
                                <span class="value-view text-muted">********234</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width:40px; text-align:center;"><img src="https://img.icons8.com/color/48/apple-pay.png" width="32"></div>
                                    <span class="value-view">Apple Pay</span>
                                </div>
                                <span class="value-view text-muted">********234</span>
                            </div>

                            <h6 class="text-danger fw-semibold mb-4 mt-5">Other Methods</h6>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width:40px; text-align:center;"><img src="https://img.icons8.com/color/48/mastercard.png" width="32"></div>
                                    <span class="value-view">Mastercard</span>
                                </div>
                                <span class="value-view text-muted">********234</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('admin.passenger.modals')

@endsection

@push('scripts')
<script>
    // Manual fallback for tab switching if Bootstrap JS fails
    document.querySelectorAll('.driver-nav-item').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            
            // Remove active from all siblings
            document.querySelectorAll('.driver-nav-item').forEach(l => l.classList.remove('active'));
            // Add active to clicked
            this.classList.add('active');
            
            // Hide all panes
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            
            // Show target pane
            const targetId = this.getAttribute('data-bs-target');
            const targetPane = document.querySelector(targetId);
            if (targetPane) {
                targetPane.classList.add('show', 'active');
            }
        });
    });
</script>
@endpush
