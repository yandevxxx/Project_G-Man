@extends('partials.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">
        <div>
            <h2 class="h3 mb-1 fw-800 tracking-tight text-slate-900">Inventory Products</h2>
            <p class="text-muted fw-500 mb-0">Monitor and manage your warehouse stock levels.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <form action="{{ route('products.index') }}" method="GET" class="position-relative">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted opacity-50 small"></i>
                <input type="text" name="q" class="form-control glass-input shadow-none"
                    style="width: 280px; font-size: 0.85rem;" placeholder="Search by name or description..." 
                    value="{{ request('q') }}">
                @if(request('q'))
                    <a href="{{ route('products.index') }}" class="position-absolute top-50 end-0 translate-middle-y me-2 text-muted hover-opacity-100">
                        <i class="fas fa-times-circle fs-7"></i>
                    </a>
                @endif
            </form>
            <a href="{{ route('products.create') }}" class="btn btn-premium shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Add Product
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
                        <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Product</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Category</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Supplier</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Price</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Stock</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Last Updated</th>
                        <th class="pe-4 py-3 text-center text-uppercase small fw-bold text-muted">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="position-relative me-3">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                            class="rounded-3 shadow-sm border" style="width: 45px; height: 45px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $product->name }}</div>
                                        <div class="small text-muted">{{ Str::limit($product->description, 30) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="soft-badge bg-primary-soft">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            </td>
                            <td>
                                @if ($product->supplier)
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info-soft rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 24px; height: 24px;">
                                            <i class="fas fa-truck fs-xs"></i>
                                        </div>
                                        <span class="text-slate-600 fw-500">{{ $product->supplier->name }}</span>
                                    </div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-slate-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                @if ($product->stock > 10)
                                    <span class="soft-badge bg-success-soft"><i class="fas fa-check-circle me-1"></i> {{ $product->stock }} Stock</span>
                                @elseif($product->stock > 0)
                                    <span class="soft-badge bg-warning-soft"><i class="fas fa-exclamation-triangle me-1"></i> {{ $product->stock }} Stock</span>
                                @else
                                    <span class="soft-badge bg-danger-soft"><i class="fas fa-times-circle me-1"></i> Out of Stock</span>
                                @endif
                            </td>
                            <td>
                                <span class="small text-muted fw-500">{{ $product->updated_at->format('d M Y') }}</span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="btn btn-sm btn-outline-primary rounded-3 border-0 bg-primary-soft hover-translate-y">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this product?')">
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
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">No products found</h5>
                                <p class="text-muted small mb-0">Start by adding your first inventory item.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
