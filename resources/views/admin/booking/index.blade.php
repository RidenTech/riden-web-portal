@extends('admin.layout.master')

@section('title')
    Booking Management
@endsection

@push('styles')
    <link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet" type="text/css" />
    <!-- Tippy.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/themes/light.min.css" />
    <style>
        .tippy-box[data-theme~='riden-premium'] {
            background-color: #fff;
            color: #333;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            border: 1px solid #eee;
            padding: 8px;
            font-family: inherit;
        }
        .tooltip-content-riden h6 {
            color: #FF2E2E;
            font-weight: 800;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .tooltip-info-item {
            font-size: 13px;
            margin-bottom: 3px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .vehicle-popup-riden {
            padding: 10px;
            text-align: center;
        }
        .vehicle-popup-riden img {
            width: 100%;
            max-width: 200px;
            border-radius: 12px;
            margin-bottom: 10px;
        }
        .vehicle-brand-model {
            font-weight: 800;
            color: #000;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .vehicle-meta-badge {
            display: inline-block;
            background: #f8f8f8;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            color: #666;
            margin: 2px;
        }
    </style>
@endpush

@section('content')
<div class="col-12">
    <div class="booking-management-wrapper">
        <div class="booking-management-container">

        <!-- 0. Global Search -->
        <div class="riden-global-search mb-4">
            <form action="{{ route('admin.booking.management') }}" method="GET" class="search-form-riden">
                <input type="hidden" name="tab" value="{{ $activeTab }}">
                <div class="input-group-riden">
                    <span class="search-icon-riden"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control-riden" placeholder="Search by name, email, phone number" onchange="this.form.submit()">
                </div>
            </form>
        </div>
        <div class="booking-header-row riden-list-header mb-4">
            <h2 class="booking-title">Booking Management</h2>
            <div class="header-actions">
                <button class="btn-download-riden mr-2">
                    <img src="{{ asset('assets/images/icons/excel-icon.png') }}" alt="" style="width: 20px;"> Download
                </button>
                <div class="riden-date-range">
                    <i class="bi bi-calendar3 text-danger"></i>
                    <span>23/04/2025 - 23/04/2025</span>
                </div>
            </div>
        </div>

        <!-- 2. Action & Tabs Row -->
        <div class="riden-actions-row mb-4">
            <div class="riden-tabs-pill">
                <a href="{{ route('admin.booking.management', ['tab' => 'ongoing']) }}" class="tab-pill {{ $activeTab === 'ongoing' ? 'active' : '' }}">Ongoing Bookings</a>
                <a href="{{ route('admin.booking.management', ['tab' => 'previous']) }}" class="tab-pill {{ $activeTab === 'previous' ? 'active' : '' }}">Previous Bookings</a>
            </div>
            <button class="btn-add-booking" onclick="window.location='{{ route('admin.booking.create') }}'">
                <i class="bi bi-plus-lg"></i> Add Booking
            </button>
        </div>

        <!-- 3. Table Card -->
        <div class="booking-card">
            <div class="table-responsive">
                <table class="table mb-0 booking-table">
                    <thead>
                        <tr>
                            <th class="ps-4">Booking ID</th>
                            <th>Driver</th>
                            <th>Passenger</th>
                            <th>Fare</th>
                            <th>Veh No</th>
                            <th>Pickup Location</th>
                            <th>Dropoff Location</th>
                            <th>Distance</th>
                            <th>Duration</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                        <tr onclick="window.location='{{ route('admin.booking.detail', $booking->id) }}'" style="cursor: pointer;">
                            <td class="ps-4 booking-id">
                                {{ $booking->id }}
                            </td>
                            <td>
                                <span class="tippy-trigger" 
                                      data-tippy-content="<div class='tooltip-content-riden'><h6>Driver Info</h6><div class='tooltip-info-item'><i class='bi bi-fingerprint'></i> ID: {{ $booking->driver->id ?? 'N/A' }}</div><div class='tooltip-info-item'><i class='bi bi-envelope'></i> {{ $booking->driver->email ?? 'N/A' }}</div><div class='tooltip-info-item'><i class='bi bi-telephone'></i> {{ $booking->driver->phone ?? 'N/A' }}</div></div>">
                                    {{ $booking->driver->first_name ?? 'Unassigned' }} {{ $booking->driver->last_name ?? '' }}
                                </span>
                            </td>
                            <td>
                                <span class="tippy-trigger"
                                      data-tippy-content="<div class='tooltip-content-riden'><h6>Passenger Info</h6><div class='tooltip-info-item'><i class='bi bi-fingerprint'></i> ID: {{ $booking->passenger->id ?? 'N/A' }}</div><div class='tooltip-info-item'><i class='bi bi-envelope'></i> {{ $booking->passenger->email ?? 'N/A' }}</div><div class='tooltip-info-item'><i class='bi bi-telephone'></i> {{ $booking->passenger->phone ?? 'N/A' }}</div></div>">
                                    {{ $booking->passenger->first_name ?? 'N/A' }} {{ $booking->passenger->last_name ?? '' }}
                                </span>
                            </td>
                            <td>${{ number_format($booking->fare, 2) }}</td>
                            <td>
                                <span class="tippy-vehicle-trigger text-danger fw-bold" style="cursor: pointer; border-bottom: 1px dashed #FF2E2E;"
                                      data-tippy-content="<div class='vehicle-popup-riden'><img src='https://static.vecteezy.com/system/resources/previews/023/192/562/original/sport-car-top-view-white-sedan-car-illustration-generative-ai-png.png' alt='Car'><div class='vehicle-brand-model'>{{ $booking->driver->vehicle->model ?? 'Unknown' }}</div><div><span class='vehicle-meta-badge'>Year: {{ $booking->driver->vehicle->year ?? 'N/A' }}</span><span class='vehicle-meta-badge'>Color: {{ $booking->driver->vehicle->color ?? 'N/A' }}</span></div><div class='mt-2'><span class='vehicle-meta-badge' style='background: #FFEBEB; color: #FF2E2E;'>Plate: {{ $booking->driver->vehicle->license_plate ?? 'N/A' }}</span></div></div>">
                                    {{ $booking->driver->vehicle->license_plate ?? ($booking->driver->vehicle->id ?? 'N/A') }}
                                </span>
                            </td>
                            <td title="{{ $booking->pickup_location }}">{{ Str::limit($booking->pickup_location, 30) }}</td>
                            <td title="{{ $booking->dropoff_location }}">{{ Str::limit($booking->dropoff_location, 30) }}</td>
                            <td>{{ $booking->distance ?? '0.0 km' }}</td>
                            <td>{{ $booking->duration ?? '0 min' }}</td>
                            <td>
                                <span class="status-badge-riden {{ in_array($booking->status, ['pending', 'ongoing']) ? 'status-ongoing-green' : 'status-previous-grey' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">No bookings found matching your criteria.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Row -->
            <div class="booking-pagination">
                {{ $bookings->links('vendor.pagination.riden') }}
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    <!-- Popper and Tippy.js for professional tooltips -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Standard Hover Tooltips for Users
            tippy('.tippy-trigger', {
                allowHTML: true,
                theme: 'riden-premium',
                placement: 'top',
                animation: 'shift-away',
                interactive: true,
                arrow: true,
                delay: [100, 50],
                maxWidth: 350
            });

            // Hover-based Vehicle Tooltips
            tippy('.tippy-vehicle-trigger', {
                allowHTML: true,
                theme: 'riden-premium',
                placement: 'right',
                animation: 'scale',
                trigger: 'mouseenter',
                interactive: true,
                arrow: true,
                maxWidth: 250
            });
        });
    </script>
@endpush
