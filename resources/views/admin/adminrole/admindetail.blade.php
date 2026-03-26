@extends('admin.layout.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/adminprofile.css">
@endpush

@section('content')
    <div class="col-12">
        <div class="riden-adminroles-top">
            <h2 class="riden-adminroles-title">Admin Roles</h2>

            <a href="{{ route('addadmin') }}" class="btn btn-sm btn-riden-danger px-3">
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
                            <tr>
                                <td>
                                    <a href="{{ route('adminprofile') }}" class="riden-link">Wade Warren</a>
                                </td>
                                <td>example@gmail.com</td>
                                <td>+123456372893</td>
                                <td>
                                    <div class="riden-adminroles-actions">
                                        <a href="#" class="riden-icon-action riden-icon-action--edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="#" class="riden-icon-action riden-icon-action--delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="{{ route('adminprofile') }}" class="riden-link">Jacob Jones</a>
                                </td>
                                <td>example@gmail.com</td>
                                <td>+123456372893</td>
                                <td>
                                    <div class="riden-adminroles-actions">
                                        <a href="#" class="riden-icon-action riden-icon-action--edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="#" class="riden-icon-action riden-icon-action--delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="{{ route('adminprofile') }}" class="riden-link">Bessie Cooper</a>
                                </td>
                                <td>example@gmail.com</td>
                                <td>+123456372893</td>
                                <td>
                                    <div class="riden-adminroles-actions">
                                        <a href="#" class="riden-icon-action riden-icon-action--edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="#" class="riden-icon-action riden-icon-action--delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="{{ route('adminprofile') }}" class="riden-link">Theresa Webb</a>
                                </td>
                                <td>example@gmail.com</td>
                                <td>+123456372893</td>
                                <td>
                                    <div class="riden-adminroles-actions">
                                        <a href="#" class="riden-icon-action riden-icon-action--edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="#" class="riden-icon-action riden-icon-action--delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
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
