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
    <!-- 1. Header Actions Row -->
    <div class="riden-list-header px-4 mt-4">
        <h3 class="passenger-page-title mb-0">Passenger Management</h3>
        
        <div class="d-flex gap-3 align-items-center">
            <a href="{{ route('admin.passenger.create') }}" class="btn-figma-blue-pill">
                <i class="bi bi-person-plus-fill me-2"></i> Add New Passenger
            </a>
            <button class="btn-figma-red-pill border-0">
                <img src="https://img.icons8.com/ios-glyphs/30/ffffff/export.png" width="16" class="me-2"> Download
            </button>
            <div class="date-picker-figma">
                <i class="bi bi-calendar3 me-2"></i>
                <span>{{ date('d/m/Y') }} - {{ date('d/m/Y') }}</span>
            </div>
        </div>
    </div>

    <!-- 2. Table Container -->
    <div class="drivers-table-container mt-4 mx-4 shadow-sm">
        <table class="table drivers-table mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Name</th>
                    <th>passenger ID</th>
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
                        <td class="text-muted fw-semibold">{{ $p->id }}</td>
                        <td class="fw-semibold">{{ $p->phone }}</td>
                        <td class="fw-semibold">0</td>
                        <td class="text-center">
                            <span class="badge-status-figma {{ strtolower($p->status) == 'active' ? 'active' : (strtolower($p->status) == 'blocked' ? 'blocked' : 'inactive') }}">
                                {{ $p->status }}
                            </span>
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
