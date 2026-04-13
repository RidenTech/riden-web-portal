@extends('admin.layout.master')

@php
    $section = request()->get('section', 'index');
@endphp

@section('title',  'Commission Management')

@push('styles')
    <link href="{{ asset('assets/css/commission.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('body-class', 'commission-page')

@section('content')
<div class="col-12 commission-wrapper">
    <div class="commission-main-card">
        
        <!-- Header Section -->
        <div class="commission-header riden-list-header">
            @if ($section === 'index')
            <div class="riden-search-bar">
                <div class="riden-search-icon">
                    <i class="bi bi-search"></i>
                </div>
                <input type="text" placeholder="Search by ID or car type">
            </div>
            
            <div class="header-actions">
                <a href="{{ route('admin.commission.index', ['section' => 'setup']) }}" class="btn btn-set-commission text-decoration-none">
                    <i class="bi bi-plus-lg"></i>
                    Set Commission
                </a>
                <div class="date-picker-btn">
                    <i class="bi bi-calendar3"></i>
                    <span>23/04/2025 - 23/04/2025</span>
                </div>
            </div>
            @else
            <div></div> <!-- Spacer for non-list view -->
            @endif
        </div>

        @if ($section === 'index')
            <!-- Summary Cards Section -->
            <div class="row commission-summary-row">
                <div class="col-md-6">
                    <div class="summary-card-custom">
                        <div class="summary-card-info">
                            <span class="label">Total Rides</span>
                            <h2 class="value">1024</h2>
                        </div>
                        <img src="{{ asset('assets/images/commission/rides.png') }}" class="summary-card-img" alt="Total Rides">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="summary-card-custom">
                        <div class="summary-card-info">
                            <span class="label">Total Commission</span>
                            <h2 class="value">$45k</h2>
                        </div>
                        <img src="{{ asset('assets/images/commission/commission.png') }}" class="summary-card-img" alt="Total Commission">
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="commission-table-container">
                <table class="table commission-table">
                    <thead>
                        <tr>
                            <th style="border-top-left-radius: 20px;">Date & Time</th>
                            <th>Booking ID</th>
                            <th>Car Type</th>
                            <th>Total Amount</th>
                            <th>Discount</th>
                            <th>Commission %</th>
                            <th style="border-top-right-radius: 20px;">Commission Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $transactions = [
                                ['date' => '22 March 2025', 'id' => '#34567', 'type' => 'Standard', 'total' => '$400.00', 'discount' => '$400.00', 'percent' => '20%', 'amount' => '$400.00'],
                                ['date' => '22 March 2025', 'id' => '#34567', 'type' => 'Standard', 'total' => '$400.00', 'discount' => '$400.00', 'percent' => '20%', 'amount' => '$400.00'],
                                ['date' => '22 March 2025', 'id' => '#34567', 'type' => 'Standard', 'total' => '$400.00', 'discount' => '$400.00', 'percent' => '20%', 'amount' => '$400.00'],
                                ['date' => '22 March 2025', 'id' => '#34567', 'type' => 'Standard', 'total' => '$400.00', 'discount' => '$400.00', 'percent' => '20%', 'amount' => '$400.00'],
                                ['date' => '22 March 2025', 'id' => '#34567', 'type' => 'Standard', 'total' => '$400.00', 'discount' => '$400.00', 'percent' => '20%', 'amount' => '$400.00'],
                                ['date' => '22 March 2025', 'id' => '#34567', 'type' => 'Standard', 'total' => '$400.00', 'discount' => '$400.00', 'percent' => '20%', 'amount' => '$400.00'],
                                ['date' => '22 March 2025', 'id' => '#34567', 'type' => 'Standard', 'total' => '$400.00', 'discount' => '$400.00', 'percent' => '20%', 'amount' => '$400.00'],
                                ['date' => '22 March 2025', 'id' => '#34567', 'type' => 'Standard', 'total' => '$400.00', 'discount' => '$400.00', 'percent' => '20%', 'amount' => '$400.00'],
                                ['date' => '22 March 2025', 'id' => '#34567', 'type' => 'Standard', 'total' => '$400.00', 'discount' => '$400.00', 'percent' => '20%', 'amount' => '$400.00'],
                                ['date' => '22 March 2025', 'id' => '#34567', 'type' => 'Standard', 'total' => '$400.00', 'discount' => '$400.00', 'percent' => '20%', 'amount' => '$400.00'],
                            ];
                        @endphp

                        @foreach($transactions as $row)
                        <tr>
                            <td>{{ $row['date'] }}</td>
                            <td>{{ $row['id'] }}</td>
                            <td>{{ $row['type'] }}</td>
                            <td>{{ $row['total'] }}</td>
                            <td>{{ $row['discount'] }}</td>
                            <td>{{ $row['percent'] }}</td>
                            <td>{{ $row['amount'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Custom Pagination -->
            <div class="pagination-container">
                <ul class="commission-pagination">
                    <li><a href="#" class="page-link-custom arrow"><i class="bi bi-chevron-left"></i></a></li>
                    <li><a href="#" class="page-link-custom active">1</a></li>
                    <li><a href="#" class="page-link-custom">2</a></li>
                    <li><a href="#" class="page-link-custom">3</a></li>
                    <li><span class="px-1 text-muted">...</span></li>
                    <li><a href="#" class="page-link-custom">5</a></li>
                    <li><a href="#" class="page-link-custom arrow shadow-sm" style="background: #ff2d20; color: #fff; border:none;"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </div>
        @else
            @include('admin.commission.setup')
        @endif

    </div>
</div>
@endsection
