@extends('admin.layout.master')

@section('title', 'Driver Management')

@push('styles')
    <link href="{{ asset('assets/css/drivers.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 drivers-wrapper">
    <!-- Header -->
    <div class="drivers-header riden-list-header">
        <div class="riden-search-bar">
            <div class="riden-search-icon">
                <i class="bi bi-search"></i>
            </div>
            <input type="text" placeholder="Search by name, ID or phone">
        </div>

        <div class="header-actions">
            <a href="#" class="btn-download-excel">
                <i class="bi bi-file-earmark-excel-fill"></i> Download
            </a>
            <div class="date-picker-drivers">
                <i class="bi bi-calendar3"></i>
                <span>23/04/2025 - 23/04/2025</span>
            </div>
        </div>
    </div>

    <div class="riden-tabs-container">
        <a href="{{ route('admin.drivers.directory') }}" class="riden-tab-item">Active Drivers</a>
        <a href="{{ route('admin.drivers.requests') }}" class="riden-tab-item active">Requested <span class="count">(14)</span></a>
    </div>

    <!-- Table Container -->
    <div class="drivers-table-container">
        <table class="table drivers-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Unique ID</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $drivers = [
                        ['name' => 'Wade Warren', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '11'],
                        ['name' => 'Jacob Jones', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '12'],
                        ['name' => 'Bessie Cooper', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '13'],
                        ['name' => 'Theresa Webb', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '14'],
                        ['name' => 'Jerome Bell', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '15'],
                        ['name' => 'Robert Fox', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '16'],
                        ['name' => 'Kathryn Murphy', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '17'],
                        ['name' => 'Savannah Nguyen', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '18'],
                        ['name' => 'Floyd Miles', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '19'],
                        ['name' => 'Devon Lane', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '20'],
                    ];
                @endphp
                @foreach($drivers as $driver)
                <tr onclick="window.location='{{ route('admin.drivers.view', ['id' => 1]) }}'" style="cursor: pointer;">
                    <td>
                        <div class="driver-info">
                            <img src="https://i.pravatar.cc/80?img={{ $driver['img'] }}" class="driver-avatar" alt="">
                            <span>{{ $driver['name'] }}</span>
                        </div>
                    </td>
                    <td>{{ $driver['id'] }}</td>
                    <td>{{ $driver['phone'] }}</td>
                    <td>
                        <span class="status-badge {{ $driver['badge'] }}">{{ $driver['status'] }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-drivers">
        <a href="#" class="page-btn-drivers arrow"><i class="bi bi-chevron-left"></i></a>
        <a href="#" class="page-btn-drivers active">1</a>
        <a href="#" class="page-btn-drivers">2</a>
        <a href="#" class="page-btn-drivers">3</a>
        <span class="px-2">...</span>
        <a href="#" class="page-btn-drivers">5</a>
        <a href="#" class="page-btn-drivers arrow-next"><i class="bi bi-chevron-right"></i></a>
    </div>
</div>
@endsection
