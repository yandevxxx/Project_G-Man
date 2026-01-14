@extends('partials.app')

@section('css')
    <style>
        .stat-card {
            border: none;
            border-radius: 1.5rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 100%);
            z-index: -1;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1.25rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            font-size: 1.75rem;
            color: white;
            margin-bottom: 1.5rem;
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 800;
            color: white;
            line-height: 1.2;
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
        }

        .bg-gradient-purple {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        }

        .bg-gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        }

        .bg-gradient-orange {
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
        }

        .bg-gradient-green {
            background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
        }

        .quick-action-card {
            border: 2px dashed #e2e8f0;
            border-radius: 1.5rem;
            background: transparent;
            transition: all 0.3s ease;
        }

        .quick-action-card:hover {
            border-color: var(--primary-soft);
            background: rgba(99, 102, 241, 0.02);
            transform: scale(1.02);
        }

        .tracking-tight {
            letter-spacing: -0.025em;
        }
    </style>
@endsection

@section('content')
    <div class="mb-5">
        <div class="row align-items-center">
            <div class="col-md">
                <h1 class="h2 fw-800 tracking-tight text-slate-900 mb-1">
                    Welcome back, {{ explode(' ', Auth::user()->name)[0] }}! 👋
                </h1>
                <p class="text-muted fw-500 mb-0">Here's what's happening with G-Man Warehouse today.</p>
            </div>
            <div class="col-md-auto mt-4 mt-md-0">
                <div class="d-flex gap-3">
                    <div class="text-end d-none d-lg-block">
                        <p class="small text-muted mb-0 fw-bold text-uppercase ls-1">System Time</p>
                        <p class="h6 mb-0 fw-bold">{{ now()->format('l, d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="row g-4 mb-5">
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card bg-gradient-purple shadow-lg">
                <div class="card-body p-4">
                    <div class="stat-icon pulse-animation">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-value">{{ number_format($stats['products_count']) }}</div>
                    <div class="stat-label">Total Products</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card bg-gradient-blue shadow-lg">
                <div class="card-body p-4">
                    <div class="stat-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-value">{{ number_format($stats['categories_count']) }}</div>
                    <div class="stat-label">Categories</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card bg-gradient-orange shadow-lg">
                <div class="card-body p-4">
                    <div class="stat-icon">
                        <i class="fas fa-truck-loading"></i>
                    </div>
                    <div class="stat-value">{{ number_format($stats['suppliers_count']) }}</div>
                    <div class="stat-label">Suppliers</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card bg-gradient-green shadow-lg">
                <div class="card-body p-4">
                    <div class="stat-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="stat-value">Rp {{ number_format($total_revenue, 0, ',', '.') }}</div>
                    <div class="stat-label">{{ Auth::user()->role === 'admin' ? 'Total Revenue' : 'Total Spending' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Transactions -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold text-slate-800">Recent Transactions</h5>
                        <p class="text-muted small mb-0">Latest 5 activities in your warehouse</p>
                    </div>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.transactions') }}" class="btn btn-light btn-sm rounded-pill px-3">View All</a>
                    @else
                        <a href="{{ route('purchases.history') }}" class="btn btn-light btn-sm rounded-pill px-3">View All</a>
                    @endif
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase small fw-bold text-muted border-0">Product</th>
                                    <th class="py-3 text-uppercase small fw-bold text-muted border-0">{{ Auth::user()->role === 'admin' ? 'Customer' : 'Quantity' }}</th>
                                    <th class="py-3 text-uppercase small fw-bold text-muted border-0">Total</th>
                                    <th class="pe-4 py-3 text-center text-uppercase small fw-bold text-muted border-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_purchases as $purchase)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 text-primary">
                                                    <i class="fas fa-shopping-bag"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark mb-0">{{ $purchase->product->name }}</div>
                                                    <div class="small text-muted">{{ $purchase->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if(Auth::user()->role === 'admin')
                                                <span class="text-dark fw-medium small">{{ $purchase->user->name }}</span>
                                            @else
                                                <span class="text-dark fw-medium small">{{ $purchase->quantity }} Item(s)</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="pe-4 text-center">
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i> Completed
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="text-muted opacity-50">
                                                <i class="fas fa-receipt fs-1 d-block mb-3"></i>
                                                No transactions found.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="mb-0 fw-bold text-slate-800">Quick Actions</h5>
                    <p class="text-muted small mb-0">Jump directly to common tasks</p>
                </div>
                <div class="card-body p-4 pt-0">
                    <div class="d-grid gap-3">
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('products.create') }}" class="btn quick-action-card p-3 text-start d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                                    <i class="fas fa-plus text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark small">Add New Product</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Create a new inventory item</div>
                                </div>
                            </a>
                            <a href="{{ route('categories.create') }}" class="btn quick-action-card p-3 text-start d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3">
                                    <i class="fas fa-folder-plus text-success"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark small">New Category</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Organize your workspace</div>
                                </div>
                            </a>
                        @endif
                        <a href="{{ route('purchases.catalog') }}" class="btn quick-action-card p-3 text-start d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3">
                                <i class="fas fa-shopping-cart text-warning"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Browse Shop</div>
                                <div class="text-muted" style="font-size: 0.75rem;">View and purchase products</div>
                            </div>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn quick-action-card p-3 text-start d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 p-2 rounded-3 me-3">
                                <i class="fas fa-user-gear text-info"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Account Settings</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Manage your personal profile</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
