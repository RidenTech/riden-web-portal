@extends('admin.layout.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/promodetail.css">
@endpush

@section('content')
    <div class="col-12">
        <div class="promo-wrap">
            <div class="promo-top">
                <h2 class="promo-title">Promo Code Management</h2>
                <div class="promo-actions">
                    <a href="#" class="btn btn-sm btn-riden-danger">
                        <i class="bi bi-plus-lg me-1"></i>
                        Add new Code
                    </a>
                    <div class="promo-date">
                        <span class="cal"><i class="bi bi-calendar-week"></i></span>
                        <span>23/04/2025 — 23/04/2025</span>
                    </div>
                </div>
            </div>

            <div class="promo-card">
                <div class="p-3 p-md-4">
                    <div class="table-responsive">
                        <table class="promo-table">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Discount %</th>
                                    <th>Starting Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $rows = collect(range(1,10))->map(function($i){
                                        return [
                                            'code' => '435637283',
                                            'discount' => '20%',
                                            'start' => 'March 24, 2024',
                                            'end' => 'July 24, 2024',
                                            'status' => $i % 3 === 0 ? 'inactive' : 'active'
                                        ];
                                    });
                                @endphp
                                @foreach ($rows as $r)
                                    <tr>
                                        <td>{{ $r['code'] }}</td>
                                        <td>{{ $r['discount'] }}</td>
                                        <td>{{ $r['start'] }}</td>
                                        <td>{{ $r['end'] }}</td>
                                        <td>
                                            <span class="promo-status {{ $r['status'] === 'active' ? 'promo-status--active' : 'promo-status--inactive' }}">
                                                {{ ucfirst($r['status']) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="promo-actions-col">
                                                <a class="promo-icon promo-icon--edit" href="#" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                                                <a class="promo-icon promo-icon--delete" href="#" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="promo-footer">
                    @include('admin.partials.pagination', ['current' => 2, 'last' => 5])
                </div>
            </div>
        </div>
    </div>
@endsection
