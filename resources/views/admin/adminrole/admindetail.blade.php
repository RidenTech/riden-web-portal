@extends('admin.layout.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/adminprofile.css">
@endpush

@section('content')
    <div class="col-12">
        <div class="riden-adminroles-top">
            <h2 class="riden-adminroles-title">Admin Roles</h2>

            <a href="#" class="btn btn-sm btn-riden-danger px-3">
                <i class="bi bi-plus-lg me-1"></i>
                Add new Admin
            </a>
        </div>

        <div class="riden-adminroles-card">
            <div class="p-3 p-md-4">
                <div class="table-responsive">
                    <table class="riden-adminroles-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th style="width:140px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rows = [
                                    ['Wade Warren', 'example@gmail.com', '+123456372893'],
                                    ['Jacob Jones', 'example@gmail.com', '+123456372893'],
                                    ['Bessie Cooper', 'example@gmail.com', '+123456372893'],
                                    ['Theresa Webb', 'example@gmail.com', '+123456372893'],
                                    ['Jerome Bell', 'example@gmail.com', '+123456372893'],
                                    ['Robert Fox', 'example@gmail.com', '+123456372893'],
                                    ['Kathryn Murphy', 'example@gmail.com', '+123456372893'],
                                    ['Savannah Nguyen', 'example@gmail.com', '+123456372893'],
                                    ['Floyd Miles', 'example@gmail.com', '+123456372893'],
                                    ['Devon Lane', 'example@gmail.com', '+123456372893'],
                                ];
                            @endphp

                            @foreach ($rows as $r)
                                <tr>
                                    <td>{{ $r[0] }}</td>
                                    <td>{{ $r[1] }}</td>
                                    <td>{{ $r[2] }}</td>
                                    <td>
                                        <div class="riden-adminroles-actions">
                                            <a href="#" class="riden-icon-action riden-icon-action--edit" aria-label="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a href="#" class="riden-icon-action riden-icon-action--delete" aria-label="Delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="riden-adminroles-footer">
                @include('admin.partials.pagination', ['current' => 2, 'last' => 5])
            </div>
        </div>
    </div>
@endsection
