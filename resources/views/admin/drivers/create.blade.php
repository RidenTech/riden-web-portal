@extends('admin.layout.master')

@section('title', 'Add New Driver | Riden Admin')

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
    </style>
@endpush

@section('content')
<div class="col-12 px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="passenger-page-title mb-0">Add New Driver</h3>
            <p class="text-muted small fw-semibold">Register a new driver with vehicle and documents</p>
        </div>
        <a href="{{ route('admin.drivers.directory') }}" class="back-btn-small">
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
        <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Section 1: Personal Info -->
            <div class="section-header">
                <i class="bi bi-person-fill"></i> Personal Information
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-12 mb-3">
                    <label class="figma-label">Profile Image</label>
                    <div class="figma-input-wrapper" style="border-style: dashed;">
                        <i class="bi bi-image figma-input-icon"></i>
                        <input type="file" name="avatar" class="figma-input" accept="image/*">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">First Name</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-person figma-input-icon"></i>
                        <input type="text" name="first_name" class="figma-input" placeholder="e.g. John" value="{{ old('first_name') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Last Name</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-person figma-input-icon"></i>
                        <input type="text" name="last_name" class="figma-input" placeholder="e.g. Doe" value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Email Address</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-envelope figma-input-icon"></i>
                        <input type="email" name="email" class="figma-input" placeholder="john.doe@example.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Phone Number</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-telephone figma-input-icon"></i>
                        <input type="text" name="phone" class="figma-input" placeholder="+1 234 567 890" value="{{ old('phone') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Gender</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-gender-ambiguous figma-input-icon"></i>
                        <select name="gender" class="figma-input figma-select" required>
                            <option value="" disabled selected>Select gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
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
                        <input type="text" name="model" class="figma-input" placeholder="e.g. Toyota Camry" value="{{ old('model') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Vehicle Year</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-calendar-event figma-input-icon"></i>
                        <input type="text" name="year" class="figma-input" placeholder="e.g. 2023" value="{{ old('year') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Vehicle Color</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-palette figma-input-icon"></i>
                        <input type="text" name="color" class="figma-input" placeholder="e.g. Metallic Black" value="{{ old('color') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">License Plate</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-card-text figma-input-icon"></i>
                        <input type="text" name="license_plate" class="figma-input" placeholder="e.g. ABC-1234" value="{{ old('license_plate') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="figma-label">Vehicle Type</label>
                    <div class="figma-input-wrapper">
                        <i class="bi bi-truck figma-input-icon"></i>
                        <select name="vehicle_type" class="figma-input figma-select">
                            <option value="Sedan">Sedan</option>
                            <option value="SUV">SUV</option>
                            <option value="Luxury">Luxury</option>
                            <option value="Bike">Bike</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 3: Documents -->
            <div class="section-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-file-earmark-pdf-fill"></i> Driver Documents</span>
                <button type="button" id="add-doc-btn" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i> Add More
                </button>
            </div>

            <div id="docs-container" class="mb-4">
                <div class="doc-item">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="small fw-bold text-muted mb-1">Document Name</label>
                            <input type="text" name="doc_names[]" class="form-control rounded-3 border-0 bg-white" placeholder="e.g. Driving License" value="Driving License" required>
                        </div>
                        <div class="col-md-5">
                            <label class="small fw-bold text-muted mb-1">Upload File</label>
                            <input type="file" name="documents[]" class="form-control rounded-3 border-0 bg-white doc-file-input" required accept="image/*">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <!-- Preview Box -->
                            <div class="doc-preview-container w-100">
                                <img src="#" alt="Doc Preview" class="doc-preview-box img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="doc-item">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="small fw-bold text-muted mb-1">Document Name</label>
                            <input type="text" name="doc_names[]" class="form-control rounded-3 border-0 bg-white" placeholder="e.g. ID Card" value="ID Card" required>
                        </div>
                        <div class="col-md-5">
                            <label class="small fw-bold text-muted mb-1">Upload File</label>
                            <input type="file" name="documents[]" class="form-control rounded-3 border-0 bg-white doc-file-input" required accept="image/*">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <!-- Preview Box -->
                            <div class="doc-preview-container w-100">
                                <img src="#" alt="Doc Preview" class="doc-preview-box img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="col-12 mt-5 pt-3 border-top">
                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn-figma-red-solid px-5" style="width: auto;">
                        Register Driver
                    </button>
                    <a href="{{ route('admin.drivers.directory') }}" class="text-decoration-none text-muted fw-bold small ms-2">
                        Cancel and Return
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Universal Preview Handler
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

    // Delegate Document Previews
    document.getElementById('docs-container').addEventListener('change', function(e) {
        if (e.target.classList.contains('doc-file-input')) {
            const row = e.target.closest('.row');
            const previewImg = row.querySelector('.doc-preview-box');
            handleFilePreview(e.target, previewImg, '.doc-preview-container');
        }
    });

    // Add More Documents
    document.getElementById('add-doc-btn').addEventListener('click', function() {
        const container = document.getElementById('docs-container');
        const newItem = document.createElement('div');
        newItem.className = 'doc-item';
        newItem.innerHTML = `
            <i class="bi bi-x-circle-fill remove-doc"></i>
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="small fw-bold text-muted mb-1">Document Name</label>
                    <input type="text" name="doc_names[]" class="form-control rounded-3 border-0 bg-white" placeholder="e.g. Insurance" required>
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
</script>
@endpush
