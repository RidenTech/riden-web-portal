@extends('admin.layout.master')

@section('title', 'Admin Roles')
admi
@push('styles')
    <link href="{{ asset('assets/css/roles.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 roles-wrapper mt-3">
    <!-- Header Row (Title and Add Button) -->
    <div class="roles-header mb-4">
        <h1 class="roles-title">Admin Roles</h1>
        <a href="{{ route('admin.roles.create') }}" class="btn-add-admin">
            <i class="bi bi-plus-lg"></i> Add new Admin
        </a>
    </div>

    <!-- Table Container Card -->
    <div class="roles-content-card">
        <!-- Table Container -->
        <div class="roles-table-container">
            <table class="roles-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $admins = [
                            ['name' => 'Wade Warren', 'email' => 'example@gmail.com', 'phone' => '+123456372893'],
                            ['name' => 'Jacob Jones', 'email' => 'example@gmail.com', 'phone' => '+123456372893'],
                            ['name' => 'Bessie Cooper', 'email' => 'example@gmail.com', 'phone' => '+123456372893'],
                            ['name' => 'Theresa Webb', 'email' => 'example@gmail.com', 'phone' => '+123456372893'],
                            ['name' => 'Jerome Bell', 'email' => 'example@gmail.com', 'phone' => '+123456372893'],
                            ['name' => 'Robert Fox', 'email' => 'example@gmail.com', 'phone' => '+123456372893'],
                            ['name' => 'Kathryn Murphy', 'email' => 'example@gmail.com', 'phone' => '+123456372893'],
                            ['name' => 'Savannah Nguyen', 'email' => 'example@gmail.com', 'phone' => '+123456372893'],
                            ['name' => 'Floyd Miles', 'email' => 'example@gmail.com', 'phone' => '+123456372893'],
                            ['name' => 'Devon Lane', 'email' => 'example@gmail.com', 'phone' => '+123456372893'],
                        ];
                    @endphp

                    @foreach($admins as $admin)
                    <tr>
                        <td class="admin-name-cell">{{ $admin['name'] }}</td>
                        <td>{{ $admin['email'] }}</td>
                        <td>{{ $admin['phone'] }}</td>
                        <td>
                            <div class="role-actions">
                                <a href="#" class="btn-role-edit" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="#" class="btn-role-delete" title="Delete">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-roles">
            <a href="#" class="page-btn-roles arrow"><i class="bi bi-chevron-left"></i></a>
            <a href="#" class="page-btn-roles active">1</a>
            <a href="#" class="page-btn-roles">2</a>
            <a href="#" class="page-btn-roles">3</a>
            <span class="px-2 text-muted">...</span>
            <a href="#" class="page-btn-roles">5</a>
            <a href="#" class="page-btn-roles arrow"><i class="bi bi-chevron-right"></i></a>
        </div>
    </div>
</div>
@endsection
