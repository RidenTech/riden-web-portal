@extends('admin.layout.master')

@section('title', 'Driver Management')

@push('styles')
    <link href="{{ asset('assets/css/drivers.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 drivers-wrapper">
    <!-- Header -->
    <div class="drivers-header riden-list-header">
       
        
            <form class="riden-header-search flex-grow-1" style="max-width: 400px; ">
            <span class="riden-header-search-icon-circle">
                <i class="bi bi-search"></i>
            </span>
            <input type="text"
                   class="form-control form-control-sm"
                   placeholder="Search by name, email, phone number">
        </form>

        <div class="header-actions">
            <a href="{{ route('admin.drivers.create') }}" class="btn-figma-red-pill">
            <a href="{{ route('admin.drivers.create') }}" class="btn-figma-blue-pill">
                <i class="bi bi-person-plus-fill me-2"></i> Add New Driver
            </a>
            <a href="#" class="btn-download-excel">
                <i class="bi bi-file-earmark-excel-fill"></i> Download
            </a>
            <div class="date-picker-drivers">
                <i class="bi bi-calendar3"></i>
                <span>{{ date('d/m/Y') }} - {{ date('d/m/Y') }}</span>
            </div>
        </div>
    </div>

    <div class="riden-tabs-container">
        <a href="{{ route('admin.drivers.directory') }}" class="riden-tab-item active">Active Drivers</a>
        <a href="#" class="riden-tab-item">Requested <span class="count">(0)</span></a>
    </div>

    <!-- Table Container -->
    <div class="drivers-table-container mt-4">
        <table class="table drivers-table mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Name</th>
                    <th>Unique ID</th>
                    <th>Phone Number</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($drivers as $driver)
                <tr style="cursor: pointer;" onclick="window.location='{{ route('admin.drivers.view', $driver->id) }}'">
                    <td class="ps-4">
                        <div class="driver-info">
                            @if($driver->avatar)
                                <img src="{{ asset('storage/'.$driver->avatar) }}" class="driver-avatar" alt="">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($driver->first_name . ' ' . $driver->last_name) }}&background=random" class="driver-avatar" alt="">
                            @endif
                            <span class="fw-semibold">{{ $driver->first_name }} {{ $driver->last_name }}</span>
                        </div>
                    </td>
                    <td class="text-muted fw-semibold">{{ $driver->unique_id }}</td>
                    <td class="fw-semibold">{{ $driver->phone }}</td>
                    <td class="text-center">
                        @php
                            $badgeClass = 'offline';
                            if($driver->status == 'Active') $badgeClass = 'online';
                            elseif($driver->status == 'Blocked') $badgeClass = 'blocked';
                            elseif($driver->status == 'Suspended') $badgeClass = 'suspended';
                        @endphp
                        <span class="status-badge {{ $badgeClass }}">{{ $driver->status }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted">No drivers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-drivers mt-4">
        {{ $drivers->links() }}
    </div>
</div>
@endsection
