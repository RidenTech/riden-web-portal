@extends('admin.layout.master')

@section('title', 'Driver Profile | Riden Admin')

@push('styles')
    <link href="{{ asset('assets/css/drivers.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
    <style>
        .doc-card-premium {
            background: #fff;
            border: 1px solid #E5E7EB;
            border-radius: 20px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            transition: all 0.2s;
        }
        .doc-card-premium:hover {
            border-color: var(--riden-red);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .doc-icon {
            width: 50px;
            height: 50px;
            background: #FFEEEE;
            color: var(--riden-red);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .btn-view-doc {
            background: #f3f4f6;
            color: #111;
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
        }
    </style>
@endpush

@section('content')
<div class="col-12 driver-detail-wrapper px-0">
    <!-- 1. Profile Header -->
    <div class="profile-row-driver">
        <div class="profile-card-left">
            <a href="{{ route('admin.drivers.directory') }}" class="back-btn-driver">
                <i class="bi bi-chevron-left"></i>
            </a>
            <div class="driver-avatar-view-wrapper">
                @if($driver->avatar)
                    <img src="{{ asset('storage/'.$driver->avatar) }}" class="driver-avatar-view-img" alt="">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($driver->first_name . ' ' . $driver->last_name) }}&background=random" class="driver-avatar-view-img" alt="">
                @endif
            </div>
            <div class="driver-identity">
                <h4>{{ $driver->first_name }} {{ $driver->last_name }}</h4>
                <div class="driver-rating-line">
                    <div class="stars text-warning d-flex gap-1">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill" style="opacity: 0.3;"></i>
                    </div>
                    <span class="ms-2 fw-semibold">(4.0)</span>
                    <span class="ms-3 status-badge {{ strtolower($driver->status) == 'active' ? 'online' : (strtolower($driver->status) == 'blocked' ? 'blocked' : 'suspended') }}">{{ $driver->status }}</span>
                </div>
            </div>
        </div>
        <div class="since-date-view text-muted">
            Registered: {{ $driver->created_at->format('M d, Y') }}
        </div>
    </div>

    <!-- 2. Stats Banner -->
    <div class="driver-stats-banner mt-2">
        <div class="driver-stat-unit">
            <div class="driver-stat-circle">
                <i class="bi bi-truck"></i>
            </div>
            <div class="driver-stat-data">
                <label>Total Rides</label>
                <div class="stat-value">0</div>
            </div>
        </div>
        <div class="driver-divider"></div>
        <div class="driver-stat-unit">
            <div class="driver-stat-circle">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="driver-stat-data">
                <label>Completed</label>
                <div class="stat-value">0</div>
            </div>
        </div>
        <div class="driver-divider"></div>
        <div class="driver-stat-unit">
            <div class="driver-stat-circle">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="driver-stat-data">
                <label>Revenue</label>
                <div class="stat-value">$0.00</div>
            </div>
        </div>
    </div>

    <!-- 3. Navigation & Detail Grid -->
    <div class="row g-2 mt-0">
        <!-- Sidebar Navigation -->
        <div class="col-lg-4">
            <div class="driver-nav-list" id="driverTabList">
                <a href="#personal" class="driver-nav-item active" data-bs-toggle="tab">
                    <div class="icon-wrapper"><i class="bi bi-person-fill"></i></div>
                    Personal Information
                </a>
                <a href="#vehicle" class="driver-nav-item" data-bs-toggle="tab">
                    <div class="icon-wrapper"><i class="bi bi-car-front-fill"></i></div>
                    Vehicle Information
                </a>
                <a href="#documents" class="driver-nav-item" data-bs-toggle="tab">
                    <div class="icon-wrapper"><i class="bi bi-file-earmark-text-fill"></i></div>
                    Documents
                </a>
                <a href="#rides" class="driver-nav-item" data-bs-toggle="tab">
                    <div class="icon-wrapper"><i class="bi bi-map-fill"></i></div>
                    All Rides
                </a>
            </div>

            <!-- Action Buttons -->
            <div class="driver-action-buttons">
                @if($driver->status == 'Active')
                    <form action="{{ route('admin.drivers.toggleStatus', $driver->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="Blocked">
                        <button type="submit" class="btn-driver-action btn-driver-solid-red">
                            <i class="bi bi-slash-circle-fill"></i> Block Driver
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.drivers.toggleStatus', $driver->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="Active">
                        <button type="submit" class="btn-driver-action btn-driver-solid-red" style="background-color: #28a745 !important;">
                            <i class="bi bi-check-circle-fill"></i> Activate Driver
                        </button>
                    </form>
                @endif

                <form action="{{ route('admin.drivers.delete', $driver->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this driver?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-driver-action btn-driver-outline-red">
                        <i class="bi bi-trash-fill text-danger"></i> Delete Driver
                    </button>
                </form>
            </div>
        </div>

        <!-- Detail Content -->
        <div class="col-lg-8">
            <div class="tab-content h-100" id="driverTabContent">
                <!-- Personal Info Section -->
                <div class="tab-pane fade show active" id="personal">
                    <div class="driver-info-card">
                        <div class="driver-info-card-header">
                            <i class="bi bi-person-fill"></i>
                            <h5>Personal Details</h5>
                        </div>
                        <div class="driver-info-grid">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="label-view">Full Name</label>
                                    <p class="value-view">{{ $driver->first_name }} {{ $driver->last_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="label-view">Email Address</label>
                                    <p class="value-view">{{ $driver->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="label-view">Phone Number</label>
                                    <p class="value-view">{{ $driver->phone }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="label-view">Gender</label>
                                    <p class="value-view">{{ $driver->gender }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="label-view">Unique ID</label>
                                    <p class="value-view red-text">{{ $driver->unique_id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Info Section -->
                <div class="tab-pane fade" id="vehicle">
                    <div class="driver-info-card">
                        <div class="driver-info-card-header" style="background: #111 !important;">
                            <i class="bi bi-car-front-fill"></i>
                            <h5>Vehicle Specifications</h5>
                        </div>
                        <div class="driver-info-grid">
                            @if($driver->vehicle)
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="label-view">Model</label>
                                        <p class="value-view">{{ $driver->vehicle->model }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="label-view">Year</label>
                                        <p class="value-view">{{ $driver->vehicle->year }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="label-view">Color</label>
                                        <p class="value-view">{{ $driver->vehicle->color }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="label-view">License Plate</label>
                                        <p class="value-view fw-bold">{{ $driver->vehicle->license_plate }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="label-view">Type</label>
                                        <p class="value-view">{{ $driver->vehicle->vehicle_type ?? 'Sedan' }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <p class="text-muted">No vehicle information found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Documents Section -->
                <div class="tab-pane fade" id="documents">
                    <div class="driver-info-card">
                        <div class="driver-info-card-header" style="background: #555 !important;">
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <h5>Stored Documents</h5>
                        </div>
                        <div class="driver-info-grid">
                            @forelse($driver->documents as $doc)
                                <div class="doc-card-premium">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="doc-icon">
                                            @if(Str::endsWith($doc->file_path, '.pdf'))
                                                <i class="bi bi-file-earmark-pdf"></i>
                                            @else
                                                <i class="bi bi-file-earmark-image"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $doc->document_name }}</h6>
                                            <small class="text-muted">{{ $doc->status }} • {{ $doc->created_at->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                    <button type="button" 
                                            class="btn-view-doc border-0" 
                                            onclick="previewDocument('{{ asset('storage/'.$doc->file_path) }}', '{{ addslashes($doc->document_name) }}')">
                                        View Document
                                    </button>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <p class="text-muted">No documents uploaded.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- All Rides Section -->
                <div class="tab-pane fade" id="rides">
                    <div class="driver-info-card">
                        <div class="driver-info-card-header">
                            <i class="bi bi-map-fill"></i>
                            <h5>Recent Ride History</h5>
                        </div>
                        <div class="driver-info-grid text-center py-5">
                            <img src="{{ asset('assets/img/no-data.svg') }}" alt="" style="width: 150px; opacity: 0.5;">
                            <p class="text-muted mt-3">No ride data available yet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Premium Document Preview Modal -->
<div class="modal fade" id="docPreviewModal" tabindex="-1" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
            <div class="modal-header bg-dark text-white border-0 py-3 px-4">
                <h5 class="modal-title fw-bold" id="docPreviewTitle">Document Preview</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 bg-light">
                <div id="docPreviewContent" class="text-center" style="min-height: 400px; display: flex; align-items: center; justify-content: center;">
                    <img id="docPreviewImg" src="" class="img-fluid d-none" style="max-height: 80vh;" alt="">
                    <iframe id="docPreviewFrame" src="" class="d-none" style="width: 100%; height: 80vh; border: none;"></iframe>
                </div>
            </div>
            <div class="modal-footer border-0 p-3">
                <button type="button" class="btn btn-secondary rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Close Preview</button>
                <a id="docDownloadBtn" href="#" download class="btn btn-danger rounded-pill px-4 fw-bold">Download File</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
/**
 * Global Fail-Safe Preview Function
 * Senior Developer Standard: Direct triggers bypass many standard framework bugs
 */
function previewDocument(url, title) {
    const modalEl = document.getElementById('docPreviewModal');
    if (!modalEl) return;

    // Use Bootstrap instance
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    
    const frame = document.getElementById('docPreviewFrame');
    const img = document.getElementById('docPreviewImg');
    const downloadBtn = document.getElementById('docDownloadBtn');
    const titleEl = document.getElementById('docPreviewTitle');
    
    if (titleEl) titleEl.innerText = title;
    if (downloadBtn) downloadBtn.href = url;
    
    // Clear State
    img.classList.add('d-none');
    frame.classList.add('d-none');
    img.src = '';
    frame.src = '';
    
    if (url.toLowerCase().endsWith('.pdf')) {
        frame.classList.remove('d-none');
        frame.src = url;
    } else {
        img.classList.remove('d-none');
        img.src = url;
    }
    
    modal.show();
}

document.addEventListener('DOMContentLoaded', function() {
    // Tab Navigation Logic
    const tabLinks = document.querySelectorAll('.driver-nav-item');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            tabLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            tabPanes.forEach(pane => pane.classList.remove('show', 'active'));
            const targetId = this.getAttribute('href').substring(1);
            const targetPane = document.getElementById(targetId);
            if (targetPane) targetPane.classList.add('show', 'active');
        });
    });
});
</script>
@endpush
