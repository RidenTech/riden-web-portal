@extends('admin.layout.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/addadmin.css">
@endpush

@section('content')
    <div class="col-12">
        <div class="riden-addadmin-wrap">
            <div class="riden-addadmin-head">
                <h2 class="riden-addadmin-title">
                    <i class="bi bi-chevron-left me-1"></i>
                    Add New Admin
                </h2>
            </div>

            <div class="riden-addadmin-card">
                <div class="riden-addadmin-section">Admin Details</div>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="riden-field-label">Name</div>
                        <input class="form-control riden-input" placeholder="Enter Admin Name">
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="riden-field-label">Email</div>
                        <input class="form-control riden-input" placeholder="Enter email address">
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="riden-field-label">Phone Number</div>
                        <div class="riden-phone">
                            <div class="riden-flag">
                                <img src="https://flagcdn.com/w40/ca.png" alt="CA">
                                +1
                            </div>
                            <input class="form-control riden-input" placeholder="0000000000">
                        </div>
                    </div>
                </div>

                <div class="mt-4 riden-addadmin-section">Access Module</div>
                @php
                    $modules = [
                        'Dashboard',
                        'Analytics/Stats',
                        'Admin Roles',
                        'Driver Management',
                        'Vehicles Management',
                        'Booking Management',
                        'Reviews & Ratings',
                        'Promo code Management',
                        'Fare Management',
                        'Commission Management',
                        'Payment Management',
                        'Report Management',
                        'Passenger Management',
                        'Advertising Management',
                        'Support Ticket',
                        'Notifications',
                        'CMS management',
                        'Settings',
                    ];
                @endphp
                <div class="riden-modules mb-3">
                    @foreach($modules as $m)
                        <label class="riden-check">
                            <input type="checkbox">
                            <span>{{ $m }}</span>
                        </label>
                    @endforeach
                </div>

                <div class="mt-4 riden-addadmin-section">Make Password</div>
                <div class="riden-password-row">
                    <div>
                        <div class="riden-field-label">Password</div>
                        <div class="riden-password">
                            <input type="password" class="form-control riden-input" placeholder="Make Password">
                            <i class="bi bi-eye riden-eye"></i>
                        </div>
                    </div>
                    <div>
                        <div class="riden-field-label">Confirm Password</div>
                        <div class="riden-password">
                            <input type="password" class="form-control riden-input" placeholder="Confirm Password">
                            <i class="bi bi-eye-slash riden-eye"></i>
                        </div>
                    </div>
                </div>

                <div class="riden-actions">
                    <button class="btn btn-sm btn-riden-danger px-4" type="button">Invite</button>
                    <button class="btn-riden-outline" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
