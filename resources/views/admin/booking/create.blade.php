@extends('admin.layout.master')

@section('title')
    Add Booking
@endsection

@push('styles')
    <link href="{{ asset('assets/css/booking.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .create-booking-card {
            background: #fff;
            border-radius: 30px;
            border: 1px solid #E5E7EB;
            padding: 40px;
            box-shadow: var(--riden-shadow);
            max-width: 900px;
            margin: 0 auto;
        }
        .form-section-title {
            font-size: 18px;
            font-weight: 800;
            color: #000;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f8f8f8;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .riden-input-group {
            margin-bottom: 25px;
        }
        .riden-label {
            font-weight: 700;
            font-size: 14px;
            color: #444;
            margin-bottom: 10px;
            display: block;
        }
        .riden-form-control {
            border: 1.5px solid #E5E7EB;
            border-radius: 12px;
            padding: 12px 15px;
            width: 100%;
            font-size: 14px;
            transition: all 0.2s;
        }
        .riden-form-control:focus {
            border-color: #FF2E2E;
            outline: none;
            box-shadow: 0 0 0 4px rgba(255, 46, 46, 0.1);
        }
        .btn-submit-booking {
            background: #FF2E2E;
            color: #fff;
            border: none;
            padding: 15px 40px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
        }
    </style>
@endpush

@section('content')
<div class="col-12">
    <div class="booking-management-container">
        
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.booking.management') }}" class="back-link">
                <i class="bi bi-chevron-left text-dark"></i>
            </a>
            <h2 class="booking-title">Add New Booking</h2>
        </div>

        <div class="create-booking-card">
            <form action="{{ route('admin.booking.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="form-section-title"><i class="bi bi-person-circle text-danger"></i> User Details</h4>
                        <div class="riden-input-group">
                            <label class="riden-label">Select Passenger</label>
                            <select name="passenger_id" class="riden-form-control" required>
                                <option value="">Choose a passenger...</option>
                                @foreach($passengers as $passenger)
                                    <option value="{{ $passenger->id }}">{{ $passenger->first_name }} {{ $passenger->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="riden-input-group">
                            <label class="riden-label">Select Driver</label>
                            <select name="driver_id" class="riden-form-control" required>
                                <option value="">Choose a driver...</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->first_name }} {{ $driver->last_name }} ({{ $driver->vehicle->license_plate ?? 'No Vehicle' }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h4 class="form-section-title"><i class="bi bi-geo-alt-fill text-danger"></i> Trip Details</h4>
                        <div class="riden-input-group">
                            <label class="riden-label">Pickup Location</label>
                            <input type="text" name="pickup_location" class="riden-form-control" placeholder="Enter pickup address" required>
                        </div>
                        <div class="riden-input-group">
                            <label class="riden-label">Dropoff Location</label>
                            <input type="text" name="dropoff_location" class="riden-form-control" placeholder="Enter dropoff address" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <h4 class="form-section-title"><i class="bi bi-currency-dollar text-danger"></i> Payment & Stats</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="riden-input-group">
                                    <label class="riden-label">Estimated Fare ($)</label>
                                    <input type="number" step="0.01" name="fare" class="riden-form-control" placeholder="0.00" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="riden-input-group">
                                    <label class="riden-label">Distance (km)</label>
                                    <input type="text" name="distance" class="riden-form-control" placeholder="e.g. 5.2 km">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="riden-input-group">
                                    <label class="riden-label">Duration (min)</label>
                                    <input type="text" name="duration" class="riden-form-control" placeholder="e.g. 15 min">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit-booking">Create Booking Now</button>
            </form>
        </div>
    </div>
</div>
@endsection
