@extends('admin.layout.master')

@section('title')
    Passenger Management
@endsection

@push('styles')
    <link href="{{ asset('assets/css/passenger.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 mt-2 mt-md-3">
    <div class="passenger-management-container">
        
        <!-- 1. Profile Identity Row -->
        <div class="profile-row-figma">
            <div class="profile-card-left">
                <a href="{{ route('passenger.management') }}" class="back-btn-small">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <div class="avatar-figma-wrapper">
                    <img src="https://i.pravatar.cc/150?img=12" class="avatar-figma-img" alt="Floyd Miles">
                    <span class="avatar-status-dot"></span>
                </div>
                <div class="profile-identity">
                    <h4>Floyd Miles</h4>
                    <div class="rating-line">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning" style="opacity: 0.3;"></i>
                        <span class="ms-1 fw-bold">(4.5)</span>
                    </div>
                </div>
            </div>
            <div class="since-date-label">
                Since March 23, 2023
            </div>
        </div>

        <!-- 2. Stats Banner -->
        <div class="figma-stats-banner mt-2">
            <!-- Total Rides -->
            <div class="figma-stat-unit">
                <div class="figma-stat-circle">
                    <!-- Using bi-truck as it is known to work in the sidebar -->
                    <i class="bi bi-truck"></i>
                </div>
                <div class="figma-stat-data">
                    <label>Total Rides</label>
                    <div class="fig-val">24</div>
                </div>
            </div>

            <div class="figma-divider"></div>

            <!-- Completed Rides -->
            <div class="figma-stat-unit">
                <div class="figma-stat-circle">
                    <i class="bi bi-truck"></i>
                    <div class="stat-badge-overlay">
                        <i class="bi bi-check-lg"></i>
                    </div>
                </div>
                <div class="figma-stat-data">
                    <label>Completed Rides</label>
                    <div class="fig-val">20</div>
                </div>
            </div>

            <div class="figma-divider"></div>

            <!-- Cancelled Rides -->
            <div class="figma-stat-unit">
                <div class="figma-stat-circle">
                    <i class="bi bi-truck"></i>
                    <div class="stat-badge-overlay">
                        <i class="bi bi-slash"></i>
                    </div>
                </div>
                <div class="figma-stat-data">
                    <label>Cancelled Rides</label>
                    <div class="fig-val">04</div>
                </div>
            </div>
        </div>

        <!-- 3. Sidebar & Content Grid -->
        <div class="row g-4 mt-3">
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-glass-card h-100 d-flex flex-column">
                    <div class="nav-figma-list" id="passengerTab" role="tablist">
                        <a class="nav-figma-item" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab">
                            <div class="ico-box"><i class="bi bi-person-fill"></i></div>
                            Personal Information
                        </a>
                        <a class="nav-figma-item active" id="rides-tab" data-bs-toggle="tab" href="#rides" role="tab">
                            <div class="ico-box"><i class="bi bi-truck"></i></div>
                            All Rides
                        </a>
                        <a class="nav-figma-item" id="payment-tab" data-bs-toggle="tab" href="#payment" role="tab">
                            <div class="ico-box"><i class="bi bi-credit-card-fill"></i></div>
                            Payment Methods
                        </a>
                    </div>
                    
                    <div class="sidebar-figma-actions mt-4">
                        <button class="btn-figma-red-solid mb-3" data-bs-toggle="modal" data-bs-target="#blockModal">
                            <i class="bi bi-slash-circle-fill"></i>
                            Block Passenger
                        </button>
                        <button class="btn-figma-red-outline" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash-fill text-danger"></i>
                            Delete Passenger
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-8">
                <div class="tab-content h-100">
                    
                    <!-- All Rides Tab -->
                    <div class="tab-pane fade show active" id="rides">
                        <div class="main-card-figma">
                            <div class="card-header-red-figma">
                                <i class="bi bi-truck"></i>
                                <h5>All Rides</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-head-figma">
                                        <tr>
                                            <th class="ps-4">Date</th>
                                            <th>Booking ID</th>
                                            <th>Customer</th>
                                            <th>Pickup</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body-figma">
                                        @for ($i = 0; $i < 5; $i++)
                                        <tr>
                                            <td class="ps-4">22 March 2025</td>
                                            <td class="fw-bold">#34565</td>
                                            <td>Jesse Showalter</td>
                                            <td class="text-muted small">123 Main Street, Suite 405, Toronto</td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <a href="#" class="view-all-figma">View All</a>
                        </div>
                    </div>

                    <!-- Personal Information Tab -->
                    <div class="tab-pane fade" id="personal">
                        <div class="main-card-figma">
                            <div class="card-header-red-figma">
                                <i class="bi bi-person-fill"></i>
                                <h5>Personal Information</h5>
                            </div>
                            <div class="p-4 px-5">
                                <div class="row g-4 mt-1">
                                    <div class="col-md-6">
                                        <label class="text-muted small fw-bold text-uppercase d-block mb-1">Full Name</label>
                                        <p class="mb-0 fw-bold">Floyd Miles</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small fw-bold text-uppercase d-block mb-1">Gender</label>
                                        <p class="mb-0 fw-bold">Male</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small fw-bold text-uppercase d-block mb-1">Email Address</label>
                                        <p class="mb-0 fw-bold">miles.floyd@gmail.com</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small fw-bold text-uppercase d-block mb-1">Phone Number</label>
                                        <p class="mb-0 fw-bold">+1 123 456 7890</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods Tab -->
                    <div class="tab-pane fade" id="payment">
                        <div class="main-card-figma">
                            <div class="card-header-red-figma">
                                <i class="bi bi-credit-card-fill"></i>
                                <h5>Payment Methods</h5>
                            </div>
                            <div class="p-4 px-5">
                                <h6 class="text-danger fw-bold mb-4 mt-2">Primary Methods</h6>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:40px; text-align:center;"><img src="https://img.icons8.com/color/48/visa.png" width="26"></div>
                                        <span class="fw-bold">Visa</span>
                                    </div>
                                    <span class="fw-bold">********234</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:40px; text-align:center;"><img src="https://img.icons8.com/color/48/apple-pay.png" width="26"></div>
                                        <span class="fw-bold">Apple Pay</span>
                                    </div>
                                    <span class="fw-bold">********234</span>
                                </div>

                                <h6 class="text-danger fw-bold mb-4 mt-5">Other Methods</h6>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:40px; text-align:center;"><img src="https://img.icons8.com/color/48/mastercard.png" width="26"></div>
                                        <span class="fw-bold">Mastercard</span>
                                    </div>
                                    <span class="fw-bold">********234</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.passenger.modals')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabLinks = document.querySelectorAll('.nav-figma-item');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            tabLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            tabPanes.forEach(pane => pane.classList.remove('show', 'active'));
            const targetId = this.getAttribute('href').substring(1);
            document.getElementById(targetId).classList.add('show', 'active');
        });
    });
});
</script>
@endsection
