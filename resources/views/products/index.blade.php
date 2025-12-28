@extends('partials.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-1 fw-bold">Products</h2>
            <p class="text-muted small mb-0">Manage your inventory items.</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-premium">
            <i class="fas fa-plus me-2"></i> Add Product
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
                                    <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center text-muted"
                                        style="width: 40px; height: 40px;">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $product->name }}</div>
                                        <div class="small text-muted">{{ Str::limit($product->description, 30) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span
                                    class="badge bg-light text-dark border">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            </td>
                            <td>
                                @if ($product->supplier)
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-truck text-primary me-2"></i>
                                        <span class="text-muted">{{ $product->supplier->name }}</span>
                                    </div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                @if ($product->stock > 0)
                                    <span class="badge bg-success bg-opacity-10 text-success">{{ $product->stock }} in
                                        stock</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger">Out of stock</span>
                                @endif
                            </td>
                            <td>
                                <span class="small text-muted">{{ $product->updated_at->format('M d, Y') }}</span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="btn btn-sm btn-outline-primary rounded-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this product?')">
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
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-box-open fs-1 d-block mb-3 opacity-25"></i>
                                    No products found. Start by adding one!
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
