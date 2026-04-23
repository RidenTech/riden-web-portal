@extends('admin.layout.master')

@section('title')
    Add New Vehicle
@endsection

@push('styles')
    <style>
        .riden-form-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
        }
        .form-control:focus {
            border-color: #FF2E2E;
            box-shadow: 0 0 0 0.2rem rgba(255, 46, 46, 0.1);
        }
        .section-header {
            border-left: 4px solid #FF2E2E;
            padding-left: 15px;
            margin-bottom: 25px;
            color: #333;
            font-weight: 700;
        }
    </style>
@endpush

@section('content')
<div class="riden-content-wrapper">
    <div class="riden-section">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.vehicle.management') }}" class="text-danger text-decoration-none">Vehicles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New</li>
                </ol>
            </nav>
            <h2 class="riden-section-title mb-0">Add New Vehicle</h2>
        </div>

        <form action="{{ route('admin.vehicle.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="riden-form-card">
                <div class="row">
                    <!-- Column 1: Assignment & Basic Info -->
                    <div class="col-md-4 border-end pe-4">
                        <h5 class="section-header">Vehicle Identification</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Assign Driver</label>
                            <select name="driver_id" class="form-select @error('driver_id') is-invalid @enderror">
                                <option value="">Select a Driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->name }} ({{ $driver->id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('driver_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Car Model Name</label>
                            <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" placeholder="e.g. Toyota Corolla" value="{{ old('model') }}">
                            @error('model') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Plate No</label>
                            <input type="text" name="license_plate" class="form-control @error('license_plate') is-invalid @enderror" placeholder="e.g. ABC-123" value="{{ old('license_plate') }}">
                            @error('license_plate') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Column 2: Specs & Details -->
                    <div class="col-md-4 border-end px-4">
                        <h5 class="section-header">Vehicle Specifications</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Year</label>
                                <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" placeholder="2023" value="{{ old('year') }}">
                                @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Color</label>
                                <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" placeholder="White" value="{{ old('color') }}">
                                @error('color') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="vehicle_type" class="form-select @error('vehicle_type') is-invalid @enderror">
                                <option value="sedan" {{ old('vehicle_type') == 'sedan' ? 'selected' : '' }}>Sedan</option>
                                <option value="suv" {{ old('vehicle_type') == 'suv' ? 'selected' : '' }}>SUV</option>
                                <option value="luxury" {{ old('vehicle_type') == 'luxury' ? 'selected' : '' }}>Luxury</option>
                                <option value="bike" {{ old('vehicle_type') == 'bike' ? 'selected' : '' }}>Bike</option>
                            </select>
                            @error('vehicle_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Number of Seats</label>
                            <input type="number" name="no_of_seats" class="form-control @error('no_of_seats') is-invalid @enderror" placeholder="4" value="{{ old('no_of_seats') }}">
                            @error('no_of_seats') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Column 3: Images -->
                    <div class="col-md-4 ps-4">
                        <h5 class="section-header">Vehicle Media</h5>
                        
                        <div class="mb-4">
                            <label class="form-label d-block text-muted small uppercase">Front View Image</label>
                            <div class="image-upload-wrapper text-center">
                                <div class="preview-container mb-2" style="height: 120px; border: 2px dashed #e0e0e0; border-radius: 10px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #fafafa;">
                                    <img id="front-preview" src="#" alt="Front Preview" style="max-width: 100%; max-height: 100%; display: none;">
                                    <i class="bi bi-camera text-muted fs-2" id="front-icon"></i>
                                </div>
                                <input type="file" name="front_image" id="front_image" class="form-control form-control-sm @error('front_image') is-invalid @enderror" onchange="previewImage(this, 'front-preview', 'front-icon')">
                                @error('front_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label d-block text-muted small uppercase">Back View Image</label>
                            <div class="image-upload-wrapper text-center">
                                <div class="preview-container mb-2" style="height: 120px; border: 2px dashed #e0e0e0; border-radius: 10px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #fafafa;">
                                    <img id="back-preview" src="#" alt="Back Preview" style="max-width: 100%; max-height: 100%; display: none;">
                                    <i class="bi bi-camera text-muted fs-2" id="back-icon"></i>
                                </div>
                                <input type="file" name="back_image" id="back_image" class="form-control form-control-sm @error('back_image') is-invalid @enderror" onchange="previewImage(this, 'back-preview', 'back-icon')">
                                @error('back_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                
                <div class="d-flex justify-content-end gap-3 text-center">
                    <a href="{{ route('admin.vehicle.management') }}" class="btn btn-light px-5 py-2 border">Cancel</a>
                    <button type="submit" class="riden-btn-primary px-5 py-2">Save Vehicle</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input, previewId, iconId) {
        const preview = document.getElementById(previewId);
        const icon = document.getElementById(iconId);
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                icon.style.display = 'none';
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
