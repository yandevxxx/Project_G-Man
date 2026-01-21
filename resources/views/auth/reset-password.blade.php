@extends('partials.app')

@section('auth_width', '450px')

@section('content')
    <div class="text-center mb-5 mt-2">
        <!-- Brand Section -->
        <div class="d-inline-flex flex-column align-items-center mb-4">
            <div class="d-flex align-items-center justify-content-center bg-premium p-3 rounded-4 shadow-lg mb-3" style="width: 55px; height: 55px; background: linear-gradient(135deg, var(--primary-soft) 0%, var(--accent-color) 100%) !important;">
                <i class="fas fa-warehouse fs-4 text-white"></i>
            </div>
            <h2 class="fw-bolder text-dark mb-0 tracking-tighter" style="font-size: 1.4rem;">G-MAN</h2>
            <p class="text-accent fw-bold text-uppercase mb-0" style="font-size: 0.55rem; letter-spacing: 0.2em; color: var(--accent-color) !important;">Warehouse System</p>
        </div>
        
        <!-- Subtle Divider -->
        <div class="d-flex justify-content-center mb-4">
            <div style="width: 40px; height: 1.5px; background: var(--primary-soft); opacity: 0.2;"></div>
        </div>

        <!-- Welcome Section -->
        <h3 class="fw-bold text-dark h5 mb-2 mt-1">Reset Password</h3>
        <p class="text-muted small px-3">Set your new strong password for account <b>{{ $email }}</b></p>
    </div>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-4">
            <label for="password" class="form-label small fw-bold text-secondary ms-1 mb-2 text-uppercase tracking-wide" style="font-size: 0.75rem;">New Password</label>
            <div class="input-group">
                <span class="input-group-text border-0"><i class="fas fa-lock text-muted" style="font-size: 0.9rem;"></i></span>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                    placeholder="••••••••" required autofocus>
            </div>
            @error('password')
                <div class="text-danger small ms-1 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="password_confirmation" class="form-label small fw-bold text-secondary ms-1 mb-2 text-uppercase tracking-wide" style="font-size: 0.75rem;">Confirm New Password</label>
            <div class="input-group">
                <span class="input-group-text border-0"><i class="fas fa-shield-alt text-muted" style="font-size: 0.9rem;"></i></span>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="••••••••" required>
            </div>
        </div>

        <div class="d-grid mb-5">
            <button type="submit" class="btn btn-premium shadow-lg">
                <span>Update Password</span>
                <i class="fas fa-check-double ms-2" style="font-size: 0.8rem;"></i>
            </button>
        </div>

        <div class="text-center pt-3 border-top border-light">
            <p class="text-muted small mb-0">Need help? <a href="#" class="text-primary fw-bold text-decoration-none hover-underline">Contact Support</a></p>
        </div>
    </form>
@endsection
