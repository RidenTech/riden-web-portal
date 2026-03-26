@extends('admin.layout.master')

@php
    $activeTab = request()->get('section', 'upcoming');
@endphp

@section('title', $activeTab === 'instant' ? 'Instant Payout Requests' : 'Drivers Payouts')

@push('styles')
    <link href="{{ asset('assets/css/payouts.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 payouts-wrapper">
    <div class="payouts-main-card">
        
        <!-- Header Section -->
        <div class="payouts-header">
            @if ($activeTab === 'instant')
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('payouts.drivers', ['section' => 'upcoming']) }}" class="fare-back-btn" style="width: 32px; height: 32px; font-size: 16px;">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <h1 class="payouts-title">Instant Payout Requests</h1>
                </div>
            @else
                <h1 class="payouts-title">Drivers Payouts</h1>
            @endif
            
            <div class="header-actions">
                <div class="date-picker-btn">
                    <i class="bi bi-calendar3"></i>
                    <span>23/04/2025 - 23/04/2025</span>
                </div>
                <a href="{{ route('payouts.drivers', ['section' => 'instant']) }}" 
                   class="btn btn-instant-payout text-decoration-none">Instant Payout Requests(12)</a>
            </div>
        </div>

        <!-- Custom Tabs Navigation -->
        @if ($activeTab !== 'instant')
        <div class="payouts-tabs-container">
            <a href="{{ route('payouts.drivers', ['section' => 'upcoming']) }}" 
               class="tab-btn {{ $activeTab === 'upcoming' ? 'active' : 'inactive' }}" 
               style="text-decoration: none;">Upcoming Payments</a>
            <a href="{{ route('payouts.drivers', ['section' => 'previous']) }}" 
               class="tab-btn {{ $activeTab === 'previous' ? 'active' : 'inactive' }}" 
               style="text-decoration: none;">Previous Transactions</a>
        </div>
        @endif

        <!-- Table Card -->
        <div class="payouts-table-container">
            @if ($activeTab === 'upcoming')
                @include('admin.payouts.upcoming')
            @elseif ($activeTab === 'previous')
                @include('admin.payouts.previous')
            @elseif ($activeTab === 'instant')
                @include('admin.payouts.instant')
            @endif
        </div>

        <!-- Custom Pagination -->
        <div class="pagination-container">
            <ul class="payouts-pagination">
                <li><a href="#" class="page-link-custom arrow"><i class="bi bi-chevron-left"></i></a></li>
                <li><a href="#" class="page-link-custom active">1</a></li>
                <li><a href="#" class="page-link-custom">2</a></li>
                <li><a href="#" class="page-link-custom">3</a></li>
                <li><span class="px-1 text-muted">...</span></li>
                <li><a href="#" class="page-link-custom">5</a></li>
                <li><a href="#" class="page-link-custom arrow shadow-sm" style="background: #ff2d20; color: #fff; border:none;"><i class="bi bi-chevron-right"></i></a></li>
            </ul>
        </div>

    </div>
</div>
@endsection
