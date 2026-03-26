@extends('admin.layout.master')

@php
    $activeTab = request()->get('tab', 'drivers');
@endphp

@section('title', 'Complaint Tickets')

@push('styles')
    <link href="{{ asset('assets/css/support.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 support-wrapper">
    <div class="support-main-card">
        
        <!-- Header Section -->
        <div class="support-header">
            <h1 class="support-title">Complaint Tickets</h1>
            
            <div class="header-actions">
                <div class="date-picker-support">
                    <i class="bi bi-calendar3"></i>
                    <span>23/04/2025 - 23/04/2025</span>
                </div>
            </div>
        </div>

        <!-- Custom Tabs -->
        <div class="support-tabs d-flex align-items-center mb-4" style="border-bottom: none;">
            <a href="{{ route('support.complaints.index', ['tab' => 'drivers']) }}" 
               class="support-tab {{ $activeTab === 'drivers' ? 'active' : '' }}">
                Driver Complaints
            </a>
            <a href="{{ route('support.complaints.index', ['tab' => 'passengers']) }}" 
               class="support-tab {{ $activeTab === 'passengers' ? 'active' : '' }}">
                Passenger Complaints
            </a>
        </div>

        <!-- Tab Content -->
        <div class="tab-content mt-2">
            @if($activeTab === 'drivers')
                @include('admin.support.complaints.drivers')
            @else
                @include('admin.support.complaints.passengers')
            @endif
        </div>

    </div>
</div>
@endsection
