@extends('admin.layout.master')

@section('title', 'Edit Passenger')

@push('styles')
    <link href="{{ asset('assets/css/addadmin.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
    <style>
        /* Senior UI Refinement: Parsley Custom Styling */
        input.parsley-error, 
        select.parsley-error {
            background-color: #FFF5F5 !important;
            border-color: var(--riden-red) !important;
            box-shadow: 0 0 0 5px rgba(225, 29, 72, 0.05) !important;
        }
        .parsley-errors-list {
            list-style: none;
            padding: 0;
            margin: 5px 0 0 0;
            color: var(--riden-red);
            font-size: 11px;
            font-weight: 700;
            display: none;
        }
        .parsley-errors-list.filled {
            display: block;
        }
        .riden-phone {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .riden-flag {
            display: flex;
            align-items: center;
            gap: 5px;
            background: #f8f9fa;
            border: 1.5px solid #E5E7EB;
            padding: 8px 12px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
        }
        .image-preview-box {
            width: 80px;
            height: 80px;
            border-radius: 15px;
            background: #f8f9fa;
            border: 2px dashed #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: all 0.3s;
        }
    </style>
@endpush

@section('content')
<div class="col-12 riden-addadmin-wrap">

    <!-- Subheader with Back Button -->
    <div class="riden-addadmin-head mb-4">
        <a href="{{ route('admin.passenger.detail', $passenger->id) }}" class="riden-addadmin-back text-decoration-none">
            <i class="bi bi-chevron-left"></i>
        </a>
        <h2 class="riden-addadmin-title mb-0">Edit Passenger</h2>
    </div>

    <!-- Main Card -->
    <div class="card riden-addadmin-card border-0 shadow-sm p-4" style="border-radius: 30px;">
        <form id="passengerEditForm" action="{{ route('admin.passenger.update', $passenger->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
            @csrf
            @method('PUT')
            
            <div class="riden-addadmin-section mb-4 d-flex justify-content-between align-items-center text-uppercase fw-bold" style="color:var(--riden-red); letter-spacing: 1px;">
                <span>Passenger Details</span>
                <span class="text-muted small fw-normal" style="font-size: 14px; text-transform: none;">Update passenger information for <strong style="color:var(--text-main);">{{ $passenger->first_name }}</strong></span>
            </div>

            <div class="row g-4">
                <!-- Profile Image Selection -->
                <div class="col-12 mb-2">
                    <label class="riden-field-label fw-bold mb-2">PROFILE IMAGE</label>
                    <div class="d-flex align-items-center gap-4">
                        <div class="figma-input-wrapper flex-grow-1" style="border: 2px dashed #ddd; border-radius: 15px; padding: 15px; background: #fafafa;">
                            <input type="file" name="avatar" id="passengerAvatarInput" class="form-control border-0 bg-transparent" accept="image/*">
                        </div>
                        <div class="image-preview-box" id="avatarPreviewBox">
                            @if($passenger->avatar)
                                <img src="{{ asset('storage/'.$passenger->avatar) }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <i class="bi bi-person-fill text-muted fs-2"></i>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label fw-bold mb-2">FIRST NAME</label>
                        <input type="text" name="first_name" class="form-control riden-input" placeholder="e.g. John" value="{{ old('first_name', $passenger->first_name) }}" required data-parsley-trigger="change" style="border-radius: 12px; padding: 12px 18px;">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label fw-bold mb-2">LAST NAME</label>
                        <input type="text" name="last_name" class="form-control riden-input" placeholder="e.g. Doe" value="{{ old('last_name', $passenger->last_name) }}" required data-parsley-trigger="change" style="border-radius: 12px; padding: 12px 18px;">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label fw-bold mb-2">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control riden-input" placeholder="john.doe@example.com" value="{{ old('email', $passenger->email) }}" required data-parsley-type="email" data-parsley-trigger="change" style="border-radius: 12px; padding: 12px 18px;">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label fw-bold mb-2">PHONE NUMBER</label>
                        <div class="riden-phone">
                            <div class="riden-flag">
                                <img src="https://flagcdn.com/w40/ca.png" alt="CA" style="width: 20px;">
                                <span>+1</span>
                            </div>
                            <input type="text" name="phone" class="form-control riden-input flex-grow-1" placeholder="000 000 0000" value="{{ old('phone', $passenger->phone) }}" required data-parsley-trigger="change" style="border-radius: 12px; padding: 12px 18px;">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label fw-bold mb-2">GENDER</label>
                        <select name="gender" class="form-select riden-input" required data-parsley-errors-container="#gender-error" style="border-radius: 12px; padding: 12px 18px;">
                            <option value="" disabled>Select gender</option>
                            <option value="Male" {{ old('gender', $passenger->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $passenger->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $passenger->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <div id="gender-error"></div>
                    </div>
                </div>
            </div>

            <div class="riden-addadmin-section my-5 text-uppercase fw-bold" style="color:var(--riden-red); letter-spacing: 1px;">UPDATE PASSWORD (LEAVE BLANK TO KEEP CURRENT)</div>
            
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label fw-bold mb-2">NEW PASSWORD</label>
                        <div class="position-relative">
                            <input type="password" id="password" name="password" class="form-control riden-input pe-5" placeholder="••••••••" data-parsley-minlength="8" data-parsley-trigger="change" style="border-radius: 12px; padding: 12px 18px;">
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 opacity-50 cursor-pointer" onclick="togglePass('password')"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="riden-field-label fw-bold mb-2">CONFIRM NEW PASSWORD</label>
                        <div class="position-relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control riden-input pe-5" placeholder="••••••••" data-parsley-equalto="#password" data-parsley-trigger="change" style="border-radius: 12px; padding: 12px 18px;">
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 opacity-50 cursor-pointer" onclick="togglePass('password_confirmation')"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="riden-actions d-flex justify-content-end gap-3 pt-4 border-top mt-4">
                <button type="submit" class="btn btn-riden-danger px-5 py-3 fw-bold" style="border-radius: 15px; background: var(--riden-red); border: none; color: #fff;">Update Passenger</button>
                <a href="{{ route('admin.passenger.detail', $passenger->id) }}" class="btn btn-riden-outline px-5 py-3 fw-bold d-flex align-items-center justify-content-center" style="text-decoration: none; border: 2px solid #ddd; border-radius: 15px; color: #333;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
<script>
    $(document).ready(function() {
        // 1. Initialize Parsley Validation
        const $form = $('#passengerEditForm');
        if ($form.length) {
            $form.parsley({
                errorClass: 'parsley-error',
                successClass: 'parsley-success',
                errorsWrapper: '<ul class="parsley-errors-list"></ul>',
                errorTemplate: '<li></li>'
            });
        }

        // 2. Real-time Image Preview Logic
        const avatarInput = document.getElementById('passengerAvatarInput');
        const previewBox = document.getElementById('avatarPreviewBox');

        if (avatarInput && previewBox) {
            avatarInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewBox.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">`;
                        previewBox.style.border = '2px solid var(--riden-red)';
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });

    function togglePass(id) {
        const input = document.getElementById(id);
        const icon = input.nextElementSibling;
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace("bi-eye-slash", "bi-eye");
        } else {
            input.type = "password";
            icon.classList.replace("bi-eye", "bi-eye-slash");
        }
    }
</script>
@endpush
