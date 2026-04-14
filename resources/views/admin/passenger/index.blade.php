@extends('admin.layout.master')

@section('title')
    Passenger Management
@endsection

@push('styles')
    <link href="{{ asset('assets/css/drivers.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 drivers-wrapper">
    <!-- Header Actions Row (Below Topbar) -->
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
            <a href="{{ route('admin.passenger.create') }}" class="btn-figma-red-pill">
                <i class="bi bi-person-plus-fill me-2"></i> Add New Passenger
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
        <a href="#" class="riden-tab-item active">Active Passengers</a>
        <a href="#" class="riden-tab-item">Inactive <span class="count">(0)</span></a>
    </div>

    <!-- Table Container -->
    <div class="drivers-table-container mt-4">
        <table class="table drivers-table mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Name</th>
                    <th>Unique ID</th>
                    <th>Phone Number</th>
                    <th>Bookings</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
                <tbody>
                    @forelse($passengers as $p)
                    <tr onclick="window.location='{{ route('admin.passenger.detail', $p->id) }}'" style="cursor: pointer;">
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                @if($p->avatar)
                                    <img src="{{ asset('storage/'.$p->avatar) }}" class="driver-avatar" alt="Avatar">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($p->first_name . ' ' . $p->last_name) }}&background=random" class="driver-avatar" alt="Avatar">
                                @endif
                                <span class="fw-semibold">{{ $p->first_name }} {{ $p->last_name }}</span>
                            </div>
                        </td>
                        <td class="text-muted fw-semibold">{{ $p->unique_id }}</td>
                        <td class="fw-semibold">{{ $p->phone }}</td>
                        <td class="fw-semibold">0</td> {{-- Bookings count can be added later --}}
                        <td class="text-center">
                            @php
                                $badgeClass = 'offline';
                                if($p->status == 'Active') $badgeClass = 'online';
                                elseif($p->status == 'Blocked') $badgeClass = 'blocked';
                            @endphp
                            <span class="status-badge {{ $badgeClass }}">{{ $p->status }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">No passengers found.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="pagination-drivers mt-4">
        {{ $passengers->links() }}
    </div>
</div>
@endsection
