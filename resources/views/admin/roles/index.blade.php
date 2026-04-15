@extends('admin.layout.master')

@section('title', 'Admin Roles')

@push('styles')
    <link href="{{ asset('assets/css/roles.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 roles-wrapper">
    <!-- Header Row -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold m-0" style="font-size: 2rem;">Admin Roles</h2>

        <a href="{{ route('admin.roles.create') }}" class="btn-add-admin">
            <i class="bi bi-plus-lg"></i> Add new Admin
        </a>
    </div>
     <!-- Table Container Card -->
    <div class="roles-content-card">
        <!-- Table Container -->
        <div class="roles-table-container">
            <table class="table roles-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                    <tr>
                        <td class="admin-name-cell">
                            {{ $admin->name }}
                            @if($admin->is_super)
                                <span class="badge bg-danger ms-2" style="font-size: 10px; border-radius: 20px; font-weight: 700;">SUPER ADMIN</span>
                            @endif
                        </td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone }}</td>
                        <td>
                             <div class="role-actions">
                                <a href="{{ route('admin.roles.edit', $admin->id) }}" class="btn-role-edit" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.roles.destroy', $admin->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="deleted_at" class="h_deleted_at">
                                    <button type="button" class="btn-role-delete border-0 bg-transparent text-black" title="Delete" onclick="submitDelete(this)">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">No admins found.</td>
                    </tr>
                    @endforelse
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

<script>
// Senior Developer Tool: Ensure the deletion timestamp is captured from the frontend
function getLaravelTimestamp() {
    const now = new Date();
    return now.getFullYear() + '-' +
        String(now.getMonth() + 1).padStart(2, '0') + '-' +
        String(now.getDate()).padStart(2, '0') + ' ' +
        String(now.getHours()).padStart(2, '0') + ':' +
        String(now.getMinutes()).padStart(2, '0') + ':' +
        String(now.getSeconds()).padStart(2, '0');
}

function submitDelete(btn) {
    window.confirmDelete('Delete Admin?', 'This administrator will no longer have access to the portal.').then((result) => {
        if (result.isConfirmed) {
            const form = btn.closest('form');
            form.querySelector('.h_deleted_at').value = getLaravelTimestamp();
            form.submit();
        }
    });
}
</script>
@endsection
