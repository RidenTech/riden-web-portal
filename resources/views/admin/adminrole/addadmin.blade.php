@extends('admin.layout.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/addadmin.css">
@endpush

@section('content')
    <div class="col-12">
        <div class="riden-addadmin-wrap">
            <div class="riden-addadmin-head mb-4">
                <a href="{{ route('admin.roles.index') }}" class="riden-addadmin-back text-decoration-none">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <h2 class="riden-addadmin-title mb-0">Add New Admin</h2>
            </div>

            <div class="card riden-addadmin-card border-0 shadow-sm p-4">
                <div class="riden-addadmin-section mb-4">Admin Details</div>

                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label class="riden-field-label">Name</label>
                        <input class="form-control riden-input" placeholder="Enter Admin Name">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="riden-field-label">Email</label>
                        <input class="form-control riden-input" placeholder="Enter email address">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="riden-field-label">Phone Number</label>
                        <div class="riden-phone">
                            <div class="riden-flag">
                                <img src="https://flagcdn.com/w40/ca.png" alt="CA">
                                <span>+1</span>
                            </div>
                            <input class="form-control riden-input flex-grow-1" placeholder="000 000 0000">
                        </div>
                    </div>
                </div>

                <div class="mt-5 riden-addadmin-section mb-4">Access Module</div>
                @php
                    $modules = [
                        'Dashboard', 'Analytics/Stats', 'Admin Roles', 'Driver Management',
                        'Vehicles Management', 'Booking Management', 'Reviews & Ratings',
                        'Promo code Management', 'Fare Management', 'Commission Management',
                        'Payment Management', 'Report Management', 'Passenger Management',
                        'Advertising Management', 'Support Ticket', 'Notifications',
                        'CMS management', 'Settings'
                    ];
                @endphp
                <div class="riden-modules-grid">
                    @foreach($modules as $m)
                        <div class="form-check custom-module-check mb-2">
                            <input class="form-check-input" type="checkbox" id="mod_{{ Str::slug($m) }}">
                            <label class="form-check-label ms-2" for="mod_{{ Str::slug($m) }}">
                                {{ $m }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 riden-addadmin-section mb-4">Make Password</div>
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label class="riden-field-label">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control riden-input pe-5" placeholder="Make Password">
                            <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3 opacity-50 cursor-pointer"></i>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="riden-field-label">Confirm Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control riden-input pe-5" placeholder="Confirm Password">
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 opacity-50 cursor-pointer"></i>
                        </div>
                    </div>
                </div>

                <div class="riden-actions d-flex justify-content-end gap-3 mt-5 pt-3">
                    <button class="btn btn-riden-danger px-5 py-2 fw-700" type="button">Invite</button>
                    <button class="btn btn-riden-outline px-5 py-2 fw-700" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
