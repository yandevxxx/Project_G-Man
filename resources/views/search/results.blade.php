@extends('partials.app')

@section('content')
    <div class="mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="h3 mb-1 fw-bold">Search Results</h2>
                <p class="text-muted small mb-0">
                    Found <strong>{{ $totalResults }}</strong> result{{ $totalResults != 1 ? 's' : '' }} for
                    "<strong>{{ $query }}</strong>"
                    @if ($filter !== 'all')
                        in <span class="badge bg-primary">{{ ucfirst($filter) }}</span>
                    @endif
                </p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-light rounded-3">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
    </div>

    @if ($totalResults == 0)
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <i class="fas fa-search fs-1 text-muted opacity-25 mb-3"></i>
                <h5 class="fw-bold mb-2">No Results Found</h5>
                <p class="text-muted mb-4">We couldn't find anything matching "{{ $query }}"</p>
                <a href="{{ route('dashboard') }}" class="btn btn-premium">
                    <i class="fas fa-home me-2"></i> Go to Dashboard
                </a>
            </div>
        </div>
    @else
        <!-- Products Results -->
        @if ($results['products']->count() > 0)
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-box text-primary me-2"></i> Products ({{ $results['products']->count() }})
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Product</th>
                                    <th class="py-3 text-uppercase small fw-bold text-muted">Category</th>
                                    <th class="py-3 text-uppercase small fw-bold text-muted">Price</th>
                                    <th class="py-3 text-uppercase small fw-bold text-muted">Stock</th>
                                    <th class="pe-4 py-3 text-center text-uppercase small fw-bold text-muted">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results['products'] as $product)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $product->name }}</div>
                                            <div class="small text-muted">{{ Str::limit($product->description, 50) }}</div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-light text-dark border">{{ $product->category->name ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            @if ($product->stock > 0)
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success">{{ $product->stock }}
                                                    in stock</span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger">Out of stock</span>
                                            @endif
                                        </td>
                                        <td class="pe-4 text-center">
                                            @if (auth()->user()->role === 'admin')
                                                <a href="{{ route('products.edit', $product) }}"
                                                    class="btn btn-sm btn-outline-primary rounded-3">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('purchases.checkout', $product) }}"
                                                    class="btn btn-sm btn-outline-success rounded-3">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!-- Categories Results -->
        @if ($results['categories']->count() > 0)
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-tags text-success me-2"></i> Categories ({{ $results['categories']->count() }})
                    </h5>
                </div>
                <div class="card-body p-0">
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
                                @foreach ($results['categories'] as $category)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $category->name }}</div>
                                        </td>
                                        <td>
                                            <span
                                                class="small text-muted">{{ $category->created_at->format('M d, Y') }}</span>
                                        </td>
                                        <td class="pe-4 text-center">
                                            @if (auth()->user()->role === 'admin')
                                                <a href="{{ route('categories.edit', $category) }}"
                                                    class="btn btn-sm btn-outline-primary rounded-3">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!-- Suppliers Results -->
        @if ($results['suppliers']->count() > 0)
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-truck text-warning me-2"></i> Suppliers ({{ $results['suppliers']->count() }})
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Name</th>
                                    <th class="py-3 text-uppercase small fw-bold text-muted">Email</th>
                                    <th class="py-3 text-uppercase small fw-bold text-muted">Phone</th>
                                    <th class="pe-4 py-3 text-center text-uppercase small fw-bold text-muted">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results['suppliers'] as $supplier)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $supplier->name }}</div>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $supplier->email }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $supplier->phone }}</span>
                                        </td>
                                        <td class="pe-4 text-center">
                                            @if (auth()->user()->role === 'admin')
                                                <a href="{{ route('suppliers.edit', $supplier) }}"
                                                    class="btn btn-sm btn-outline-primary rounded-3">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!-- Users Results (Admin Only) -->
        @if (auth()->user()->role === 'admin' && $results['users']->count() > 0)
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-users text-danger me-2"></i> Users ({{ $results['users']->count() }})
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">User</th>
                                    <th class="py-3 text-uppercase small fw-bold text-muted">Email</th>
                                    <th class="py-3 text-uppercase small fw-bold text-muted">Role</th>
                                    <th class="pe-4 py-3 text-center text-uppercase small fw-bold text-muted">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results['users'] as $user)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center text-primary fw-bold"
                                                    style="width: 35px; height: 35px;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $user->email }}</span>
                                        </td>
                                        <td>
                                            @if ($user->role === 'admin')
                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                    <i class="fas fa-shield-alt me-1"></i> Admin
                                                </span>
                                            @else
                                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                                    <i class="fas fa-user me-1"></i> User
                                                </span>
                                            @endif
                                        </td>
                                        <td class="pe-4 text-center">
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="btn btn-sm btn-outline-primary rounded-3">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection
