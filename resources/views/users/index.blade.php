@extends('partials.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">
        <div>
            <h2 class="h3 mb-1 fw-800 tracking-tight text-slate-900">User Management</h2>
            <p class="text-muted fw-500 mb-0">Manage user accounts and system permissions.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <form action="{{ route('users.index') }}" method="GET" class="position-relative">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted opacity-50 small"></i>
                <input type="text" name="q" class="form-control glass-input shadow-none"
                    style="width: 250px; font-size: 0.85rem;" placeholder="Search users..." 
                    value="{{ request('q') }}">
                @if(request('q'))
                    <a href="{{ route('users.index') }}" class="position-absolute top-50 end-0 translate-middle-y me-2 text-muted hover-opacity-100">
                        <i class="fas fa-times-circle fs-7"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

    @if (session('success'))
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
                                    <div class="bg-primary-soft rounded-circle me-3 d-flex align-items-center justify-content-center text-primary-soft fw-bold"
                                        style="width: 40px; height: 40px; background: rgba(99, 102, 241, 0.1); color: #6366f1;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $user->name }}</div>
                                        <div class="small text-muted">ID: #{{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-slate-600 fw-500">{{ $user->email }}</span>
                            </td>
                            <td>
                                @if ($user->role === 'admin')
                                    <span class="soft-badge bg-danger-soft">
                                        <i class="fas fa-shield-alt me-1"></i> Admin
                                    </span>
                                @else
                                    <span class="soft-badge bg-primary-soft">
                                        <i class="fas fa-user me-1"></i> User
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="small text-muted fw-500">{{ $user->jenis_kelamin }}</span>
                            </td>
                            <td>
                                <span class="small text-muted fw-500">{{ $user->pekerjaan ?? '-' }}</span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-sm btn-outline-primary rounded-3 border-0 bg-primary-soft hover-translate-y">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 border-0 bg-danger-soft hover-translate-y">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">No users found</h5>
                                <p class="text-muted small mb-0">There are no users matching your criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection
