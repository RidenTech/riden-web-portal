@extends('admin.layout.master')

@section('title')
    RIDEN | Webportal
@endsection

@push('styles')
    <link href="{{ asset('assets/css/addadmin.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 riden-addadmin-wrap">

    <!-- Subheader with Back Button -->
    <div class="riden-addadmin-head mb-2">
        <a href="{{ route('admin.passenger.detail', $passenger->id) }}" class="riden-addadmin-back text-decoration-none">
            <i class="bi bi-chevron-left"></i>
        </a>
        <h2 class="riden-addadmin-title mb-0">Edit Passenger</h2>
    </div>

    <!-- Main Card -->
    <div class="card riden-addadmin-card border-0 shadow-sm p-2">
        <form action="{{ route('admin.passenger.update', $passenger->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="riden-addadmin-section mb-2 d-flex justify-content-between align-items-center">
                <span>Passenger Details</span>
                <span class="text-muted small fw-normal" style="font-size: 14px;">Update passenger information for <strong style="color:var(--text-main);">{{ $passenger->first_name }}</strong></span>
            </div>

            <div class="row g-2">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label">First Name</label>
                        <input type="text" name="first_name" class="form-control riden-input @error('first_name') is-invalid @enderror" value="{{ old('first_name', $passenger->first_name) }}" placeholder="e.g. John" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control riden-input @error('last_name') is-invalid @enderror" value="{{ old('last_name', $passenger->last_name) }}" placeholder="e.g. Doe" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label">Email Address</label>
                        <input type="email" name="email" class="form-control riden-input @error('email') is-invalid @enderror" value="{{ old('email', $passenger->email) }}" placeholder="john.doe@example.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label">Phone Number</label>
                        <div class="riden-phone">
                            <div class="riden-flag">
                                <img src="https://flagcdn.com/w40/ca.png" alt="CA">
                                <span>+1</span>
                            </div>
                            <input type="text" name="phone" class="form-control riden-input flex-grow-1 @error('phone') is-invalid @enderror" value="{{ old('phone', $passenger->phone) }}" placeholder="000 000 0000" required>
                        </div>
                        @error('phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label">Gender</label>
                        <select name="gender" class="form-select riden-input @error('gender') is-invalid @enderror" required>
                            <option value="" disabled>Select gender</option>
                            <option value="Male" {{ old('gender', $passenger->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $passenger->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $passenger->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="riden-addadmin-section my-2">Update Password (Leave blank to keep current)</div>
            
            <div class="row g-4 mb-3">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label">New Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" class="form-control riden-input pe-5 @error('password') is-invalid @enderror" placeholder="••••••••" id="pass_main">
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 opacity-50 cursor-pointer" onclick="togglePass('pass_main')"></i>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label">Confirm New Password</label>
                        <div class="position-relative">
                            <input type="password" name="password_confirmation" class="form-control riden-input pe-5" placeholder="••••••••" id="pass_confirm">
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 opacity-50 cursor-pointer" onclick="togglePass('pass_confirm')"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="riden-actions d-flex justify-content-end gap-3 pt-3">
                <button type="submit" class="btn btn-riden-danger px-5">Update Passenger</button>
                <a href="{{ route('admin.passenger.detail', $passenger->id) }}" class="btn btn-riden-outline px-5 d-flex align-items-center justify-content-center" style="text-decoration: none;">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
function togglePass(id) {
    const input = document.getElementById(id);
    const icon = input.nextElementSibling;
    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    } else {
        input.type = "password";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    }
}
</script>
@endsection
