@extends('admin.layout.master')

@section('title', 'Add New Admin')

@push('styles')
    <link href="{{ asset('assets/css/roles.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 roles-wrapper mt-3">
    <!-- Header -->
    <div class="roles-header">
        <h1 class="roles-title">Admin Roles</h1>
    </div>

    <!-- Subheader with Back Button -->
    <div class="roles-subheader">
        <a href="{{ route('admin.roles.index') }}" class="btn-back-roles">
            <i class="bi bi-chevron-left"></i>
        </a>
        <h2 class="roles-subheader-title">Add New Admin</h2>
    </div>

    <!-- Main Creation Card -->
    <div class="roles-content-card p-4">
        <form action="#" method="POST">
            @csrf

            <!-- Section 1: Admin Details -->
            <div class="form-section-header">Admin Details</div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="roles-form-group">
                        <label class="roles-label">Name</label>
                        <input type="text" class="roles-input" placeholder="Enter Admin Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="roles-form-group">
                        <label class="roles-label">Email</label>
                        <input type="email" class="roles-input" placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="roles-form-group">
                        <label class="roles-label">Phone Number</label>
                        <div class="phone-input-wrapper">
                            <span class="phone-flag">🇨🇦</span>
                            <span class="phone-code">+1</span>
                            <input type="text" class="phone-input-field" placeholder="000000000">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Access Module -->
            <div class="form-section-header mt-4">Access Module</div>
            
            <div class="permissions-grid">
                @php
                    $modules = [
                        'Dashboard', 'Reviews & Ratings', 'Passenger Management',
                        'Analytics/Stats', 'Promo code Management', 'Advertising Management',
                        'Admin Roles', 'Fare Management', 'Support Ticket',
                        'Driver Management', 'Commission Management', 'Notifications',
                        'Vehicles Management', 'Payment Management', 'CMS management',
                        'Booking Management', 'Report Management', 'Settings'
                    ];
                    $checked = ['Analytics/Stats', 'Fare Management', 'Notifications'];
                @endphp

                @foreach($modules as $module)
                <div class="permission-item">
                    <input type="checkbox" id="mod_{{ Str::slug($module) }}" class="permission-checkbox" {{ in_array($module, $checked) ? 'checked' : '' }}>
                    <label for="mod_{{ Str::slug($module) }}" class="permission-label">{{ $module }}</label>
                </div>
                @endforeach
            </div>

            <!-- Section 3: Make Password -->
            <div class="form-section-header mt-4">Make Password</div>

            <div class="row">
                <div class="col-md-6">
                    <div class="roles-form-group">
                        <label class="roles-label">Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" class="roles-input" placeholder="Make Password" id="pass_main">
                            <i class="bi bi-eye-slash password-toggle-icon" onclick="togglePass('pass_main')"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="roles-form-group">
                        <label class="roles-label">Confirm Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" class="roles-input" placeholder="Confirm Password" id="pass_confirm">
                            <i class="bi bi-eye-slash password-toggle-icon" onclick="togglePass('pass_confirm')"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="roles-form-footer">
                <button type="button" class="btn-roles-invite" data-bs-toggle="modal" data-bs-target="#invitationModal">Invite</button>
                <a href="{{ route('admin.roles.index') }}" class="btn-roles-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- Invitation Success Modal -->
<div class="modal fade" id="invitationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content border-0" style="border-radius: 30px; padding: 30px;">
            <div class="modal-body text-center p-0">
                <div class="invitation-success-icon mb-4">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h3 class="modal-title-roles mb-2">Invitation</h3>
                <p class="modal-subtitle-roles mb-4">Your Invitation is Confirmed</p>
                <button type="button" class="btn-modal-okay w-100" data-bs-dismiss="modal" onclick="window.location.href='{{ route('admin.roles.index') }}'">Okay</button>
            </div>
        </div>
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
