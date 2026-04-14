@extends('admin.layout.master')

@section('title', 'Driver Management - Floyd Miles')

@push('styles')
    <link href="{{ asset('assets/css/drivers.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 driver-detail-wrapper px-0">
    <!-- 1. Profile Header -->
    <div class="profile-row-driver">
        <div class="profile-card-left">
            <a href="{{ route('admin.drivers.directory') }}" class="back-btn-driver">
                <i class="bi bi-chevron-left"></i>
            </a>
            <div class="driver-avatar-view-wrapper">
                <img src="https://i.pravatar.cc/150?img=19" class="driver-avatar-view-img" alt="Floyd Miles">
            </div>
            <div class="driver-identity">
                <h4>Floyd Miles</h4>
                <div class="driver-rating-line">
                    <div class="stars text-warning d-flex gap-1">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </div>
                    <span class="ms-2 fw-semibold">(4.5)</span>
                </div>
            </div>
        </div>
        <div class="since-date-view">
            Since March 23, 2023
        </div>
    </div>

    <!-- 2. Stats Banner (Populated for Active Driver) -->
    <div class="driver-stats-banner mt-2">
        <div class="driver-stat-unit">
            <div class="driver-stat-circle">
                <i class="bi bi-truck"></i>
            </div>
            <div class="driver-stat-data">
                <label>Total Rides</label>
                <div class="stat-value">243</div>
            </div>
        </div>
        <div class="driver-divider"></div>
        <div class="driver-stat-unit">
            <div class="driver-stat-circle">
                <i class="bi bi-truck"></i>
                <div class="stat-badge-overlay" style="position: absolute; top: -5px; right: -5px; background: #D10000; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 10px; border: 2px solid #fff;">
                    <i class="bi bi-check-lg" style="color: white; font-size: 10px;"></i>
                </div>
            </div>
            <div class="driver-stat-data">
                <label>Completed Rides</label>
                <div class="stat-value">1023</div>
            </div>
        </div>
        <div class="driver-divider"></div>
        <div class="driver-stat-unit">
            <div class="driver-stat-circle">
                <i class="bi bi-truck"></i>
                <div class="stat-badge-overlay" style="position: absolute; top: -5px; right: -5px; background: #D10000; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 10px; border: 2px solid #fff;">
                    <i class="bi bi-slash" style="color: white; font-size: 10px;"></i>
                </div>
            </div>
            <div class="driver-stat-data">
                <label>Cancelled Rides</label>
                <div class="stat-value">27</div>
            </div>
        </div>
        <div class="driver-divider"></div>
        <div class="driver-stat-unit">
            <div class="driver-stat-circle">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="driver-stat-data">
                <label>Revenue</label>
                <div class="stat-value">$4050</div>
            </div>
        </div>
    </div>

    <!-- 3. Navigation & Detail Grid -->
    <div class="row g-2 mt-0 ">
        <!-- Sidebar Navigation -->
        <div class="col-lg-4">
            <div class="driver-nav-list" id="driverTabList">
                <a href="#personal" class="driver-nav-item active" data-bs-toggle="tab">
                    <div class="icon-wrapper"><i class="bi bi-person-fill"></i></div>
                    Personal Information
                </a>
                <a href="#documents" class="driver-nav-item" data-bs-toggle="tab">
                    <div class="icon-wrapper"><i class="bi bi-file-earmark-text-fill"></i></div>
                    Documents
                </a>
                <a href="#vehicle" class="driver-nav-item" data-bs-toggle="tab">
                    <div class="icon-wrapper"><i class="bi bi-truck"></i></div>
                    Vehicle Information
                </a>
                <a href="#rides" class="driver-nav-item" data-bs-toggle="tab">
                    <div class="icon-wrapper"><i class="bi bi-map-fill"></i></div>
                    All Rides
                </a>
                <a href="#payment" class="driver-nav-item" data-bs-toggle="tab">
                    <div class="icon-wrapper"><i class="bi bi-credit-card-fill"></i></div>
                    Payment Methods
                </a>
            </div>

            <!-- Action Buttons -->
            <div class="driver-action-buttons">
                <button class="btn-driver-action btn-driver-solid-red">
                    <i class="bi bi-slash-circle-fill"></i>
                    Block Driver
                </button>
                <button class="btn-driver-action btn-driver-outline-red">
                    <i class="bi bi-pause-circle-fill text-danger"></i>
                    Suspend Driver
                </button>
                <button class="btn-driver-action btn-driver-outline-red">
                    <i class="bi bi-trash-fill text-danger"></i>
                    Delete Driver
                </button>
            </div>
        </div>

        <!-- Detail Content -->
        <div class="col-lg-8">
            <div class="tab-content h-100" id="driverTabContent">
                <!-- Personal Info Section -->
                <div class="tab-pane fade show active" id="personal">
                    @include('admin.drivers.sections.personal_active')
                </div>
                
                <!-- Documents Section -->
                <div class="tab-pane fade" id="documents">
                    @include('admin.drivers.sections.documents_active')
                </div>

                <!-- Vehicle Information Section -->
                <div class="tab-pane fade" id="vehicle">
                    @include('admin.drivers.sections.vehicle_active')
                </div>
                <!-- All Rides Section -->
                <div class="tab-pane fade" id="rides">
                    @include('admin.drivers.sections.rides_active')
                </div>
                <!-- Payment Methods Section -->
                <div class="tab-pane fade" id="payment">
                    @include('admin.drivers.sections.payments_active')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Document Preview Modal -->
<div class="modal fade" id="docModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content doc-modal-content" style="border-radius: 25px !important; border: none; overflow: hidden;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-semibold" id="docModalLabel">Document Title</h5>
                <div class="ms-auto d-flex gap-2 align-items-center">
                    <button class="btn btn-success btn-approve-doc px-4" style="background: #28a745 !important; border: none; border-radius: 10px; font-weight: 600;">Approve</button>
                    <button class="btn btn-danger btn-reject-doc px-4" style="background: #D10000 !important; border: none; border-radius: 10px; font-weight: 600;">Reject</button>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4">
                <div class="doc-images-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                    @for($i=1; $i<=4; $i++)
                    <div class="doc-img-container">
                        <img src="https://placehold.co/600x800?text=Document+Page+{{ $i }}" class="img-fluid rounded border" style="width: 100%; height: auto; object-fit: cover;" alt="Doc Page">
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Global function - must be outside DOMContentLoaded so onclick can call it
function openDocument(title) {
    var modalEl = document.getElementById('docModal');
    if (!modalEl) { 
        RidenSwal.fire({
            icon: 'error',
            title: 'Technical Issue',
            text: 'Preview modal could not be initialized. Please refresh the page.'
        });
        return; 
    }
    modalEl.querySelector('.modal-title').textContent = title;
    var modal = new bootstrap.Modal(modalEl);
    modal.show();
}

document.addEventListener('DOMContentLoaded', function() {
    // Sidebar Tab Logic
    var tabLinks = document.querySelectorAll('.driver-nav-item');
    var tabPanes = document.querySelectorAll('.tab-pane');

    tabLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            tabLinks.forEach(function(l) { l.classList.remove('active'); });
            this.classList.add('active');
            tabPanes.forEach(function(pane) { pane.classList.remove('show', 'active'); });
            var targetId = this.getAttribute('href').substring(1);
            var targetPane = document.getElementById(targetId);
            if (targetPane) { targetPane.classList.add('show', 'active'); }
        });
    });
});
</script>
@endpush
@endsection
