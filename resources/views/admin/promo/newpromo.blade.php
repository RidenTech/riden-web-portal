@extends('admin.layout.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/newpromo.css">
@endpush

@section('content')
    <div class="col-12">
        <div class="riden-newpromo-wrap">
            <div class="riden-newpromo-head">
                <h2 class="riden-newpromo-title">
                    <i class="bi bi-chevron-left me-1"></i>
                    Add New promo Code
                </h2>
            </div>

            <div class="riden-newpromo-card">
                <div class="riden-newpromo-section">Code Details</div>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="riden-field-label">Code</div>
                        <input class="form-control riden-input" placeholder="Enter Code">
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="riden-field-label">Discount Percentage</div>
                        <input class="form-control riden-input" placeholder="Enter Discount Percentage">
                    </div>
                </div>

                <div class="mt-4 riden-newpromo-section">Date Management</div>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="riden-field-label">Starting Date</div>
                        <div class="riden-date">
                            <input class="form-control riden-input" placeholder="00/00/00">
                            <i class="bi bi-calendar-week riden-cal"></i>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="riden-field-label">End Date</div>
                        <div class="riden-date">
                            <input class="form-control riden-input" placeholder="00/00/00">
                            <i class="bi bi-calendar-week riden-cal"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="riden-newpromo-actions">
                    <button class="btn btn-sm btn-riden-danger px-4" type="button">Save</button>
                    <button class="btn-riden-outline" type="button">Cancel</button>
                </div>
        </div>
    </div>
@endsection
