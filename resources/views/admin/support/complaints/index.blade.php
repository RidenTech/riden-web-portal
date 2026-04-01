@extends('admin.layout.master')

@php
    $activeTab = request()->get('tab', 'drivers');
@endphp

@section('title', 'Support Ticket')

@push('styles')
    <link href="{{ asset('assets/css/support.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 support-wrapper">
    <div class="support-main-card">
        
        <!-- Header Section -->
        <div class="support-header riden-list-header">
            <div class="riden-search-bar">
                <div class="riden-search-icon">
                    <i class="bi bi-search"></i>
                </div>
                <input type="text" placeholder="Search by name, ID or phone">
            </div>

            <div class="header-actions">
                <div class="date-picker-support">
                    <i class="bi bi-calendar3"></i>
                    <span>23/04/2025 - 23/04/2025</span>
                </div>
            </div>
        </div>

        <!-- Custom Tabs -->
        <div class="riden-tabs-container">
            <a href="{{ route('support.complaints.index', ['tab' => 'drivers']) }}" 
               class="riden-tab-item {{ $activeTab === 'drivers' ? 'active' : '' }}">
                Driver Complaints
            </a>
            <a href="{{ route('support.complaints.index', ['tab' => 'passengers']) }}" 
               class="riden-tab-item {{ $activeTab === 'passengers' ? 'active' : '' }}">
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
