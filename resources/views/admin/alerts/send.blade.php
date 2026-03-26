@extends('admin.layout.master')

@section('title', 'Send Alerts')

@push('styles')
    <link href="{{ asset('assets/css/alerts.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 alerts-wrapper">
    <!-- Send Alert Header -->
    <div class="send-alert-header">
        <a href="{{ route('alerts.index') }}" class="back-arrow-btn">
            <i class="bi bi-chevron-left"></i>
        </a>
        <h1 class="send-alert-title">Send Alerts</h1>
    </div>

    <!-- Alert Form Sections -->
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Manage Audience Section -->
        @include('admin.alerts.sections.audience')

        <!-- Select Cities Section -->
        @include('admin.alerts.sections.cities')

        <!-- Create Alert Section -->
        @include('admin.alerts.sections.create')

        <!-- Bottom Actions -->
        <div class="send-alert-actions">
            <button type="submit" class="btn btn-send">Send</button>
            <a href="{{ route('alerts.index') }}" class="btn btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
