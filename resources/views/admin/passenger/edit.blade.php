@extends('admin.layout.master')

@section('title')
    Edit Passenger | Riden Admin
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/passenger.css') }}">
@endpush

@section('content')
<div class="col-12 px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="passenger-page-title mb-0">Edit Passenger</h3>
            <p class="text-muted small fw-semibold">Update passenger information for <strong>{{ $passenger->first_name }}</strong></p>
        </div>
        <a href="{{ route('admin.passenger.detail', $passenger->id) }}" class="back-btn-small">
            <i class="bi bi-chevron-left"></i>
        </a>
    </div>

    <div class="figma-form-card">
        <form action="{{ route('admin.passenger.update', $passenger->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <!-- First Name -->
                <div class="col-md-6">
                    <label class="figma-label">First Name</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-person figma-input-icon"></i>
                        <input type="text" name="first_name" class="figma-input @error('first_name') is-invalid @enderror" value="{{ old('first_name', $passenger->first_name) }}" placeholder="e.g. John" required>
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
                        <input type="text" name="last_name" class="figma-input @error('last_name') is-invalid @enderror" value="{{ old('last_name', $passenger->last_name) }}" placeholder="e.g. Doe" required>
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
                        <input type="email" name="email" class="figma-input @error('email') is-invalid @enderror" value="{{ old('email', $passenger->email) }}" placeholder="john.doe@example.com" required>
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
                        <input type="text" name="phone" class="figma-input @error('phone') is-invalid @enderror" value="{{ old('phone', $passenger->phone) }}" placeholder="+1 234 567 890" required>
                    </div>
                    @error('phone')
                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gender -->
                <div class="col-md-6">
                    <label class="figma-label">Gender</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-gender-ambiguous figma-input-icon"></i>
                        <select name="gender" class="figma-input figma-select @error('gender') is-invalid @enderror" required>
                            <option value="" disabled>Select gender</option>
                            <option value="Male" {{ old('gender', $passenger->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $passenger->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $passenger->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    @error('gender')
                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password (Optional) -->
                <div class="col-md-6">
                    <label class="figma-label">New Password (Leave blank to keep current)</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-lock figma-input-icon"></i>
                        <input type="password" name="password" class="figma-input @error('password') is-invalid @enderror" placeholder="••••••••">
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="col-12 mt-5 pt-3 border-top">
                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn-figma-blue-pill px-5" style="width: auto;">
                            Update Passenger Records
                        </button>
                        <a href="{{ route('admin.passenger.detail', $passenger->id) }}" class="text-decoration-none text-muted fw-bold small ms-2">
                            Cancel Changes
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
