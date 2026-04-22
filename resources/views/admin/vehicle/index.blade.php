@extends('admin.layout.master')

@push('styles')
    <link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <style>
        .vehicle-id-badge {
            background: #FFEBEB;
            color: #FF2E2E;
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
        }
        .driver-id-link {
            color: #333;
            text-decoration: none;
            font-weight: 600;
            border-bottom: 1px dashed #ccc;
        }
    </style>
@endpush

@section('content')
<div class="riden-content-wrapper">
    <div class="riden-section">
        <div class="d-flex justify-content-between align-items-end mb-4 pb-2 border-bottom">
            <div>
                <h2 class="fw-bold mb-0" style="color: #333; font-size: 28px;">Vehicle Management</h2>
                <p class="text-muted mb-0 small">Manage your fleet and vehicle-driver assignments</p>
            </div>
            <a href="{{ route('admin.vehicle.create') }}" class="riden-btn-primary" style="text-decoration: none;">+ Add Vehicle</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px; background: #e7fcf3; color: #058f55;">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="riden-card-premium">
            <div class="table-responsive">
                <table class="table riden-table-elite align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Car Image</th>
                            <th>Driver ID</th>
                            <th>Car Name</th>
                            <th>Model No</th>
                            <th>Plate No</th>
                            <th>Category</th>
                            <th>No of Seats</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles as $vehicle)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-3 overflow-hidden me-2" style="width: 60px; height: 40px; background: #f8f9fa; border: 1px solid #eee;">
                                        @if($vehicle->front_image)
                                            <img src="{{ asset('uploads/vehicles/' . $vehicle->front_image) }}" alt="Car" class="w-100 h-100 object-fit-cover">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted" style="font-size: 10px;">No Image</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="driver-id-link tippy-driver" 
                                      data-tippy-content="<strong>{{ $vehicle->driver->name ?? 'N/A' }}</strong><br>{{ $vehicle->driver->email ?? 'No Email' }}">
                                    {{ $vehicle->driver->unique_id ?? 'UNASSIGNED' }}
                                </span>
                            </td>
                            <td class="fw-bold">{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->year }}</td>
                            <td>
                                <span class="vehicle-id-badge">{{ $vehicle->license_plate }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark px-3 py-2 border">
                                    {{ ucfirst($vehicle->vehicle_type ?? 'Sedan') }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-people-fill text-muted"></i>
                                    {{ $vehicle->no_of_seats ?? '4' }} Seats
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.vehicle.edit', $vehicle->id) }}" class="btn btn-sm btn-outline-danger p-1 px-2 border-0" style="background: rgba(255, 46, 46, 0.05);">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-secondary p-1 px-2 border-0 btn-delete-vehicle" 
                                            data-url="{{ route('admin.vehicle.delete', $vehicle->id) }}"
                                            style="background: rgba(0, 0, 0, 0.05);">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-truck fs-1 d-block mb-2"></i>
                                No vehicles found in the fleet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $vehicles->links('vendor.pagination.riden') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Tooltips
            tippy('.tippy-driver', {
                allowHTML: true,
                placement: 'top',
                theme: 'light-border',
                animation: 'shift-away'
            });

            // Delete Confirmation
            const deleteButtons = document.querySelectorAll('.btn-delete-vehicle');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This vehicle and its images will be permanently removed!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#FF2E2E',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!',
                        borderRadius: '15px'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>
@endpush
