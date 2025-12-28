@extends('partials.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-1 fw-bold">User Management</h2>
        <p class="text-muted small mb-0">Manage user accounts and permissions.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">User</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Email</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Role</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Gender</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Job</th>
                    <th class="pe-4 py-3 text-center text-uppercase small fw-bold text-muted">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                <div class="small text-muted">ID: #{{ $user->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-muted">{{ $user->email }}</span>
                    </td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                <i class="fas fa-shield-alt me-1"></i> Admin
                            </span>
                        @else
                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                <i class="fas fa-user me-1"></i> User
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="small text-muted">{{ $user->jenis_kelamin }}</span>
                    </td>
                    <td>
                        <span class="small text-muted">{{ $user->pekerjaan ?? '-' }}</span>
                    </td>
                    <td class="pe-4 text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-users fs-1 d-block mb-3 opacity-25"></i>
                            No users found.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($users->hasPages())
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
