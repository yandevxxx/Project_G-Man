<div class="p-4 border-bottom border-white border-opacity-10">
    <a href="{{ route('dashboard') }}" class="text-white text-decoration-none d-flex align-items-center">
        <i class="fas fa-warehouse me-2 fs-4"></i>
        <span class="h5 mb-0 fw-bold">G-MAN</span>
    </a>
</div>
<div class="nav flex-column mt-3">
    <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-25' : '' }}">
        <i class="fas fa-th-large me-2"></i> Dashboard
    </a>
    
    @if(Auth::user()->role == 'admin')
    <div class="px-4 py-2 small text-white text-opacity-50 text-uppercase fw-bold" style="font-size: 0.7rem;">Inventory</div>
    <a href="#" class="nav-link text-white">
        <i class="fas fa-box me-2"></i> Stock Management
    </a>
    <a href="#" class="nav-link text-white">
        <i class="fas fa-arrow-down me-2"></i> Stock In
    </a>
    <a href="#" class="nav-link text-white">
        <i class="fas fa-arrow-up me-2"></i> Stock Out
    </a>
    @endif

    @if(Auth::user()->role == 'supplier')
    <div class="px-4 py-2 small text-white text-opacity-50 text-uppercase fw-bold" style="font-size: 0.7rem;">Supplier</div>
    <a href="#" class="nav-link text-white">
        <i class="fas fa-truck me-2"></i> Requests
    </a>
    @endif
</div>

