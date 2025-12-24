<nav class="topbar shadow-sm">
    <div class="d-flex align-items-center">
        <button class="btn btn-light d-lg-none me-3" onclick="document.getElementById('sidebar-wrapper').classList.toggle('active')">
            <i class="fas fa-bars"></i>
        </button>
        <span class="text-muted fw-medium d-none d-md-block">Warehouse Management System</span>
    </div>
    
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle fw-semibold" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
            <span class="badge bg-primary ms-1 text-white">{{ ucfirst(Auth::user()->role) }}</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
            <li><a class="dropdown-item" href="#"><i class="fas fa-id-card me-2 opacity-50"></i> Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
