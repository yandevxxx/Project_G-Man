@extends('partials.app')

@section('content')
    <div class="mb-5">
        <h2 class="h3 mb-1 fw-bold tracking-tight">Purchase History</h2>
        <p class="text-muted small mb-4">View your past orders and transactions.</p>

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
                                    @if ($purchase->status == 'completed')
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Completed</span>
                                    @else
                                        <span
                                            class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3">{{ ucfirst($purchase->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-receipt fs-1 d-block mb-3 opacity-25"></i>
                                        No purchase history found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
