<div class="px-4 py-4 mb-3">
    <a href="{{ route('dashboard') }}" class="text-white text-decoration-none d-flex align-items-center">
        <div class="bg-primary p-2 rounded-3 me-3" style="background: var(--primary-gradient) !important;">
            <i class="fas fa-warehouse fs-5"></i>
        </div>
        <div>
            <span class="h5 mb-0 fw-bold d-block tracking-tight">G-MAN</span>
        </div>
    </a>
</div>

<div class="nav flex-column px-3">
    <a href="{{ route('dashboard') }}"
        class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 transition-all {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-white text-opacity-75 hover-bg-white-10' }}"
        style="{{ request()->routeIs('dashboard') ? 'background: var(--primary-gradient) !important; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);' : '' }}">
        <i class="fas fa-th-large me-3 fs-5"></i>
        <span class="fw-semibold">Dashboard</span>
    </a>

    @if (Auth::user()->role == 'admin')
        <div class="px-4 mt-4 mb-2 small text-white text-opacity-25 text-uppercase fw-bold ls-wider"
            style="font-size: 0.65rem;">Inventory Control</div>

        <a href="{{ route('categories.index') }}"
            class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 transition-all {{ request()->routeIs('categories.*') ? 'bg-primary text-white' : 'text-white text-opacity-75 hover-bg-white-10' }}"
            style="{{ request()->routeIs('categories.*') ? 'background: var(--primary-gradient) !important; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);' : '' }}">
            <i class="fas fa-tags me-3 fs-5 {{ request()->routeIs('categories.*') ? '' : 'text-primary-soft' }}"></i>
            <span class="fw-medium">Categories</span>
        </a>

        <a href="{{ route('products.index') }}"
            class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 transition-all {{ request()->routeIs('products.*') ? 'bg-primary text-white' : 'text-white text-opacity-75 hover-bg-white-10' }}"
            style="{{ request()->routeIs('products.*') ? 'background: var(--primary-gradient) !important; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);' : '' }}">
            <i class="fas fa-tags me-3 fs-5 {{ request()->routeIs('products.*') ? '' : 'text-primary-soft' }}"></i>
            <span class="fw-medium">Products</span>
        </a>

        <a href="{{ route('suppliers.index') }}"
            class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 transition-all {{ request()->routeIs('suppliers.*') ? 'bg-primary text-white' : 'text-white text-opacity-75 hover-bg-white-10' }}"
            style="{{ request()->routeIs('suppliers.*') ? 'background: var(--primary-gradient) !important; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);' : '' }}">
            <i class="fas fa-truck me-3 fs-5 {{ request()->routeIs('suppliers.*') ? '' : 'text-primary-soft' }}"></i>
            <span class="fw-medium">Suppliers</span>
        </a>
        
         <a href="{{ route('users.index') }}"
            class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 transition-all {{ request()->routeIs('users.*') ? 'bg-primary text-white' : 'text-white text-opacity-75 hover-bg-white-10' }}"
            style="{{ request()->routeIs('users.*') ? 'background: var(--primary-gradient) !important; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);' : '' }}">
            <i class="fas fa-users me-3 fs-5 {{ request()->routeIs('users.*') ? '' : 'text-primary-soft' }}"></i>
            <span class="fw-medium">User Management</span>
        </a>

        <a href="{{ route('admin.transactions') }}"
            class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 transition-all {{ request()->routeIs('admin.transactions') ? 'bg-primary text-white' : 'text-white text-opacity-75 hover-bg-white-10' }}"
            style="{{ request()->routeIs('admin.transactions') ? 'background: var(--primary-gradient) !important; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);' : '' }}">
            <i class="fas fa-chart-line me-3 fs-5 {{ request()->routeIs('admin.transactions') ? '' : 'text-primary-soft' }}"></i>
            <span class="fw-medium">Transactions</span>
        </a>
    @else
        <div class="px-4 mt-4 mb-2 small text-white text-opacity-25 text-uppercase fw-bold ls-wider"
            style="font-size: 0.65rem;">Shopping</div>

        <a href="{{ route('purchases.catalog') }}"
            class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 transition-all {{ request()->routeIs('purchases.catalog') ? 'bg-primary text-white' : 'text-white text-opacity-75 hover-bg-white-10' }}"
            style="{{ request()->routeIs('purchases.catalog') ? 'background: var(--primary-gradient) !important; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);' : '' }}">
            <i class="fas fa-store me-3 fs-5 {{ request()->routeIs('purchases.catalog') ? '' : 'text-primary-soft' }}"></i>
            <span class="fw-medium">Shop</span>
        </a>

        <a href="{{ route('purchases.history') }}"
            class="nav-link rounded-4 mb-2 d-flex align-items-center py-3 px-4 transition-all {{ request()->routeIs('purchases.history') ? 'bg-primary text-white' : 'text-white text-opacity-75 hover-bg-white-10' }}"
            style="{{ request()->routeIs('purchases.history') ? 'background: var(--primary-gradient) !important; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);' : '' }}">
            <i class="fas fa-history me-3 fs-5 {{ request()->routeIs('purchases.history') ? '' : 'text-primary-soft' }}"></i>
            <span class="fw-medium">History</span>
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
