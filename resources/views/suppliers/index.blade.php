@extends('partials.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-1 fw-bold">Suppliers</h2>
            <p class="text-muted small mb-0">Manage suppliers who supply products to your inventory.</p>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn btn-premium">
            <i class="fas fa-plus me-2"></i> Add Supplier
        </a>
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
                                <div class="fw-bold text-dark">{{ $supplier->name }}</div>
                            </td>
                            <td>
                                <span class="text-muted">{{ $supplier->contact_person ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $supplier->phone ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $supplier->email ?? '-' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary-soft text-primary rounded-pill px-3 py-2">
                                    {{ $supplier->products_count }} {{ Str::plural('product', $supplier->products_count) }}
                                </span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('suppliers.edit', $supplier) }}"
                                        class="btn btn-sm btn-outline-primary rounded-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this supplier?')">
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
                                    <i class="fas fa-truck fs-1 d-block mb-3 opacity-25"></i>
                                    No suppliers found. Start by adding one!
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
