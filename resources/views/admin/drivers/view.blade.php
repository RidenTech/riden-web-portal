@extends('admin.layout.master')

@section('title', 'Driver Profile Details')

@push('styles')
    <link href="{{ asset('assets/css/drivers.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
    <style>
        /* Senior UI Detail Refinement */
        .driver-detail-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .premium-detail-card {
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            margin-bottom: 30px;
        }

        .profile-hero-section {
            background: linear-gradient(135deg, #fdf2f2 0%, #fff 100%);
            padding: 40px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .hero-avatar-wrapper {
            position: relative;
        }

        .hero-avatar {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
            object-fit: cover;
        }

        .status-badge-hero {
            position: absolute;
            bottom: 5px;
            right: 5px;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            border: 2px solid #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .hero-info h2 {
            font-weight: 800;
            margin-bottom: 5px;
            color: #1a202c;
        }

        .id-pill-premium {
            background: rgba(209, 0, 0, 0.1);
            color: #D10000;
            padding: 4px 12px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
        }

        /* Unified Sections Styling */
        .detail-section-premium {
            padding: 40px;
        }

        .section-header-red {
            color: var(--riden-red);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.85rem;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-header-red::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #f0f0f0;
        }

        .data-unit-premium {
            margin-bottom: 25px;
        }

        .data-unit-premium label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: #A0AEC0;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .data-unit-premium span {
            font-weight: 600;
            color: #2D3748;
            font-size: 1rem;
        }

        .section-divider-premium {
            margin: 20px 0 40px 0;
            border-top: 1px solid #f7fafc;
        }

        /* Document Display */
        .doc-grid-premium {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .doc-card-premium {
            background: #f8fafc;
            border: 1px solid #EDF2F7;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.2s;
        }

        .doc-card-premium:hover {
            border-color: var(--riden-red);
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .doc-icon-box {
            width: 50px;
            height: 50px;
            background: #fff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--riden-red);
            font-size: 1.4rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .btn-view-premium {
            background: #fff;
            color: #4A5568;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 6px 12px;
            font-size: 0.75rem;
            font-weight: 700;
            transition: all 0.2s;
        }

        .btn-view-premium:hover {
            background: var(--riden-red);
            color: #fff;
            border-color: var(--riden-red);
        }

        /* Stats Strip */
        .stats-strip-premium {
            background: #111;
            padding: 25px;
            border-radius: 20px;
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            color: #fff;
        }

        .stat-item-premium {
            text-align: center;
        }

        .stat-item-premium i {
            color: var(--riden-red);
            font-size: 1.5rem;
            margin-bottom: 5px;
            display: block;
        }

        .stat-item-premium h5 {
            margin: 0;
            font-weight: 800;
            font-size: 1.2rem;
        }

        .stat-item-premium p {
            margin: 0;
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 700;
            opacity: 0.6;
        }
    </style>
@endpush

@section('content')
<div class="riden-addadmin-wrap">
    <!-- Header/Breadcrumbs -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Profile Overview</h3>
            <span class="text-muted small">Managing Driver Account Records</span>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.drivers.directory') }}" class="btn-back-premium">
                <i class="bi bi-arrow-left"></i> <span>Directory</span>
            </a>
            <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn-figma-blue-pill shadow-sm" style="height: 42px; border: none;">
                <i class="bi bi-pencil-square me-1"></i> Edit Profile
            </a>
        </div>
    </div>

    <div class="driver-detail-container">
        <!-- Stats Strip -->
        <div class="stats-strip-premium px-5">
            <div class="stat-item-premium">
                <i class="bi bi-truck"></i>
                <h5>0</h5>
                <p>Total Rides</p>
            </div>
            <div class="stat-item-premium">
                <i class="bi bi-star-fill"></i>
                <h5>5.0</h5>
                <p>Avg Rating</p>
            </div>
            <div class="stat-item-premium">
                <i class="bi bi-wallet2"></i>
                <h5>$0.00</h5>
                <p>Earnings</p>
            </div>
            <div class="stat-item-premium">
                <i class="bi bi-calendar-check"></i>
                <h5>{{ $driver->created_at->format('M Y') }}</h5>
                <p>Joined Since</p>
            </div>
        </div>

        <div class="premium-detail-card shadow-sm">
            <!-- Profile Hero -->
            <div class="profile-hero-section">
                <div class="hero-avatar-wrapper">
                    @if($driver->avatar)
                        <img src="{{ asset('storage/'.$driver->avatar) }}" class="hero-avatar" alt="">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($driver->first_name . ' ' . $driver->last_name) }}&background=EBF4FF&color=3182CE&bold=true" class="hero-avatar" alt="">
                    @endif
                    <span class="status-badge-hero {{ strtolower($driver->status) == 'active' ? 'online' : (strtolower($driver->status) == 'blocked' ? 'blocked' : 'suspended') }}">
                        {{ $driver->status }}
                    </span>
                </div>
                <div class="hero-info">
                    <span class="id-pill-premium mb-2 d-inline-block">{{ $driver->unique_id }}</span>
                    <h2>{{ $driver->first_name }} {{ $driver->last_name }}</h2>
                    <div class="text-muted small">
                        <i class="bi bi-envelope me-1"></i> {{ $driver->email }} • 
                        <i class="bi bi-telephone me-1"></i> {{ $driver->phone }}
                    </div>
                </div>
                
                <div class="ms-auto d-flex flex-column gap-2">
                    @if($driver->status == 'Active')
                        <form action="{{ route('admin.drivers.toggleStatus', $driver->id) }}" method="POST" id="blockForm">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="Blocked">
                            <button type="button" class="btn btn-outline-danger rounded-pill px-4 fw-bold w-100" onclick="confirmStatusChange('Block Driver?', 'They will be instantly restricted from all mobile services.', 'Blocked')">
                                <i class="bi bi-slash-circle me-1"></i> Block Account
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.drivers.toggleStatus', $driver->id) }}" method="POST" id="activateForm">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="Active">
                            <button type="button" class="btn btn-success rounded-pill px-4 fw-bold w-100" onclick="confirmStatusChange('Activate Driver?', 'Access to mobile app will be restored immediately.', 'Active')">
                                <i class="bi bi-check-circle me-1"></i> Activate Account
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Unified Details Body -->
            <div class="detail-section-premium">
                
                <!-- 1. PERSONAL INFORMATION -->
                <div class="section-header-red">
                    <i class="bi bi-person-lines-fill"></i> Personal Information
                </div>
                <div class="row row-cols-md-3 g-2">
                    <div class="col">
                        <div class="data-unit-premium">
                            <label>First Name</label>
                            <span>{{ $driver->first_name }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-unit-premium">
                            <label>Last Name</label>
                            <span>{{ $driver->last_name }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-unit-premium">
                            <label>Gender</label>
                            <span>{{ $driver->gender }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-unit-premium">
                            <label>Joined Date</label>
                            <span>{{ $driver->created_at->format('d M, Y') }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-unit-premium">
                            <label>Current Status</label>
                            <span class="text-danger fw-bold">{{ $driver->status }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="data-unit-premium">
                            <label>Riden Unique ID</label>
                            <span class="fw-bold">{{ $driver->unique_id }}</span>
                        </div>
                    </div>
                </div>

                <div class="section-divider-premium"></div>

                <!-- 2. VEHICLE INFORMATION -->
                <div class="section-header-red">
                    <i class="bi bi-truck"></i> Vehicle Specifications
                </div>
                @if($driver->vehicle)
                    <div class="row row-cols-md-3 g-2">
                        <div class="col">
                            <div class="data-unit-premium">
                                <label>Model</label>
                                <span>{{ $driver->vehicle->model }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="data-unit-premium">
                                <label>License Plate</label>
                                <span class="badge bg-dark px-3 py-2 fs-6">{{ $driver->vehicle->license_plate }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="data-unit-premium">
                                <label>Model Year</label>
                                <span>{{ $driver->vehicle->year }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="data-unit-premium">
                                <label>Vehicle Color</label>
                                <span>{{ $driver->vehicle->color }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="data-unit-premium">
                                <label>Vehicle Type</label>
                                <span>{{ $driver->vehicle->vehicle_type ?? 'Sedan' }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="data-unit-premium">
                                <label>Document Status</label>
                                <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Verified</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-light p-4 rounded-4 text-center text-muted small">
                        <i class="bi bi-info-circle me-1"></i> No vehicle data associated with this profile.
                    </div>
                @endif

                <div class="section-divider-premium"></div>

                <!-- 3. DOCUMENTS -->
                <div class="section-header-red">
                    <i class="bi bi-file-earmark-lock-fill"></i> Verified Documents
                </div>
                <div class="doc-grid-premium">
                    @forelse($driver->documents as $doc)
                        <div class="doc-card-premium">
                            <div class="doc-icon-box">
                                <i class="bi {{ Str::endsWith($doc->file_path, '.pdf') ? 'bi-file-earmark-pdf' : 'bi-file-earmark-image' }}"></i>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h6 class="mb-0 fw-bold text-truncate" style="font-size: 0.85rem;">{{ $doc->document_name }}</h6>
                                <p class="text-muted mb-0" style="font-size: 0.65rem;">Updated: {{ $doc->updated_at->format('d M, Y') }}</p>
                            </div>
                            <button type="button" 
                                    class="btn-view-premium"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#docPreviewModal"
                                    data-bs-url="{{ asset('storage/'.$doc->file_path) }}"
                                    data-bs-title="{{ $doc->document_name }}">
                                VIEW
                            </button>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4 bg-light rounded-4 text-muted small">
                            No account documents uploaded.
                        </div>
                    @endforelse
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
                <button type="button" class="btn btn-secondary rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Close</button>
                <a id="docDownloadBtn" href="#" download class="btn btn-danger rounded-pill px-4 fw-bold">Download File</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmStatusChange(title, text, status) {
        Swal.fire({
            title: title,
            text: text,
            icon: status === 'Blocked' ? 'warning' : 'info',
            showCancelButton: true,
            confirmButtonColor: status === 'Blocked' ? '#D10000' : '#28a745',
            cancelButtonColor: '#718096',
            confirmButtonText: status === 'Blocked' ? 'Yes, Block Account' : 'Yes, Activate Account',
            borderRadius: '20px'
        }).then((result) => {
            if (result.isConfirmed) {
                if(status === 'Blocked') document.getElementById('blockForm').submit();
                else document.getElementById('activateForm').submit();
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
                img.src = '';
                frame.src = '';
                
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
        Swal.fire({
            icon: 'success',
            title: 'Action Successful',
            text: "{{ session('status') }}",
            confirmButtonColor: '#D10000',
            timer: 3000
        });
    @endif
</script>
@endpush
