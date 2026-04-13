@extends('admin.layout.master')

@section('title', 'Edit Driver | Riden Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/passenger.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/drivers.css') }}">
    <style>
        .edit-section-title {
            font-size: 14px;
            font-weight: 800;
            color: var(--riden-red);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .edit-section-title::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>
@endpush

@section('content')
<div class="col-12 px-0">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="passenger-page-title mb-0">Edit Driver Profile</h3>
            <p class="text-muted small fw-semibold">Update records for <strong>{{ $driver->first_name }} {{ $driver->last_name }}</strong></p>
        </div>
        <a href="{{ route('admin.drivers.view', $driver->id) }}" class="back-btn-small">
            <i class="bi bi-chevron-left"></i>
        </a>
    </div>

    <!-- Form Card -->
    <div class="figma-form-card">
        <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Section 1: Personal Info -->
            <div class="edit-section-title">
                <i class="bi bi-person-fill"></i> Personal Info
            </div>

            <div class="row g-4 mb-5">
                <!-- First Name -->
                <div class="col-md-6">
                    <label class="figma-label">First Name</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-person figma-input-icon"></i>
                        <input type="text" name="first_name" class="figma-input @error('first_name') is-invalid @enderror" value="{{ old('first_name', $driver->first_name) }}" placeholder="e.g. Haris" required>
                    </div>
                </div>

                <!-- Last Name -->
                <div class="col-md-6">
                    <label class="figma-label">Last Name</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-person figma-input-icon"></i>
                        <input type="text" name="last_name" class="figma-input @error('last_name') is-invalid @enderror" value="{{ old('last_name', $driver->last_name) }}" placeholder="e.g. Murtaza" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label class="figma-label">Email Address</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-envelope figma-input-icon"></i>
                        <input type="email" name="email" class="figma-input @error('email') is-invalid @enderror" value="{{ old('email', $driver->email) }}" placeholder="name@email.com" required>
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <label class="figma-label">Phone Number</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-telephone figma-input-icon"></i>
                        <input type="text" name="phone" class="figma-input @error('phone') is-invalid @enderror" value="{{ old('phone', $driver->phone) }}" placeholder="+92 XXX XXXXXXX" required>
                    </div>
                </div>

                <!-- Gender -->
                <div class="col-md-6">
                    <label class="figma-label">Gender</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-gender-ambiguous figma-input-icon"></i>
                        <select name="gender" class="figma-input figma-select" required>
                            <option value="Male" {{ old('gender', $driver->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $driver->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $driver->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <!-- Avatar -->
                <div class="col-md-6">
                    <label class="figma-label">Profile Image (Optional)</label>
                    <div class="figma-input-wrapper" style="border-style: dashed;">
                        <i class="bi bi-image figma-input-icon"></i>
                        <input type="file" name="avatar" class="figma-input" accept="image/*">
                    </div>
                    @if($driver->avatar)
                        <div class="mt-2 text-muted small fw-bold d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i> 
                            Current image exists
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section 2: Vehicle Info -->
            <div class="edit-section-title">
                <i class="bi bi-truck"></i> Vehicle Details
            </div>

            <div class="row g-4 mb-5">
                <!-- Model -->
                <div class="col-md-6">
                    <label class="figma-label">Vehicle Model</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-car-front figma-input-icon"></i>
                        <input type="text" name="model" class="figma-input @error('model') is-invalid @enderror" value="{{ old('model', $driver->vehicle->model ?? '') }}" placeholder="e.g. Toyota Corolla" required>
                    </div>
                </div>

                <!-- Year & Color -->
                <div class="col-md-3">
                    <label class="figma-label">Year</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-calendar figma-input-icon"></i>
                        <input type="text" name="year" class="figma-input @error('year') is-invalid @enderror" value="{{ old('year', $driver->vehicle->year ?? '') }}" placeholder="e.g. 2022" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="figma-label">Color</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-palette figma-input-icon"></i>
                        <input type="text" name="color" class="figma-input @error('color') is-invalid @enderror" value="{{ old('color', $driver->vehicle->color ?? '') }}" placeholder="e.g. White" required>
                    </div>
                </div>

                <!-- Plate -->
                <div class="col-md-6">
                    <label class="figma-label">License Plate</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-credit-card-2-front figma-input-icon"></i>
                        <input type="text" name="license_plate" class="figma-input @error('license_plate') is-invalid @enderror" value="{{ old('license_plate', $driver->vehicle->license_plate ?? '') }}" placeholder="e.g. ABC-1234" required>
                    </div>
                </div>

                <!-- Type -->
                <div class="col-md-6">
                    <label class="figma-label">Vehicle Type</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-grid figma-input-icon"></i>
                        <select name="vehicle_type" class="figma-input figma-select">
                            <option value="Sedan" {{ old('vehicle_type', $driver->vehicle->vehicle_type ?? '') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="Mini" {{ old('vehicle_type', $driver->vehicle->vehicle_type ?? '') == 'Mini' ? 'selected' : '' }}>Mini</option>
                            <option value="Luxury" {{ old('vehicle_type', $driver->vehicle->vehicle_type ?? '') == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="col-12 mt-5 pt-4 border-top">
                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn-figma-blue-pill px-5" style="width: auto;">
                        Update Driver Records
                    </button>
                    <a href="{{ route('admin.drivers.view', $driver->id) }}" class="text-decoration-none text-muted fw-bold small ms-2">
                        Cancel Changes
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
