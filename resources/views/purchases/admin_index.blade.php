@extends('partials.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">
        <div>
            <h2 class="h3 mb-1 fw-800 tracking-tight text-slate-900">Transaction Registry</h2>
            <p class="text-muted fw-500 mb-0">Monitor and track all system-wide purchase activities.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <form action="{{ route('admin.transactions') }}" method="GET" class="position-relative">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted opacity-50 small"></i>
                <input type="text" name="q" class="form-control glass-input shadow-none"
                    style="width: 280px; font-size: 0.85rem;" placeholder="Search all transactions..." 
                    value="{{ request('q') }}">
                @if(request('q'))
                    <a href="{{ route('admin.transactions') }}" class="position-absolute top-50 end-0 translate-middle-y me-2 text-muted hover-opacity-100">
                        <i class="fas fa-times-circle fs-7"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Order ID</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">User</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Date</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Product</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Method</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Proof</th>
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
                                    <span class="badge bg-light text-dark border fw-500 small">{{ $purchase->payment_type ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    @if($purchase->payment_proof)
                                        <a href="{{ $purchase->proof_url }}" target="_blank">
                                            <img src="{{ $purchase->proof_url }}" alt="Proof" 
                                                class="rounded border shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                                        </a>
                                    @else
                                        <span class="text-muted small">No Proof</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">Rp
                                        {{ number_format($purchase->total_amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="pe-4 text-end">
                                    @if($purchase->status === 'pending')
                                        <div class="d-flex justify-content-end gap-2">
                                            <form action="{{ route('admin.transactions.approve', $purchase->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
                                                    <i class="fas fa-check me-1"></i> Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.transactions.reject', $purchase->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 fw-bold">
                                                    <i class="fas fa-times me-1"></i> Reject
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        @if($purchase->status === 'accepted')
                                            <span class="soft-badge bg-success-soft"><i class="fas fa-check-circle me-1"></i> Approved</span>
                                        @elseif($purchase->status === 'rejected')
                                            <span class="soft-badge bg-danger-soft"><i class="fas fa-times-circle me-1"></i> Rejected</span>
                                        @else
                                            <span class="soft-badge bg-primary-soft"><i class="fas fa-info-circle me-1"></i> {{ ucfirst($purchase->status) }}</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">No transactions found</h5>
                                    <p class="text-muted small mb-0">There are no recorded transactions in the system.</p>
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
