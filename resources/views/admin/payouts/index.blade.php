@extends('admin.layout.master')

@php
    $activeTab = request()->get('section', 'upcoming');
@endphp

@section('title', 'Payments')

@push('styles')
    <link href="{{ asset('assets/css/payouts.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 payouts-wrapper">
    <div class="payouts-main-card">
        
        <!-- Header Section -->
        <div class="payouts-header riden-list-header">
            <div class="riden-search-bar">
                <div class="riden-search-icon">
                    <i class="bi bi-search"></i>
                </div>
                <input type="text" placeholder="Search transactions...">
            </div>
            
            <div class="header-actions">
                <div class="date-picker-btn">
                    <i class="bi bi-calendar3"></i>
                    <span>23/04/2025 - 23/04/2025</span>
                </div>
                <a href="{{ route('admin.payouts.drivers', ['section' => 'instant']) }}" 
                   class="btn btn-instant-payout text-decoration-none">Instant Payout Requests(12)</a>
            </div>
        </div>

        <!-- Custom Tabs Navigation -->
        @if ($activeTab !== 'instant')
        <div class="riden-tabs-container">
            <a href="{{ route('admin.payouts.drivers', ['section' => 'upcoming']) }}" 
               class="riden-tab-item {{ $activeTab === 'upcoming' ? 'active' : '' }}" 
               style="text-decoration: none;">Upcoming Payments</a>
            <a href="{{ route('admin.payouts.drivers', ['section' => 'previous']) }}" 
               class="riden-tab-item {{ $activeTab === 'previous' ? 'active' : '' }}" 
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
