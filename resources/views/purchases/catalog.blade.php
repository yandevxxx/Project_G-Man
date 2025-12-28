@extends('partials.app')

@section('content')
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-1 fw-bold tracking-tight">Shop</h2>
                <p class="text-muted small mb-0">Browse our exclusive collection.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-all hover-translate-y">
                        <!-- Product Image Placeholder -->
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-box-open text-muted opacity-25" style="font-size: 4rem;"></i>
                        </div>

                        <div class="card-body p-4 d-flex flex-column">
                            <div class="mb-2">
                                <span
                                    class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 small fw-bold">{{ $product->category->name ?? 'General' }}</span>
                            </div>

                            <h5 class="card-title fw-bold mb-1 text-dark">{{ $product->name }}</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">
                                {{ Str::limit($product->description, 60) }}</p>

                            <div class="d-flex justify-content-between align-items-end mt-3">
                                <div>
                                    <div class="small text-muted mb-1 text-uppercase fw-bold"
                                        style="font-size: 0.7rem; letter-spacing: 0.5px;">Price</div>
                                    <div class="h5 mb-0 fw-bold text-dark">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</div>
                                </div>

                                <div class="text-end">
                                    @if ($product->stock > 0)
                                        <a href="{{ route('purchases.checkout', $product->id) }}"
                                            class="btn btn-primary rounded-pill px-3 shadow-sm btn-sm">
                                            <i class="fas fa-bolt me-1"></i> Buy Now
                                        </a>
                                    @else
                                        <button disabled class="btn btn-light text-muted rounded-pill px-3 border btn-sm">
                                            Sold Out
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                            <div class="d-flex align-items-center small text-muted">
                                @if ($product->stock > 10)
                                    <span class="text-success"><i class="fas fa-check-circle me-1"></i> In Stock</span>
                                @elseif($product->stock > 0)
                                    <span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i> Low Stock:
                                        {{ $product->stock }}</span>
                                @else
                                    <span class="text-danger"><i class="fas fa-times-circle me-1"></i> Out of Stock</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-search fs-1 d-block mb-3 opacity-25 text-muted"></i>
                        <h3 class="h5 fw-bold text-muted">No products found</h3>
                        <p class="text-muted small">Check back later for new arrivals.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-5">
            {{ $products->links() }}
        </div>
    </div>

    <style>
        .hover-translate-y:hover {
            transform: translateY(-5px);
        }

        .transition-all {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
@endsection
