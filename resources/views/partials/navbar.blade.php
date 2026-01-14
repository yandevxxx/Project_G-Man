<nav class="topbar">
    <div class="d-flex align-items-center">
        <button class="btn btn-premium-light d-xl-none me-4 rounded-circle shadow-sm" data-bs-toggle="sidebar">
            <i class="fas fa-bars-staggered"></i>
        </button>
        <div class="d-none d-md-flex flex-column">
            <h5 class="mb-0 fw-bold tracking-tight text-slate-800">Operational Overview</h5>
            <span class="small text-muted fw-medium fs-7">G-MAN Enterprise Warehouse Control</span>
        </div>
    </div>

    <div class="d-flex align-items-center gap-4">
        <!-- Navbar Brand/Space -->
        <div class="flex-grow-1"></div>

        <!-- User profile -->
        <div class="dropdown">
            <button class="btn btn-glass dropdown-toggle d-flex align-items-center gap-3 py-2 px-3 rounded-pill"
                type="button" data-bs-toggle="dropdown">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm"
                    style="width: 35px; height: 35px; font-size: 0.8rem; background: var(--primary-gradient) !important;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="text-start d-none d-sm-block">
                    <div class="fw-bold mb-0 lh-1" style="font-size: 0.85rem;">{{ Auth::user()->name }}</div>
                    <span class="badge bg-primary-soft text-primary bg-opacity-10 fw-semibold mt-1"
                        style="font-size: 0.65rem;">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-4 animate-slide-in">
                <li><a class="dropdown-item py-2 px-3 rounded-3 mb-1" href="{{ route('profile.edit') }}"><i
                            class="fas fa-user-circle me-3 opacity-50"></i>My Profile</a></li>
                <li>
                    <hr class="dropdown-divider opacity-10">
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item py-2 px-3 rounded-3 text-danger fw-600"><i
                                class="fas fa-sign-out-alt me-3"></i>Sign Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .btn-premium-light {
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #64748b;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-premium-light:hover {
        background: #f8fafc;
        color: var(--primary-soft);
    }

    .btn-glass {
        background: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.5);
        transition: all 0.2s ease;
    }

    .btn-glass:hover {
        background: #fff;
        border-color: var(--primary-soft);
    }

    .bg-primary-soft {
        background: rgba(99, 102, 241, 0.1) !important;
    }

    .animate-slide-in {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
