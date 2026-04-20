@extends('admin.layout.master')

@section('title', 'Edit Driver Profile')

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
            padding: 25px;
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
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: #EDF2F7;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 4px solid #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .preview-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Existing Doc Cards */
        .existing-doc-card {
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            transition: all 0.2s ease;
        }

        .existing-doc-card:hover {
            border-color: var(--riden-red);
            background: #fdf2f2;
        }

        .doc-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .doc-icon-box {
            width: 45px;
            height: 45px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--riden-red);
            font-size: 1.2rem;
        }

        .doc-details h6 {
            margin: 0;
            font-weight: 700;
            color: #2D3748;
            font-size: 0.9rem;
        }

        .doc-details p {
            margin: 0;
            font-size: 0.75rem;
            color: #718096;
        }
    </style>
@endpush

@section('content')
<div class="riden-addadmin-wrap">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="riden-addadmin-header">
            <h3 class="fw-bold mb-1">Edit Driver Profile</h3>
            <p class="text-muted small mb-0">Modify details for <strong>{{ $driver->first_name }} {{ $driver->last_name }}</strong></p>
        </div>
        <a href="{{ route('admin.drivers.view', $driver->id) }}" class="btn-back-premium">
            <i class="bi bi-arrow-left"></i> <span>View Profile</span>
        </a>
    </div>

    <!-- Main Edit Card -->
    <div class="riden-addadmin-card shadow-sm border-0">
        <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data" id="editDriverForm" data-parsley-validate>
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-danger rounded-4 border-0 mb-4 shadow-sm">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- 1. PERSONAL INFORMATION -->
            <div class="section-label-premium">
                <i class="bi bi-person-badge"></i> Account & Identification
            </div>

            <div class="row g-4">
                <!-- Avatar Section -->
                <div class="col-12">
                    <div class="avatar-upload-dashed" onclick="document.getElementById('avatarInput').click();">
                        <div class="preview-circle" id="imagePreview">
                            @if($driver->avatar)
                                <img src="{{ asset('storage/' . $driver->avatar) }}" alt="Current Avatar">
                            @else
                                <i class="bi bi-person-fill"></i>
                            @endif
                        </div>
                        <div class="fw-bold text-dark mb-1">Update Driver Photo</div>
                        <div class="text-muted small">Click to upload a new profile image (Max 2MB)</div>
                        <input type="file" name="avatar" id="avatarInput" hidden accept="image/*" onchange="previewAvatar(this);">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">First Name</label>
                    <div class="riden-input-group">
                        <i class="bi bi-person"></i>
                        <input type="text" name="first_name" class="riden-input" value="{{ old('first_name', $driver->first_name) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">Last Name</label>
                    <div class="riden-input-group">
                        <i class="bi bi-person"></i>
                        <input type="text" name="last_name" class="riden-input" value="{{ old('last_name', $driver->last_name) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">Email Address</label>
                    <div class="riden-input-group">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" class="riden-input" value="{{ old('email', $driver->email) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">Phone Number</label>
                    <div class="riden-input-group">
                        <i class="bi bi-telephone"></i>
                        <input type="text" name="phone" class="riden-input" value="{{ old('phone', $driver->phone) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">Gender</label>
                    <div class="riden-input-group">
                        <i class="bi bi-gender-ambiguous"></i>
                        <select name="gender" class="riden-input" required>
                            <option value="Male" {{ $driver->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $driver->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ $driver->gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">Account Password</label>
                    <div class="riden-input-group">
                        <i class="bi bi-shield-lock"></i>
                        <input type="password" name="password" class="riden-input" placeholder="Leave blank to keep current password" 
                               data-parsley-minlength="8">
                    </div>
                </div>
            </div>

            <div class="section-separator"></div>

            <!-- 2. VEHICLE SPECIFICATIONS -->
            <div class="section-label-premium">
                <i class="bi bi-truck"></i> Vehicle Details
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="riden-label">Vehicle Model</label>
                    <div class="riden-input-group">
                        <i class="bi bi-truck"></i>
                        <input type="text" name="model" class="riden-input" value="{{ old('model', $driver->model) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="riden-label">License Plate</label>
                    <div class="riden-input-group">
                        <i class="bi bi-card-text"></i>
                        <input type="text" name="license_plate" class="riden-input" value="{{ old('license_plate', $driver->license_plate) }}" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="riden-label">Model Year</label>
                    <div class="riden-input-group">
                        <i class="bi bi-calendar-event"></i>
                        <input type="text" name="year" class="riden-input" value="{{ old('year', $driver->year) }}" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="riden-label">Vehicle Color</label>
                    <div class="riden-input-group">
                        <i class="bi bi-palette"></i>
                        <input type="text" name="color" class="riden-input" value="{{ old('color', $driver->color) }}" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="riden-label">Vehicle Type</label>
                    <div class="riden-input-group">
                        <i class="bi bi-tag-fill"></i>
                        <select name="vehicle_type" class="riden-input" required>
                            <option value="Sedan" {{ $driver->vehicle_type == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="SUV" {{ $driver->vehicle_type == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="Luxury" {{ $driver->vehicle_type == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                            <option value="Bike" {{ $driver->vehicle_type == 'Bike' ? 'selected' : '' }}>Bike</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="section-separator"></div>

            <!-- 3. DOCUMENT MANAGEMENT -->
            <div class="section-label-premium">
                <i class="bi bi-file-earmark-text"></i> Document Management
            </div>

            <!-- Existing Documents -->
            <div class="mb-4">
                <p class="text-muted small fw-bold mb-3">CURRENT DOCUMENTS</p>
                <div class="row g-3">
                    @forelse($driver->documents as $doc)
                        <div class="col-md-6">
                            <div class="existing-doc-card">
                                <div class="doc-info">
                                    <div class="doc-icon-box">
                                        <i class="bi bi-file-pdf"></i>
                                    </div>
                                    <div class="doc-details">
                                        <h6>{{ $doc->document_name }}</h6>
                                        <p>Uploaded: {{ $doc->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="doc-actions">
                                    <a href="{{ asset('storage/' . $doc->document_path) }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4 bg-light rounded-3">
                            <i class="bi bi-info-circle text-muted mb-2 fs-3"></i>
                            <p class="text-muted mb-0 small">No documents uploaded yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Add New Documents -->
            <div class="mt-4">
                <p class="text-muted small fw-bold mb-3">UPLOAD NEW DOCUMENTS</p>
                <div id="documents-container" class="row g-3">
                    <!-- Dynamic slots append here -->
                </div>
                <button type="button" id="add-doc-btn" class="btn btn-light w-100 py-3 border rounded-3 mt-2 text-muted fw-bold">
                    <i class="bi bi-plus-lg me-1"></i> Add Document Upload Slot
                </button>
            </div>

            <!-- Submit Button -->
            <div class="mt-5 pt-3">
                <button type="submit" class="btn-riden-primary w-100 py-3 rounded-pill fw-bold shadow-sm">
                    <i class="bi bi-cloud-upload me-2"></i> Update Driver Profile
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
        $(function() {
            // Parsley Configuration
            const parsleyOptions = {
                errorClass: 'is-invalid',
                successClass: 'is-valid',
                errorsWrapper: '<ul class="parsley-errors-list"></ul>',
                itemClass: 'parsley-error',
                trigger: 'change keyup focusout'
            };

            $('#editDriverForm').parsley(parsleyOptions);

            // Add Document Logic
            $('#add-doc-btn').on('click', function() {
                const newDocItem = `
                    <div class="col-md-6 doc-item-wrapper">
                        <div class="doc-item-premium position-relative p-3 border rounded-3 bg-white">
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-doc"></button>
                            <label class="riden-label">Document Name</label>
                            <div class="riden-input-group mb-3">
                                <i class="bi bi-pencil-square"></i>
                                <input type="text" name="doc_name[]" class="riden-input" placeholder="e.g. License Back" required>
                            </div>
                            <label class="riden-label">File Upload</label>
                            <input type="file" name="doc_file[]" class="form-control rounded-3" required>
                        </div>
                    </div>
                `;
                $('#documents-container').append(newDocItem);
            });

            $(document).on('click', '.remove-doc', function() {
                $(this).closest('.doc-item-wrapper').remove();
            });

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#D10000',
                    timer: 3000
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
            }
        }
    </script>
@endpush
