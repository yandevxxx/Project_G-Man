@extends('partials.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">
        <div>
            <h2 class="h3 mb-1 fw-800 tracking-tight text-slate-900">Partner Suppliers</h2>
            <p class="text-muted fw-500 mb-0">Manage and oversee your supplier relationships.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <form action="{{ route('suppliers.index') }}" method="GET" class="position-relative">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted opacity-50 small"></i>
                <input type="text" name="q" class="form-control glass-input shadow-none"
                    style="width: 250px; font-size: 0.85rem;" placeholder="Search suppliers..." 
                    value="{{ request('q') }}">
                @if(request('q'))
                    <a href="{{ route('suppliers.index') }}" class="position-absolute top-50 end-0 translate-middle-y me-2 text-muted hover-opacity-100">
                        <i class="fas fa-times-circle fs-7"></i>
                    </a>
                @endif
            </form>
            <a href="{{ route('suppliers.create') }}" class="btn btn-premium shadow-sm">
                <i class="fas fa-truck-moving me-2"></i> Add Supplier
            </a>
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
                        <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Supplier Name</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Contact Person</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Phone</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Email</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted text-center">Products</th>
                        <th class="pe-4 py-3 text-center text-uppercase small fw-bold text-muted">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info-soft rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                        <i class="fas fa-building small"></i>
                                    </div>
                                    <div class="fw-bold text-dark">{{ $supplier->name }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="text-slate-600 fw-500">{{ $supplier->contact_person ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="text-slate-600 fw-500"><i class="fas fa-phone-alt me-2 text-muted small"></i>{{ $supplier->phone ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="text-slate-600 fw-500"><i class="fas fa-envelope me-2 text-muted small"></i>{{ $supplier->email ?? '-' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="soft-badge bg-primary-soft">
                                    {{ $supplier->products_count }} {{ Str::plural('product', $supplier->products_count) }}
                                </span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('suppliers.edit', $supplier) }}"
                                        class="btn btn-sm btn-outline-primary rounded-3 border-0 bg-primary-soft hover-translate-y">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this supplier?')">
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
                                    <i class="fas fa-truck-loading"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">No suppliers found</h5>
                                <p class="text-muted small mb-0">Start by adding your first supplier partner.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
