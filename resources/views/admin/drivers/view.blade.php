@extends('admin.layout.master')

@section('title', 'Driver Profile Details')

@push('styles')
    <link href="{{ asset('assets/css/drivers.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
    <style>
        /* Senior UI Rescue Refinement */
        .driver-detail-page-wrapper {
            max-width: 1100px;
            margin: 0 auto;
        }

        .premium-profile-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.03);
            border: 1px solid #f1f3f5;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .hero-banner-premium {
            background: linear-gradient(135deg, #fff 0%, #fdf2f2 100%);
            padding: 40px;
            border-bottom: 1px solid #f8f9fa;
            display: flex;
            align-items: center;
            gap: 35px;
            position: relative;
        }

        .avatar-box-premium {
            position: relative;
            width: 140px;
            height: 140px;
        }

        .main-avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 24px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        }

        .status-pill-senior {
            position: absolute;
            background: #fff;
            padding: 5px 15px;
            border-radius: 30px;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            white-space: nowrap;
            letter-spacing: 0.5px;
            color: #111;
        }

        .status-pill-senior.active { border-left: 4px solid #28a745; color: #155724; }
        .status-pill-senior.blocked { border-left: 4px solid #D10000; color: #721c24; }
        .status-pill-senior.suspended { border-left: 4px solid #ffc107; color: #856404; }

        .hero-details-premium h2 {
            font-weight: 800;
            margin-bottom: 8px;
            font-size: 2rem;
            color: #1a202c;
        }

        .info-strip-hero {
            display: flex;
            gap: 20px;
            color: #718096;
            font-size: 0.85rem;
        }

        .id-label-senior {
            background: var(--riden-red);
            color: #fff;
            padding: 4px 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
            margin-bottom: 12px;
            display: inline-block;
        }

        /* Stats Row Design (Replacing Black Bar) */
        .stats-integrated-row {
            display: flex;
            justify-content: space-between;
            padding: 25px 40px;
            background: #fff;
            border-bottom: 1px solid #f8f9fa;
        }

        .stat-card-minimal {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #FFEEEE;
            color: var(--riden-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stat-info-text label {
            display: block;
            font-size: 0.65rem;
            font-weight: 700;
            color: #A0AEC0;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .stat-info-text span {
            font-weight: 800;
            font-size: 1.1rem;
            color: #2d3748;
        }

        /* Information Grid */
        .info-content-premium {
            padding: 40px;
        }

        .senior-section-header {
            color: var(--riden-red);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.8rem;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .senior-section-header::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #f1f3f5;
        }

        .data-cell-premium {
            margin-bottom: 30px;
        }

        .data-cell-premium label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            color: #A0AEC0;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .data-cell-premium p {
            font-weight: 600;
            color: #1a202c;
            font-size: 0.95rem;
            margin: 0;
        }

        /* Documents Minimal */
        .doc-list-premium {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .doc-item-minimal {
            background: #fff;
            border: 1px solid #edf2f7;
            padding: 18px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s;
        }

        .doc-item-minimal:hover {
            border-color: var(--riden-red);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .btn-view-doc-minimal {
            border: none;
            background: #f7fafc;
            color: #4a5568;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            transition: 0.2s;
        }

        .btn-view-doc-minimal:hover {
            background: var(--riden-red);
            color: #fff;
        }
    </style>
@endpush

@section('content')
<div class="driver-detail-page-wrapper">
    <!-- Top Action Row -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="breadcrumb-senior">
            <h4 class="fw-bold mb-0">Driver Profile Details</h4>
            <div class="text-muted small">Viewing Administrative Records</div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.drivers.directory') }}" class="btn-back-premium">
                <i class="bi bi-arrow-left"></i> <span>Back to Directory</span>
            </a>
            <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn-figma-blue-pill shadow-sm" style="border: none; height: 42px;">
                <i class="bi bi-pencil-square me-2"></i> Edit Record
            </a>
        </div>
    </div>

    <!-- Main Profile Card -->
    <div class="premium-profile-card">
        <!-- Hero Header -->
        <div class="hero-banner-premium">
            <div class="avatar-box-premium">
                @if($driver->avatar)
                    <img src="{{ asset('storage/'.$driver->avatar) }}" class="main-avatar-img" alt="">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($driver->first_name . ' ' . $driver->last_name) }}&background=EBF4FF&color=3182CE&bold=true" class="main-avatar-img" alt="">
                @endif
                <span class="status-pill-senior {{ strtolower($driver->status) }}">
                    {{ $driver->status }}
                </span>
            </div>

            <div class="hero-details-premium">
                <span class="id-label-senior">{{ $driver->unique_id }}</span>
                <h2>{{ $driver->first_name }} {{ $driver->last_name }}</h2>
                <div class="info-strip-hero">
                    <span><i class="bi bi-envelope-fill me-1"></i> {{ $driver->email }}</span>
                    <span><i class="bi bi-telephone-fill me-1"></i> {{ $driver->phone }}</span>
                </div>
            </div>

            <div class="ms-auto">
                @if($driver->status == 'Active')
                    <form action="{{ route('admin.drivers.toggleStatus', $driver->id) }}" method="POST" id="statusForm">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="Blocked">
                        <button type="button" class="btn btn-outline-danger rounded-pill px-4 fw-bold shadow-sm" 
                                onclick="confirmStatusAction('Block Account?', 'Driver will not be able to accept rides.', 'Blocked')">
                            <i class="bi bi-slash-circle me-1"></i> Block Account
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.drivers.toggleStatus', $driver->id) }}" method="POST" id="statusForm">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="Active">
                        <button type="button" class="btn btn-success text-white rounded-pill px-4 fw-bold shadow-sm" 
                                onclick="confirmStatusAction('Activate Account?', 'Driver access will be restored.', 'Active')">
                            <i class="bi bi-check-circle me-1"></i> Activate Account
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Integrated Stats Row (Replacing Black Strip) -->
        <div class="stats-integrated-row">
            <div class="stat-card-minimal">
                <div class="stat-icon-box"><i class="bi bi-truck"></i></div>
                <div class="stat-info-text">
                    <label>Total Rides</label>
                    <span>0</span>
                </div>
            </div>
            <div class="stat-card-minimal">
                <div class="stat-icon-box"><i class="bi bi-star-fill"></i></div>
                <div class="stat-info-text">
                    <label>Rating</label>
                    <span>5.0</span>
                </div>
            </div>
            <div class="stat-card-minimal">
                <div class="stat-icon-box"><i class="bi bi-cash-stack"></i></div>
                <div class="stat-info-text">
                    <label>Total Earnings</label>
                    <span>$0.00</span>
                </div>
            </div>
            <div class="stat-card-minimal">
                <div class="stat-icon-box"><i class="bi bi-calendar3"></i></div>
                <div class="stat-info-text">
                    <label>Joined Since</label>
                    <span>{{ $driver->created_at->format('M Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Detailed Content Body -->
        <div class="info-content-premium">
            
            <!-- Personal Section -->
            <div class="senior-section-header">
                <i class="bi bi-person-lines-fill"></i> Personal Details
            </div>
            <div class="row row-cols-md-3">
                <div class="col">
                    <div class="data-cell-premium">
                        <label>First Name</label>
                        <p>{{ $driver->first_name }}</p>
                    </div>
                </div>
                <div class="col">
                    <div class="data-cell-premium">
                        <label>Last Name</label>
                        <p>{{ $driver->last_name }}</p>
                    </div>
                </div>
                <div class="col">
                    <div class="data-cell-premium">
                        <label>Gender/Identity</label>
                        <p>{{ $driver->gender }}</p>
                    </div>
                </div>
            </div>

            <!-- Vehicle Section -->
            <div class="senior-section-header">
                <i class="bi bi-car-front-fill"></i> Vehicle Specifications
            </div>
            @if($driver->vehicle)
                <div class="row row-cols-md-3">
                    <div class="col">
                        <div class="data-cell-premium">
                            <label>Model</label>
                            <p>{{ $driver->vehicle->model }}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-cell-premium">
                            <label>License Plate</label>
                            <p class="badge bg-dark px-3 py-2 mt-1 fs-6">{{ $driver->vehicle->license_plate }}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-cell-premium">
                            <label>Model Year</label>
                            <p>{{ $driver->vehicle->year }}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-cell-premium">
                            <label>Color</label>
                            <p>{{ $driver->vehicle->color }}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-cell-premium">
                            <label>Vehicle Category</label>
                            <p>{{ $driver->vehicle->vehicle_type ?? 'Sedan' }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-light text-center border py-4 rounded-4 mb-5">
                    <i class="bi bi-info-circle me-1"></i> No vehicle data associated with this profile.
                </div>
            @endif

            <!-- Documents Section -->
            <div class="senior-section-header">
                <i class="bi bi-file-earmark-check-fill"></i> Compliance Documents
            </div>
            <div class="doc-list-premium">
                @forelse($driver->documents as $doc)
                    <div class="doc-item-minimal">
                        <div class="d-flex align-items-center gap-3">
                            <div class="doc-icon-box" style="width: 40px; height: 40px; font-size: 1rem;">
                                <i class="bi {{ Str::endsWith($doc->file_path, '.pdf') ? 'bi-file-earmark-pdf' : 'bi-file-earmark-image' }}"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold" style="font-size: 0.85rem;">{{ $doc->document_name }}</h6>
                                <span class="text-muted" style="font-size: 0.65rem;">Updated {{ $doc->updated_at->format('d M, Y') }}</span>
                            </div>
                        </div>
                        <button type="button" 
                                class="btn-view-doc-minimal"
                                data-bs-toggle="modal" 
                                data-bs-target="#docPreviewModal"
                                data-bs-url="{{ asset('storage/'.$doc->file_path) }}"
                                data-bs-title="{{ $doc->document_name }}">
                            PREVIEW
                        </button>
                    </div>
                @empty
                    <div class="text-muted small text-center w-100 py-3 bg-light rounded-3">No documents found.</div>
                @endforelse
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
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0 bg-light">
                <div id="docPreviewContent" class="text-center" style="min-height: 400px; display: flex; align-items: center; justify-content: center;">
                    <img id="docPreviewImg" src="" class="img-fluid d-none" style="max-height: 80vh;" alt="">
                    <iframe id="docPreviewFrame" src="" class="d-none" style="width: 100%; height: 80vh; border: none;"></iframe>
                </div>
            </div>
            <div class="modal-footer border-0 p-3">
                <button type="button" class="btn btn-secondary rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Close</button>
                <a id="docDownloadBtn" href="#" download class="btn btn-danger rounded-pill px-4 fw-bold">Download</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmStatusAction(title, text, status) {
        Swal.fire({
            title: title,
            text: text,
            icon: status === 'Blocked' ? 'warning' : 'info',
            showCancelButton: true,
            confirmButtonColor: status === 'Blocked' ? '#D10000' : '#28a745',
            cancelButtonColor: '#718096',
            confirmButtonText: 'Confirm Action',
            borderRadius: '20px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('statusForm').submit();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('docPreviewModal');
        if (modalEl) {
            modalEl.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-bs-url');
                const title = button.getAttribute('data-bs-title');
                
                const frame = document.getElementById('docPreviewFrame');
                const img = document.getElementById('docPreviewImg');
                const downloadBtn = document.getElementById('docDownloadBtn');
                const titleEl = document.getElementById('docPreviewTitle');
                
                if (titleEl) titleEl.innerText = title;
                if (downloadBtn) downloadBtn.href = url;
                
                img.classList.add('d-none');
                frame.classList.add('d-none');
                
                if (url.toLowerCase().endsWith('.pdf')) {
                    frame.classList.remove('d-none');
                    frame.src = url;
                } else {
                    img.classList.remove('d-none');
                    img.src = url;
                }
            });
        }
    });

    @if(session('status'))
        Swal.fire({ icon: 'success', title: 'Done', text: "{{ session('status') }}", confirmButtonColor: '#D10000', timer: 2500 });
    @endif
</script>
@endpush
