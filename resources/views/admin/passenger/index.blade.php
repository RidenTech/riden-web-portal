@extends('admin.layout.master')

@section('title')
    Passenger Management
@endsection

@push('styles')
    <link href="{{ asset('assets/css/passenger.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 passengers-wrapper px-0">
    <!-- Header Actions Row (Below Topbar) -->
    <div class="passengers-header riden-list-header">
        <h3 class="passenger-page-title mb-0">Passenger Management</h3>
     <div class="header-actions">
            <a href="{{ route('admin.passenger.create') }}" class="btn-figma-red-pill">
                <i class="bi bi-person-plus-fill me-2"></i> Add New Passenger
            </a>
            <a href="#" class="btn-download-passengers">
                <i class="bi bi-file-earmark-excel-fill"></i> Download
            </a>
            <div class="date-picker-passengers">
                <i class="bi bi-calendar3"></i>
                <span>{{ date('d/m/Y') }} - {{ date('d/m/Y') }}</span>
            </div>
        </div>
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
                                    <img src="{{ asset('storage/'.$p->avatar) }}" class="avatar-sm-figma" alt="Avatar">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($p->first_name . ' ' . $p->last_name) }}&background=random" class="avatar-sm-figma" alt="Avatar">
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
    <div class="d-flex justify-content-end mt-4 me-2">
        {{ $passengers->links() }}
    </div>
</div>
@endsection
