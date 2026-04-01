@extends('admin.layout.master')

@section('title', 'Manage Notifications')

@push('styles')
    <link href="{{ asset('assets/css/alerts.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/addadmin.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 riden-addadmin-wrap">
    <!-- Send Alert Header -->
    <div class="riden-addadmin-head mb-2">
        <a href="{{ route('alerts.index') }}" class="riden-addadmin-back border-0 bg-transparent text-decoration-none">
            <i class="bi bi-chevron-left"></i>
        </a>
        <h2 class="riden-addadmin-title mb-0">Send Alerts</h2>
    </div>

    <!-- Alert Form Sections -->
    <div class="card riden-addadmin-card border-0 shadow-sm p-2">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Manage Audience Section -->
            @include('admin.alerts.sections.audience')

            <!-- Select Cities Section -->
            @include('admin.alerts.sections.cities')

            <!-- Create Alert Section -->
            @include('admin.alerts.sections.create')

            <!-- Bottom Actions -->
            <div class="d-flex justify-content-end gap-3 mt-2">
                <button type="submit" class="btn btn-riden-danger px-4" style="min-width: 140px; font-size: 15px;">Send</button>
                <a href="{{ route('alerts.index') }}" class="btn btn-riden-outline px-4 text-decoration-none d-inline-flex align-items-center justify-content-center" style="min-width: 140px; font-size: 15px;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
