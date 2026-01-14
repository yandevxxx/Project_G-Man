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
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Order ID</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Date</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Product</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Total Amount</th>
                            <th class="pe-4 py-3 text-uppercase small fw-bold text-muted text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchases as $purchase)
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark">#{{ $purchase->id }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $purchase->created_at->format('M d, Y H:i') }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded text-muted d-flex align-items-center justify-content-center me-2"
                                            style="width: 32px; height: 32px;">
                                            <i class="fas fa-box small"></i>
                                        </div>
                                        <div>
                                            <div class="text-dark fw-medium">
                                                {{ $purchase->product->name ?? 'Unknown Product' }}</div>
                                            <div class="small text-muted">{{ $purchase->quantity }} x Rp
                                                {{ number_format($purchase->price, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">Rp
                                        {{ number_format($purchase->total_amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <span
                                        class="soft-badge bg-success-soft"><i class="fas fa-check-circle me-1"></i> Completed</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">No purchase history</h5>
                                    <p class="text-muted small mb-0">You haven't made any purchases yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
