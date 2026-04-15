@extends('admin.layout.master')

@section('title', 'Passenger Management')

@push('styles')
    <link href="{{ asset('assets/css/passenger.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/drivers.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 driver-detail-wrapper px-0">
    <form action="{{ route('admin.passenger.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 1. Profile Header Placeholder (Matched with Driver) -->
        <div class="profile-row-driver mb-4">
            <div class="profile-card-left">
                <a href="{{ route('admin.passenger.management') }}" class="back-btn-driver">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <div class="placeholder-avatar-ring">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <div class="driver-identity">
                    <h4>Add New Passenger</h4>
                    <div class="driver-rating-line">
                        <span class="text-muted fw-semibold">Fill in the details to register a new passenger</span>
                    </div>
                </div>
            </div>
            <div class="since-date-view text-muted">
                {{ date('M d, Y') }}
            </div>
        </div>

        <!-- 3. Navigation & Detail Grid -->
        <div class="row g-2 mt-0">
            <!-- Sidebar Navigation -->
            <div class="col-lg-4">
                <div class="driver-nav-list pt-1" id="driverTabList" role="tablist">
                    <a href="#personal" class="driver-nav-item active border-0 w-100 text-start text-decoration-none" data-bs-toggle="pill" data-bs-target="#personal" role="tab">
                        <div class="icon-wrapper"><i class="bi bi-person-fill"></i></div>
                        Personal Information
                    </a>
                    <a href="#security" class="driver-nav-item border-0 w-100 text-start text-decoration-none" data-bs-toggle="pill" data-bs-target="#security" role="tab">
                        <div class="icon-wrapper"><i class="bi bi-shield-lock-fill"></i></div>
                        Account Security
                    </a>
                </div>

                <!-- Action Button -->
                <div class="driver-action-buttons mt-4">
                    <button type="submit" class="btn-download-excel border-0 mb-3 py-3 w-100 justify-content-center">
                        <i class="bi bi-check-circle-fill"></i> Complete Registration
                    </button>
                    <a href="{{ route('admin.passenger.management') }}" class="btn-driver-action btn-driver-outline-red text-decoration-none">
                        Cancel and Return
                    </a>
                </div>
            </div>

            <!-- Detail Content -->
            <div class="col-lg-8">
                <div class="tab-content h-100" id="driverTabContent">
                    <!-- Personal Info Section -->
                    <div class="tab-pane fade show active" id="personal">
                        <div class="driver-info-card">
                            <div class="driver-info-card-header" style="background: var(--riden-red) !important;">
                                <i class="bi bi-person-fill"></i>
                                <h5>Personal Details</h5>
                            </div>
                            <div class="driver-info-grid px-4 py-4">
                                <div class="row g-4">
                                    <div class="col-md-12 mb-2">
                                        <label class="figma-label">Profile Image</label>
                                        <div class="figma-input-wrapper" style="border-style: dashed;">
                                            <i class="bi bi-image figma-input-icon"></i>
                                            <input type="file" name="avatar" class="figma-input" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="figma-label">First Name</label>
                                        <div class="figma-input-wrapper">
                                            <i class="bi bi-person figma-input-icon"></i>
                                            <input type="text" name="first_name" class="figma-input" placeholder="e.g. John" value="{{ old('first_name') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="figma-label">Last Name</label>
                                        <div class="figma-input-wrapper">
                                            <i class="bi bi-person figma-input-icon"></i>
                                            <input type="text" name="last_name" class="figma-input" placeholder="e.g. Doe" value="{{ old('last_name') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="figma-label">Email Address</label>
                                        <div class="figma-input-wrapper">
                                            <i class="bi bi-envelope figma-input-icon"></i>
                                            <input type="email" name="email" class="figma-input" placeholder="john.doe@example.com" value="{{ old('email') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="figma-label">Phone Number</label>
                                        <div class="figma-input-wrapper">
                                            <i class="bi bi-telephone figma-input-icon"></i>
                                            <input type="text" name="phone" class="figma-input" placeholder="+1 234 567 890" value="{{ old('phone') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="figma-label">Gender</label>
                                        <div class="figma-input-wrapper">
                                            <i class="bi bi-gender-ambiguous figma-input-icon"></i>
                                            <select name="gender" class="figma-input figma-select" required>
                                                <option value="" disabled selected>Select gender</option>
                                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div class="tab-pane fade" id="security">
                        <div class="driver-info-card">
                            <div class="driver-info-card-header" style="background: var(--riden-red) !important;">
                                <i class="bi bi-shield-lock-fill"></i>
                                <h5>Account Security</h5>
                            </div>
                            <div class="driver-info-grid px-4 py-4">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="figma-label">Password</label>
                                        <div class="figma-input-wrapper">
                                            <i class="bi bi-lock figma-input-icon"></i>
                                            <input type="password" name="password" class="figma-input" placeholder="••••••••" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="figma-label">Confirm Password</label>
                                        <div class="figma-input-wrapper">
                                            <i class="bi bi-shield-lock figma-input-icon"></i>
                                            <input type="password" name="password_confirmation" class="figma-input" placeholder="••••••••" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="alert alert-info border-0 rounded-4" style="background: rgba(59, 130, 246, 0.05);">
                                            <i class="bi bi-info-circle-fill me-2 text-primary"></i>
                                            <small class="text-muted fw-semibold">Password must be at least 8 characters long and include confirmation.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Manual fallback for tab switching
    document.querySelectorAll('.driver-nav-item').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            
            document.querySelectorAll('.driver-nav-item').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            
            const targetId = this.getAttribute('data-bs-target');
            const targetPane = document.querySelector(targetId);
            if (targetPane) {
                targetPane.classList.add('show', 'active');
            }
        });
    });
</script>
@endpush
@section('title')
    Add New Passenger | Riden Admin
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/passenger.css') }}">
@endpush

@section('content')
<div class="col-12 px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="passenger-page-title mb-0">Add New Passenger</h3>
            <p class="text-muted small fw-semibold">Register a new passenger to the system</p>
        </div>
        <a href="{{ route('admin.passenger.management') }}" class="back-btn-small">
            <i class="bi bi-chevron-left"></i>
        </a>
    </div>

    <div class="figma-form-card">
        <form action="{{ route('admin.passenger.store') }}" method="POST">
            @csrf
            
            <div class="row g-4">
                <!-- First Name -->
                <div class="col-md-6">
                    <label class="figma-label">First Name</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-person figma-input-icon"></i>
                        <input type="text" name="first_name" class="figma-input @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="e.g. John" required>
                    </div>
                    @error('first_name')
                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="col-md-6">
                    <label class="figma-label">Last Name</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-person figma-input-icon"></i>
                        <input type="text" name="last_name" class="figma-input @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="e.g. Doe" required>
                    </div>
                    @error('last_name')
                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label class="figma-label">Email Address</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-envelope figma-input-icon"></i>
                        <input type="email" name="email" class="figma-input @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="john.doe@example.com" required>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="col-md-6">
                    <label class="figma-label">Phone Number</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-telephone figma-input-icon"></i>
                        <input type="text" name="phone" class="figma-input @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="+1 234 567 890" required>
                    </div>
                    @error('phone')
                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="col-md-6">
                    <label class="figma-label">Password</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-lock figma-input-icon"></i>
                        <input type="password" name="password" class="figma-input @error('password') is-invalid @enderror" placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="col-md-6">
                    <label class="figma-label">Confirm Password</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-shield-lock figma-input-icon"></i>
                        <input type="password" name="password_confirmation" class="figma-input" placeholder="••••••••" required>
                    </div>
                </div>

                <!-- Gender -->
                <div class="col-md-6">
                    <label class="figma-label">Gender</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-gender-ambiguous figma-input-icon"></i>
                        <select name="gender" class="figma-input figma-select @error('gender') is-invalid @enderror" required>
                            <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    @error('gender')
                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="col-12 mt-5 pt-3 border-top">
                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn-figma-red-solid px-5" style="width: auto;">
                            Save Passenger Information
                        </button>
                        <a href="{{ route('admin.passenger.management') }}" class="text-decoration-none text-muted fw-bold small ms-2">
                            Cancel and Return
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
