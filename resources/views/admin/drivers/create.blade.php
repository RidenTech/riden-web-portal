@extends('admin.layout.master')

@section('title', 'Driver Management')

@push('styles')
    <link href="{{ asset('assets/css/addadmin.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
    <style>
        /* Senior UI Refinement */
        .riden-addadmin-card {
            max-width: 1000px;
            margin: 0 auto;
        }

        .section-separator {
            border-top: 1px solid #f0f0f0;
            margin: 40px 0;
            position: relative;
        }

        .section-label-premium {
            color: var(--riden-red);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.85rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-label-premium::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        /* Avatar dashed upload */
        .avatar-upload-dashed {
            border: 2px dashed #E2E8F0;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            background: #F8FAFC;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 30px;
        }

        .avatar-upload-dashed:hover {
            border-color: var(--riden-red);
            background: #FFF5F5;
        }

        .preview-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #EDF2F7;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 3px solid #fff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .preview-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-circle i {
            font-size: 40px;
            color: #A0AEC0;
        }

        .upload-text-premium {
            font-weight: 600;
            color: #4A5568;
            margin-bottom: 5px;
        }

        .upload-hint-premium {
            font-size: 0.8rem;
            color: #718096;
        }

        /* Document cards */
        .doc-item-premium {
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.2s;
        }

        .doc-item-premium:hover {
            border-color: var(--riden-red);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .btn-add-doc {
            background: #F8FAFC;
            border: 1px dashed #CBD5E0;
            color: #4A5568;
            font-weight: 600;
            padding: 12px;
            border-radius: 12px;
            width: 100%;
            margin-top: 10px;
            transition: all 0.2s;
        }

        .btn-add-doc:hover {
            background: #EDF2F7;
            border-color: #A0AEC0;
        }
    </style>
@endpush

@section('content')
<div class="riden-addadmin-wrap">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="riden-addadmin-header">
            <h3 class="fw-bold mb-1">Add New Driver</h3>
            <p class="text-muted small mb-0">Register a new driver with vehicle and document details</p>
        </div>
        <a href="{{ route('admin.drivers.directory') }}" class="btn-back-premium">
            <i class="bi bi-arrow-left"></i> <span>Back to Directory</span>
        </a>
    </div>

    <!-- Main Form Card -->
    <div class="riden-addadmin-card shadow-sm border-0">
        <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data" id="driverForm" data-parsley-validate>
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger rounded-4 border-0 mb-4 shadow-sm">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- 1. IDENTIFICATION SECTION -->
            <div class="section-label-premium">
                <i class="bi bi-person-badge"></i> Personal Identification
            </div>

            <div class="row g-4">
                <!-- Profile Upload -->
                <div class="col-12">
                    <div class="avatar-upload-dashed" onclick="document.getElementById('avatarInput').click();">
                        <div class="preview-circle" id="imagePreview">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="upload-text-premium">Drop your profile picture here or click to browse</div>
                        <div class="upload-hint-premium">Supported formats: JPG, PNG, WEBP (Max 2MB)</div>
                        <input type="file" name="avatar" id="avatarInput" hidden accept="image/*" onchange="previewAvatar(this);">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">First Name <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-person"></i>
                        <input type="text" name="first_name" class="riden-input" placeholder="e.g. John" value="{{ old('first_name') }}" 
                               required data-parsley-trigger="keyup" data-parsley-minlength="2">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">Last Name <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-person"></i>
                        <input type="text" name="last_name" class="riden-input" placeholder="e.g. Doe" value="{{ old('last_name') }}" 
                               required data-parsley-trigger="keyup" data-parsley-minlength="2">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">Email Address <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" class="riden-input" placeholder="john.doe@example.com" value="{{ old('email') }}" 
                               required data-parsley-type="email" data-parsley-trigger="change">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">Phone Number <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-telephone"></i>
                        <input type="text" name="phone" id="phone" class="riden-input" placeholder="+1 234 567 890" value="{{ old('phone') }}" 
                               required data-parsley-pattern="^\+?[1-9]\d{1,14}$" data-parsley-trigger="change">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">Gender <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-gender-ambiguous"></i>
                        <select name="gender" class="riden-input" required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">Password <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-shield-lock"></i>
                        <input type="password" name="password" id="password" class="riden-input" placeholder="Create secure password" 
                               required data-parsley-minlength="8" data-parsley-trigger="keyup">
                    </div>
                </div>
            </div>

            <div class="section-separator"></div>

            <!-- 2. VEHICLE SPECIFICATIONS SECTION -->
            <div class="section-label-premium">
                <i class="bi bi-truck"></i> Vehicle Specifications
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="riden-label">Vehicle Model <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-truck"></i>
                        <input type="text" name="model" class="riden-input" placeholder="e.g. Toyota Camry" value="{{ old('model') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">License Plate <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-card-text"></i>
                        <input type="text" name="license_plate" class="riden-input" placeholder="e.g. ABC-1234" value="{{ old('license_plate') }}" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="riden-label">Model Year <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-calendar-event"></i>
                        <input type="text" name="year" class="riden-input" placeholder="e.g. 2023" value="{{ old('year') }}" 
                               required data-parsley-type="digits" data-parsley-length="[4, 4]">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="riden-label">Vehicle Color <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-palette"></i>
                        <input type="text" name="color" class="riden-input" placeholder="e.g. Black" value="{{ old('color') }}" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="riden-label">Vehicle Type <span class="text-danger">*</span></label>
                    <div class="riden-input-group">
                        <i class="bi bi-tag-fill"></i>
                        <select name="vehicle_type" class="riden-input" required>
                            <option value="Sedan" {{ old('vehicle_type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="SUV" {{ old('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="Luxury" {{ old('vehicle_type') == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                            <option value="Bike" {{ old('vehicle_type') == 'Bike' ? 'selected' : '' }}>Bike</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="section-separator"></div>

            <!-- 3. REQUIRED DOCUMENTS SECTION -->
            <div class="section-label-premium">
                <i class="bi bi-file-earmark-text"></i> Driver Documents
            </div>

            <div id="documents-container" class="row g-4">
                <div class="col-12 text-muted small mb-2">Upload required identification documents (License, CNIC, etc.)</div>
                
                <div class="col-md-6 doc-item-wrapper">
                    <div class="doc-item-premium">
                        <label class="riden-label">Document Name</label>
                        <div class="riden-input-group mb-3">
                            <i class="bi bi-pencil-square"></i>
                            <input type="text" name="doc_name[]" class="riden-input" placeholder="e.g. Driving License" required>
                        </div>
                        <label class="riden-label">File Upload</label>
                        <input type="file" name="doc_file[]" class="form-control rounded-3" required>
                    </div>
                </div>
            </div>

            <button type="button" id="add-doc-btn" class="btn-add-doc">
                <i class="bi bi-plus-lg"></i> Add Another Document
            </button>

            <div class="mt-5 pt-3">
                <button type="submit" class="btn-riden-primary w-100 py-3 rounded-pill fw-bold" id="submitBtn">
                    <i class="bi bi-check-circle-fill me-2"></i> Register Driver Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(function () {
            // Parsley Configuration
            const parsleyOptions = {
                errorClass: 'is-invalid',
                successClass: 'is-valid',
                errorsWrapper: '<ul class="parsley-errors-list"></ul>',
                itemClass: 'parsley-error',
                trigger: 'change keyup focusout'
            };

            $('#driverForm').parsley(parsleyOptions);

            // Add Document Logic
            $('#add-doc-btn').on('click', function() {
                const newDocItem = `
                    <div class="col-md-6 doc-item-wrapper">
                        <div class="doc-item-premium position-relative">
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-doc" style="font-size: 0.7rem;"></button>
                            <label class="riden-label">Document Name</label>
                            <div class="riden-input-group mb-3">
                                <i class="bi bi-pencil-square"></i>
                                <input type="text" name="doc_name[]" class="riden-input" placeholder="e.g. NIC Front" required>
                            </div>
                            <label class="riden-label">File Upload</label>
                            <input type="file" name="doc_file[]" class="form-control rounded-3" required>
                        </div>
                    </div>
                `;
                $('#documents-container').append(newDocItem);
            });

            // Remove Doc Logic
            $(document).on('click', '.remove-doc', function() {
                $(this).closest('.doc-item-wrapper').remove();
            });

            // Status message from PHP
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#D10000',
                    timer: 3000
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#D10000'
                });
            @endif
        });

        function previewAvatar(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Avatar Preview">`;
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.innerHTML = `<i class="bi bi-person-fill"></i>`;
            }
        }
    </script>
@endpush
