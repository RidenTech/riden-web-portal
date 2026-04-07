@extends('admin.layout.master')

@section('title', 'Driver Management')

@push('styles')
    <link href="{{ asset('assets/css/drivers.css') }}" rel="stylesheet" type="text/css" />
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
        <a href="{{ route('admin.drivers.directory') }}" class="riden-tab-item active">Active Drivers</a>
        <a href="{{ route('admin.drivers.requests') }}" class="riden-tab-item">Requested <span class="count">(14)</span></a>
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
                        ['name' => 'Wade Warren', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Online', 'badge' => 'online', 'img' => '1'],
                        ['name' => 'Jacob Jones', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '2'],
                        ['name' => 'Bessie Cooper', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Blocked', 'badge' => 'blocked', 'img' => '3'],
                        ['name' => 'Theresa Webb', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Online', 'badge' => 'online', 'img' => '4'],
                        ['name' => 'Jerome Bell', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Suspended', 'badge' => 'suspended', 'time' => '(35 min left)', 'img' => '5'],
                        ['name' => 'Robert Fox', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Online', 'badge' => 'online', 'img' => '6'],
                        ['name' => 'Kathryn Murphy', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '7'],
                        ['name' => 'Savannah Nguyen', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Online', 'badge' => 'online', 'img' => '8'],
                        ['name' => 'Floyd Miles', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Online', 'badge' => 'online', 'img' => '9'],
                        ['name' => 'Devon Lane', 'id' => '#34567', 'phone' => '+123456372893', 'status' => 'Offline', 'badge' => 'offline', 'img' => '10'],
                    ];
                @endphp
                @foreach($drivers as $driver)
                <tr style="cursor: pointer;" onclick="window.location='{{ route('admin.drivers.active.view', 1) }}'">
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
                        @if(isset($driver['time']))
                            <span class="suspended-time">{{ $driver['time'] }}</span>
                        @endif
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
