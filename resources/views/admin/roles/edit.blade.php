@extends('admin.layout.master')

@section('title', 'Admin Roles')

@push('styles')
    <link href="{{ asset('assets/css/addadmin.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 riden-addadmin-wrap">
   

    <!-- Subheader with Back Button -->
    <div class="riden-addadmin-head mb-2">
        <a href="{{ route('admin.roles.index') }}" class="riden-addadmin-back text-decoration-none">
            <i class="bi bi-chevron-left"></i>
        </a>
        <h2 class="riden-addadmin-title mb-0">Edit Admin</h2>
    </div>

    <!-- Main Creation Card -->
    <div class="card riden-addadmin-card border-0 shadow-sm p-2">
        <form action="{{ route('admin.roles.update', $admin->id) }}" method="POST">
            @csrf

            <!-- Section 1: Admin Details -->
            <div class="riden-addadmin-section mb-2 d-flex justify-content-between align-items-center">
                <span>Admin Details</span>
                <div class="form-check form-switch cursor-pointer">
                    <input class="form-check-input" type="checkbox" name="is_super" value="1" id="superAdminSwitch" {{ old('is_super', $admin->is_super) ? 'checked' : '' }}>
                    <label class="form-check-label ms-2 text-danger fw-bold" for="superAdminSwitch" style="font-size: 14px;">Make Super Admin</label>
                </div>
            </div>
            
            <div class="row g-2">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label">Name</label>
                        <input type="text" name="name" class="form-control riden-input @error('name') is-invalid @enderror" value="{{ old('name', $admin->name) }}" placeholder="Enter Admin Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label">Email</label>
                        <input type="email" name="email" class="form-control riden-input @error('email') is-invalid @enderror" value="{{ old('email', $admin->email) }}" placeholder="Enter email address">
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
                            <input type="text" name="phone" class="form-control riden-input flex-grow-1 @error('phone') is-invalid @enderror" value="{{ old('phone', $admin->phone) }}" placeholder="000 000 0000">
                        </div>
                        @error('phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: Access Module -->
            <div class="riden-addadmin-section my-2">Access Module</div>
            
            <div class="riden-modules-grid">
                @php
                    $modules = [
                        'Dashboard', 'Reviews & Ratings', 'Passenger Management',
                        'Analytics/Stats', 'Promo code Management', 'Advertising Management',
                        'Admin Roles', 'Fare Management', 'Support Ticket',
                        'Driver Management', 'Commission Management', 'Notifications',
                        'Vehicles Management', 'Payment Management', 'CMS management',
                        'Booking Management', 'Report Management', 'Settings'
                    ];
                    $adminModules = is_array($admin->modules) ? $admin->modules : [];
                @endphp

                @foreach($modules as $module)
                <div class="form-check custom-module-check">
                    <input class="form-check-input module-checkbox" type="checkbox" name="modules[]" value="{{ $module }}" id="mod_{{ Str::slug($module) }}" 
                        {{ (is_array(old('modules')) ? in_array($module, old('modules')) : in_array($module, $adminModules)) ? 'checked' : '' }}
                        {{ $admin->is_super ? 'disabled' : '' }}>
                    <label class="form-check-label ms-2" for="mod_{{ Str::slug($module) }}">
                        {{ $module }}
                    </label>
                </div>
                @endforeach
            </div>

            <!-- Section 3: Update Password -->
            <div class="riden-addadmin-section my-2">Update Password (Leave blank to keep current)</div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label">New Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" class="form-control riden-input pe-5 @error('password') is-invalid @enderror" placeholder="New Password" id="pass_main">
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
                            <input type="password" name="password_confirmation" class="form-control riden-input pe-5" placeholder="Confirm Password" id="pass_confirm">
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 opacity-50 cursor-pointer" onclick="togglePass('pass_confirm')"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden timestamp for manual update tracking -->
            <input type="hidden" name="updated_at" id="h_updated_at">

            <!-- Footer Actions -->
            <div class="riden-actions d-flex justify-content-end gap-3 pt-3">
                <button type="submit" class="btn btn-riden-danger px-5">Update Admin</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-riden-outline px-5 d-flex align-items-center justify-content-center" style="text-decoration: none;">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
// Senior Developer Check: Ensure timestamps are injected from the frontend as requested
function getLaravelTimestamp() {
    const now = new Date();
    return now.getFullYear() + '-' +
        String(now.getMonth() + 1).padStart(2, '0') + '-' +
        String(now.getDate()).padStart(2, '0') + ' ' +
        String(now.getHours()).padStart(2, '0') + ':' +
        String(now.getMinutes()).padStart(2, '0') + ':' +
        String(now.getSeconds()).padStart(2, '0');
}

document.querySelector('form').addEventListener('submit', function(e) {
    document.getElementById('h_updated_at').value = getLaravelTimestamp();
});
</script>

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

document.getElementById('superAdminSwitch').addEventListener('change', function() {
    const isSuper = this.checked;
    const checkboxes = document.querySelectorAll('.module-checkbox');
    checkboxes.forEach(cb => {
        cb.disabled = isSuper;
        if (isSuper) cb.checked = false;
    });
});
</script>
@endsection
