@extends('admin.layout.master')

@section('title')
    Passenger Management
@endsection

@push('styles')
    <link href="{{ asset('assets/css/passenger.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 px-0">
    <!-- Header Actions Row (Below Topbar) -->
    <div class="riden-list-header ">
        <div class="riden-search-bar">
            <div class="riden-search-icon">
                <i class="bi bi-search"></i>
            </div>
            <input type="text" placeholder="Search by name, ID or phone">
        </div>
        
        <div class="d-flex gap-3 align-items-center">
            <button class="btn-figma-red-pill">
                <img src="https://img.icons8.com/ios-glyphs/30/ffffff/export.png" width="16" class="me-2"> Download
            </button>
            <div class="date-picker-figma">
                <i class="bi bi-calendar3 me-2"></i>
                <span>23/04/2025 - 23/04/2025</span>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="card figma-index-card">
        <div class="table-responsive">
            <table class="table figma-table-index mb-0">
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
                    @php
                        $passengers = [
                            ['name' => 'Wade Warren', 'id' => '#34567', 'phone' => '+123456372893', 'bookings' => '43', 'status' => 'Active'],
                            ['name' => 'Jacob Jones', 'id' => '#34567', 'phone' => '+123456372893', 'bookings' => '23', 'status' => 'inactive'],
                            ['name' => 'Bessie Cooper', 'id' => '#34567', 'phone' => '+123456372893', 'bookings' => '45', 'status' => 'Active'],
                            ['name' => 'Theresa Webb', 'id' => '#34567', 'phone' => '+123456372893', 'bookings' => '29', 'status' => 'Active'],
                            ['name' => 'Jerome Bell', 'id' => '#34567', 'phone' => '+123456372893', 'bookings' => '63', 'status' => 'Active'],
                            ['name' => 'Robert Fox', 'id' => '#34567', 'phone' => '+123456372893', 'bookings' => '12', 'status' => 'Active'],
                            ['name' => 'Kathryn Murphy', 'id' => '#34567', 'phone' => '+123456372893', 'bookings' => '05', 'status' => 'inactive'],
                            ['name' => 'Savannah Nguyen', 'id' => '#34567', 'phone' => '+123456372893', 'bookings' => '21', 'status' => 'inactive'],
                            ['name' => 'Floyd Miles', 'id' => '#34567', 'phone' => '+123456372893', 'bookings' => '15', 'status' => 'Active'],
                            ['name' => 'Devon Lane', 'id' => '#34567', 'phone' => '+123456372893', 'bookings' => '17', 'status' => 'Active'],
                        ];
                    @endphp

                    @foreach($passengers as $p)
                    <tr onclick="window.location='{{ route('passenger.detail') }}'" style="cursor: pointer;">
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://i.pravatar.cc/100?u={{ $p['name'] }}" class="avatar-sm-figma" alt="Avatar">
                                <span class="fw-semibold">{{ $p['name'] }}</span>
                            </div>
                        </td>
                        <td class="text-muted fw-semibold">{{ $p['id'] }}</td>
                        <td class="fw-semibold">{{ $p['phone'] }}</td>
                        <td class="fw-semibold">{{ $p['bookings'] }}</td>
                        <td class="text-center">
                            <span class="badge-status-figma {{ strtolower($p['status']) == 'active' ? 'active' : 'inactive' }}">
                                {{ $p['status'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-4 me-2">
        <div class="pagination-figma">
            <a href="#" class="page-link-figma"><i class="bi bi-chevron-left"></i></a>
            <a href="#" class="page-link-figma active">1</a>
            <a href="#" class="page-link-figma">2</a>
            <a href="#" class="page-link-figma">3</a>
            <span class="mx-2 text-muted">...</span>
            <a href="#" class="page-link-figma">5</a>
            <a href="#" class="page-link-figma next"><i class="bi bi-chevron-right text-white"></i></a>
        </div>
    </div>
</div>
@endsection
