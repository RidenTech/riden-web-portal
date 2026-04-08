@extends('admin.layout.master')

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
