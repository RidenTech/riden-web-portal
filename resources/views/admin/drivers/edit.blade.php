@extends('admin.layout.master')

@section('title', 'Edit Driver | Riden Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/passenger.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/drivers.css') }}">
    <style>
        .section-header {
            background: #FFEEEE;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            color: #000;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .section-header i {
            color: var(--riden-red);
            font-size: 1.2rem;
        }
        .doc-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 15px;
            border: 1px dashed #ced4da;
            margin-bottom: 15px;
            position: relative;
        }
        .remove-doc {
            position: absolute;
            top: 10px;
            right: 10px;
            color: var(--riden-red);
            cursor: pointer;
            font-size: 1.2rem;
        }
        .doc-preview-container {
            display: none;
            height: 60px;
            width: 60px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
            margin-top: 5px;
        }
        .doc-preview-box {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .existing-doc-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            transition: all 0.2s;
        }
        .existing-doc-card:hover {
            border-color: var(--riden-red);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
    </style>
@endpush

@section('content')
<div class="col-12 px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="passenger-page-title mb-0">Edit Driver Profile</h3>
            <p class="text-muted small fw-semibold">Update records for <strong>{{ $driver->first_name }} {{ $driver->last_name }}</strong></p>
        </div>
        <a href="{{ route('admin.drivers.view', $driver->id) }}" class="back-btn-small">
            <i class="bi bi-chevron-left"></i>
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="figma-form-card">
        <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Section 1: Personal Info -->
            <div class="section-header">
                <i class="bi bi-person-fill"></i> Personal Information
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-12 mb-3">
                    <label class="figma-label">Profile Image (Optional)</label>
                    <div class="d-flex align-items-start gap-3">
                        <div class="figma-input-wrapper flex-grow-1" style="border-style: dashed;">
                            <i class="bi bi-image figma-input-icon"></i>
                            <input type="file" name="avatar" id="avatar-input" class="figma-input avatar-file-input" accept="image/*">
                        </div>
                        <div class="avatar-preview-container" id="avatar-preview-box" style="display: {{ $driver->avatar ? 'block' : 'none' }}; width: 80px; height: 80px; border-radius: 15px; overflow: hidden; border: 1.5px dashed #ced4da; flex-shrink: 0;">
                            <img src="{{ $driver->avatar ? asset('storage/' . $driver->avatar) : '#' }}" alt="Avatar Preview" id="avatar-preview-img" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">First Name</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-person figma-input-icon"></i>
                        <input type="text" name="first_name" class="figma-input" placeholder="e.g. John" value="{{ old('first_name', $driver->first_name) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Last Name</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-person figma-input-icon"></i>
                        <input type="text" name="last_name" class="figma-input" placeholder="e.g. Doe" value="{{ old('last_name', $driver->last_name) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Email Address</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-envelope figma-input-icon"></i>
                        <input type="email" name="email" class="figma-input" placeholder="john.doe@example.com" value="{{ old('email', $driver->email) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Phone Number</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-telephone figma-input-icon"></i>
                        <input type="text" name="phone" class="figma-input" placeholder="+1 234 567 890" value="{{ old('phone', $driver->phone) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Gender</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-gender-ambiguous figma-input-icon"></i>
                        <select name="gender" class="figma-input figma-select" required>
                            <option value="Male" {{ old('gender', $driver->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $driver->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $driver->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 2: Vehicle Info -->
            <div class="section-header">
                <i class="bi bi-car-front-fill"></i> Vehicle Information
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="figma-label">Vehicle Model</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-car-front figma-input-icon"></i>
                        <input type="text" name="model" class="figma-input" placeholder="e.g. Toyota Camry" value="{{ old('model', $driver->vehicle->model ?? '') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Vehicle Year</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-calendar-event figma-input-icon"></i>
                        <input type="text" name="year" class="figma-input" placeholder="e.g. 2023" value="{{ old('year', $driver->vehicle->year ?? '') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Vehicle Color</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-palette figma-input-icon"></i>
                        <input type="text" name="color" class="figma-input" placeholder="e.g. Metallic Black" value="{{ old('color', $driver->vehicle->color ?? '') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">License Plate</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-card-text figma-input-icon"></i>
                        <input type="text" name="license_plate" class="figma-input" placeholder="e.g. ABC-1234" value="{{ old('license_plate', $driver->vehicle->license_plate ?? '') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Vehicle Type</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-truck figma-input-icon"></i>
                        <select name="vehicle_type" class="figma-input figma-select">
                            <option value="Sedan" {{ old('vehicle_type', $driver->vehicle->vehicle_type ?? '') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="SUV" {{ old('vehicle_type', $driver->vehicle->vehicle_type ?? '') == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="Luxury" {{ old('vehicle_type', $driver->vehicle->vehicle_type ?? '') == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                            <option value="Bike" {{ old('vehicle_type', $driver->vehicle->vehicle_type ?? '') == 'Bike' ? 'selected' : '' }}>Bike</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 3: Existing Documents -->
            @if($driver->documents->count() > 0)
                <div class="section-header">
                    <i class="bi bi-file-earmark-check-fill"></i> Current Documents
                </div>
                <!-- Hidden input to track deleted documents -->
                <input type="hidden" name="deleted_documents" id="deleted-docs-input" value="">

                <div class="row g-4 mb-5">
                    @foreach($driver->documents as $doc)
                        <div class="col-md-6 existing-doc-item" data-id="{{ $doc->id }}">
                            <div class="existing-doc-card shadow-sm">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-box-small" style="background: #FFEEEE; padding: 10px; border-radius: 10px;">
                                        <i class="bi bi-file-earmark-text text-danger"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small">{{ $doc->document_name }}</div>
                                        <div class="text-muted" style="font-size: 11px;">Status: <span class="text-danger fw-bold">{{ $doc->status }}</span></div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" 
                                            class="btn btn-sm btn-light rounded-pill px-3 fw-bold small border"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#docPreviewModal"
                                            data-bs-url="{{ asset('storage/' . $doc->file_path) }}"
                                            data-bs-title="{{ $doc->document_name }}">
                                        View
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-2 remove-existing-doc" title="Remove Document">
                                        <i class="bi bi-trash3" style="font-size: 12px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Section 4: Add New Documents -->
            <div class="section-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-plus-circle-fill"></i> Upload New Documents</span>
                <button type="button" id="add-doc-btn" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold">
                    <i class="bi bi-plus-lg me-1"></i> Add More
                </button>
            </div>

            <div id="docs-container" class="mb-4">
                <!-- New documents will be appended here -->
            </div>

            <!-- Submit -->
            <div class="col-12 mt-5 pt-3 border-top">
                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn-figma-blue-pill px-5" style="width: auto;">
                        Save All Updates
                    </button>
                    <a href="{{ route('admin.drivers.view', $driver->id) }}" class="text-decoration-none text-muted fw-bold small ms-2">
                        Cancel and Return
                    </a>
                </div>
            </div>
        </form>
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
    function handleFilePreview(input, previewImg, containerSelector) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                const container = input.closest('.row').querySelector(containerSelector) || document.querySelector(containerSelector);
                if(container) container.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Handle Avatar Preview
    document.getElementById('avatar-input').addEventListener('change', function(e) {
        const previewImg = document.getElementById('avatar-preview-img');
        const previewBox = document.getElementById('avatar-preview-box');
        handleFilePreview(this, previewImg, '#avatar-preview-box');
    });

    document.getElementById('docs-container').addEventListener('change', function(e) {
        if (e.target.classList.contains('doc-file-input')) {
            const row = e.target.closest('.row');
            const previewImg = row.querySelector('.doc-preview-box');
            handleFilePreview(e.target, previewImg, '.doc-preview-container');
        }
    });

    document.getElementById('add-doc-btn').addEventListener('click', function() {
        const container = document.getElementById('docs-container');
        const newItem = document.createElement('div');
        newItem.className = 'doc-item';
        newItem.innerHTML = `
            <i class="bi bi-x-circle-fill remove-doc"></i>
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="small fw-bold text-muted mb-1">Document Name</label>
                    <input type="text" name="doc_names[]" class="form-control rounded-3 border-0 bg-white" placeholder="e.g. ID Card" required>
                </div>
                <div class="col-md-5">
                    <label class="small fw-bold text-muted mb-1">Upload File</label>
                    <input type="file" name="documents[]" class="form-control rounded-3 border-0 bg-white doc-file-input" required accept="image/*">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <div class="doc-preview-container w-100">
                        <img src="#" alt="Doc Preview" class="doc-preview-box img-fluid">
                    </div>
                </div>
            </div>
        `;
        container.appendChild(newItem);

        newItem.querySelector('.remove-doc').addEventListener('click', function() {
            newItem.remove();
        });
    });

    // Handle Existing Document Removal
    document.querySelectorAll('.remove-existing-doc').forEach(button => {
        button.addEventListener('click', function() {
            const item = this.closest('.existing-doc-item');
            const docId = item.getAttribute('data-id');
            const deletedInput = document.getElementById('deleted-docs-input');
            
            // Add ID to deleted list
            let deletedIds = deletedInput.value ? deletedInput.value.split(',') : [];
            if (!deletedIds.includes(docId)) {
                deletedIds.push(docId);
                deletedInput.value = deletedIds.join(',');
            }

            // Animate removal
            item.style.transition = 'all 0.4s ease';
            item.style.opacity = '0';
            item.style.transform = 'scale(0.9)';
            setTimeout(() => {
                item.style.display = 'none';
            }, 400);
        });
    });

    // Premium Document Preview Logic
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
            
            // Clear previous
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
</script>
@endpush
