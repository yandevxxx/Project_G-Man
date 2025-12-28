@extends('partials.app')

@section('content')
    <div class="mb-5">
        <h2 class="h3 mb-4 fw-bold tracking-tight">All Transactions</h2>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Order ID</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">User</th>
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
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle me-2 d-flex align-items-center justify-content-center text-muted fw-bold small"
                                            style="width: 32px; height: 32px;">
                                            {{ substr($purchase->user->name, 0, 1) }}
                                        </div>
                                        <span class="text-dark fw-medium">{{ $purchase->user->name }}</span>
                                    </div>
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
                                            <div class="text-dark fw-medium small">
                                                {{ $purchase->product->name ?? 'Unknown Product' }}</div>
                                            <div class="small text-muted" style="font-size: 0.75rem;">Qty:
                                                {{ $purchase->quantity }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">Rp
                                        {{ number_format($purchase->total_amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <span
                                        class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Completed</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-receipt fs-1 d-block mb-3 opacity-25"></i>
                                        No transactions found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                {{ $purchases->links() }}
            </div>
        </div>
    </div>
@endsection
