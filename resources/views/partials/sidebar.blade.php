<div class="px-4 py-4 mb-3">
    <a href="{{ route('dashboard') }}" class="text-white text-decoration-none d-flex align-items-center">
        <div class="bg-primary p-2 rounded-3 me-3" style="background: var(--primary-gradient) !important;">
            <i class="fas fa-warehouse fs-5"></i>
        </div>
        <div>
            <span class="h5 mb-0 fw-bold d-block tracking-tight">G-MAN</span>
            <span class="small text-white text-opacity-50 fw-medium">Warehouse Pro</span>
        </div>
    </a>
</div>

<div class="nav flex-column px-3">
    <a href="{{ route('dashboard') }}" class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 transition-all {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-white text-opacity-75 hover-bg-white-10' }}" style="{{ request()->routeIs('dashboard') ? 'background: var(--primary-gradient) !important; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);' : '' }}">
        <i class="fas fa-th-large me-3 fs-5"></i>
        <span class="fw-semibold">Dashboard</span>
    </a>
    
    @if(Auth::user()->role == 'admin')
        <div class="px-4 mt-4 mb-2 small text-white text-opacity-25 text-uppercase fw-bold ls-wider" style="font-size: 0.65rem;">Inventory Control</div>
        
        <a href="#" class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 text-white text-opacity-75 hover-bg-white-10">
            <i class="fas fa-box me-3 fs-5 text-primary-soft"></i>
            <span class="fw-medium">Stock Levels</span>
        </a>
        <a href="#" class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 text-white text-opacity-75 hover-bg-white-10">
            <i class="fas fa-arrow-down me-3 fs-5 text-success"></i>
            <span class="fw-medium">Incoming Stock</span>
        </a>
        <a href="#" class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 text-white text-opacity-75 hover-bg-white-10">
            <i class="fas fa-arrow-up me-3 fs-5 text-danger"></i>
            <span class="fw-medium">Outgoing Stock</span>
        </a>
    @endif

    @if(Auth::user()->role == 'supplier')
        <div class="px-4 mt-4 mb-2 small text-white text-opacity-25 text-uppercase fw-bold ls-wider" style="font-size: 0.65rem;">Partner Portal</div>
        <a href="#" class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 text-white text-opacity-75 hover-bg-white-10">
            <i class="fas fa-truck-loading me-3 fs-5 text-warning"></i>
            <span class="fw-medium">Supply Requests</span>
        </a>
    @endif
</div>

<style>
    .transition-all {
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hover-bg-white-10:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #fff !important;
        transform: translateX(5px);
    }
    .ls-wider {
        letter-spacing: 0.05em;
    }
</style>
