@extends('partials.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 mb-1 fw-bold">Categories</h2>
        <p class="text-muted small mb-0">Manage product categories for your inventory.</p>
    </div>
    <a href="{{ route('categories.create') }}" class="btn btn-premium">
        <i class="fas fa-plus me-2"></i> Add Category
    </a>
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
                    <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Name</th>

                    <th class="py-3 text-uppercase small fw-bold text-muted">Created At</th>
                    <th class="pe-4 py-3 text-center text-uppercase small fw-bold text-muted">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td class="ps-4">
                        <div class="fw-bold text-dark">{{ $category->name }}</div>
                    </td>

                    <td>
                        <span class="small text-muted">{{ $category->created_at->format('M d, Y') }}</span>
                    </td>
                    <td class="pe-4 text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary rounded-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                    <td colspan="4" class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-folder-open fs-1 d-block mb-3 opacity-25"></i>
                            No categories found. Start by adding one!
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
