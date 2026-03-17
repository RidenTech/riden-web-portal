@extends('admin.layout.master')

@section('title')
    Profile
@endsection

@section('content')
    <div class="col-12">
        <div class="card riden-profile-card p-3 p-md-4">

            <div class="riden-profile-user mt-2">
                <i class="bi bi-chevron-left me-1"></i>

                <img src="https://i.pravatar.cc/100?img=5" class="riden-profile-avatar" alt="Avatar">

                <div>
                    <div class="riden-profile-name">
                        Esther Howard
                    </div>
                    <div class="riden-profile-role">Administrator</div>
                </div>

                <a href="#" class="btn btn-sm btn-riden-danger riden-profile-logout ms-auto">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </a>
            </div>

            <div class="riden-section-title">Personal Details</div>
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="riden-pill">
                        <span class="riden-icon-circle">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <div>
                            <div class="text-muted" style="font-size:12px;">Email</div>
                            <div class="fw-semibold">Jeromebell445@gmail.com</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="riden-pill">
                        <span class="riden-icon-circle">
                            <i class="bi bi-telephone"></i>
                        </span>
                        <div>
                            <div class="text-muted" style="font-size:12px;">Phone Number</div>
                            <div class="fw-semibold">+1 234 567 789</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="riden-section-title">Access Modules</div>

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="riden-module">
                        <span class="check">✓</span>
                        <span style="color:black;">Dashboard</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="riden-module">
                        <span class="check">✓</span>
                        <span style="color:black;">Reviews & Ratings</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="riden-module">
                        <span class="check">✓</span>
                        <span style="color:black;">Passenger Management</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="riden-module">
                        <span class="check">✓</span>
                        <span style="color:black;">Analytics/Stats</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="riden-module">
                        <span class="check">✓</span>
                        <span style="color:black;">Promo Code Management</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="riden-module">
                        <span class="check">✓</span>
                        <span style="color:black;">Advertising Management</span>
                    </div>
                </div>

            </div>

            <div class="riden-section-title">Password</div>

            <div class="row g-3">
                <div class="col-12 col-md-12">
                    <div class="riden-pill d-flex align-items-center justify-content-between">

                        <!-- Left Side -->
                        <div class="d-flex align-items-center gap-3">
                            <span class="riden-icon-circle">
                                <i class="bi bi-lock"></i>
                            </span>

                            <div>
                                <div class="text-muted" style="font-size:12px;">Password</div>
                                <div class="d-flex align-items-center gap-2">
                                    <div>******839</div>
                                    <button type="button" class="btn btn-link p-0 text-muted">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <small class="text-muted">
                            Last Updated on 24 Dec, 2024
                        </small>

                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="#" class="btn btn-sm btn-riden-danger px-4">
                    Update Password
                </a>
            </div>
        </div>

    </div>
    </div>
@endsection
