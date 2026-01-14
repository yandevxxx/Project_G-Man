@extends('partials.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">
        <div>
            <h2 class="h3 mb-1 fw-800 tracking-tight text-slate-900">Purchase History</h2>
            <p class="text-muted fw-500 mb-0">Review your past orders and transaction details.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <form action="{{ route('purchases.history') }}" method="GET" class="position-relative">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted opacity-50 small"></i>
                <input type="text" name="q" class="form-control glass-input shadow-none"
                    style="width: 250px; font-size: 0.85rem;" placeholder="Search orders..." 
                    value="{{ request('q') }}">
                @if(request('q'))
                    <a href="{{ route('purchases.history') }}" class="position-absolute top-50 end-0 translate-middle-y me-2 text-muted hover-opacity-100">
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

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                @forelse($purchases as $purchase)
                    <div class="transaction-row p-3 p-md-4 transition-all {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="row align-items-center">
                            <!-- Product Image & ID -->
                            <div class="col-auto">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $purchase->product->image_url ?? asset('images/placeholder-product.png') }}" 
                                        alt="{{ $purchase->product->name }}" 
                                        class="rounded-3 border shadow-sm" style="width: 52px; height: 52px; object-fit: cover;">
                                    <div class="d-none d-sm-block">
                                        <div class="small fw-800 text-slate-400 text-uppercase ls-wide mb-0" style="font-size: 0.65rem;">Order ID</div>
                                        <div class="fw-700 text-slate-600" style="font-size: 0.85rem;">#{{ $purchase->id }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product & Category -->
                            <div class="col col-md-4">
                                <h6 class="fw-800 text-slate-900 mb-0 text-truncate">{{ $purchase->product->name ?? 'Unknown Product' }}</h6>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-primary small fw-600">{{ $purchase->product->category->name ?? 'General' }}</span>
                                    <span class="text-slate-300 d-none d-md-inline">•</span>
                                    <span class="text-muted small fw-500 d-none d-md-inline">{{ $purchase->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <!-- Quantity & Price -->
                            <div class="col-auto col-md-2 text-md-center">
                                <div class="small text-muted mb-0" style="font-size: 0.7rem;">Qty: {{ $purchase->quantity }}</div>
                                <div class="small fw-700 text-slate-900">Rp {{ number_format($purchase->price, 0, ',', '.') }}</div>
                            </div>

                            <!-- Total & Status -->
                            <div class="col col-md text-end ps-0">
                                <div class="d-flex align-items-center justify-content-end gap-3">
                                    <div class="text-end">
                                        <div class="small text-muted text-uppercase fw-800 ls-wide mb-0 d-none d-md-block" style="font-size: 0.6rem;">Total Paid</div>
                                        <div class="h6 fw-900 text-primary mb-0">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="status-indicator ms-2">
                                        @if($purchase->status === 'pending')
                                            <i class="fas fa-clock text-warning fs-5" title="Pending Approval"></i>
                                        @elseif($purchase->status === 'accepted')
                                            <i class="fas fa-check-circle text-success fs-5" title="Approved"></i>
                                        @elseif($purchase->status === 'rejected')
                                            <i class="fas fa-times-circle text-danger fs-5" title="Rejected"></i>
                                        @else
                                            <i class="fas fa-info-circle text-primary fs-5" title="{{ ucfirst($purchase->status) }}"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="empty-state-icon mb-3">
                            <i class="fas fa-receipt opacity-10" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="fw-800 text-slate-900 mb-2">No Transactions Found</h5>
                        <p class="text-muted mb-4 small">Your purchase history is currently empty.</p>
                        <a href="{{ route('purchases.catalog') }}" class="btn btn-premium px-4 py-2 shadow-sm rounded-pill">
                            Browse Catalog
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

    <style>
        .transaction-row {
            background-color: #fff;
            transition: all 0.2s ease;
        }
        .transaction-row:hover {
            background-color: #f8fafc;
        }
        .ls-wide { letter-spacing: 0.025em; }
    </style>
    </div>
@endsection
