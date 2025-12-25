@extends('partials.app')

@section('auth_width', '480px')

@section('content')
    <div class="text-center mb-5">
        <div class="mb-4 d-inline-flex p-4 bg-primary bg-opacity-10 rounded-4 shadow-sm">
            <i class="fas fa-warehouse text-primary" style="font-size: 2.5rem;"></i>
        </div>
        <h2 class="fw-bold text-dark tracking-tighter">Welcome Back</h2>
        <p class="text-muted fw-medium">Please sign in to your G-MAN account</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 py-3 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-5"></i>
                <span class="small fw-semibold">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger border-0 shadow-sm mb-4 rounded-4 py-3 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-3 fs-5"></i>
                <span class="small fw-semibold">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <form action="{{ route('login.authenticate') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-0 px-3 text-muted"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control border-0 bg-light py-3 px-4" id="email" name="email" placeholder="name@company.com" value="{{ old('email') }}" required>
            </div>
        </div>
        <div class="mb-5">
            <div class="d-flex justify-content-between mb-2">
                <label for="password" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-0">Password</label>
                <a href="#" class="small text-decoration-none fw-bold">Forgot?</a>
            </div>
            <div class="input-group">
                <span class="input-group-text bg-light border-0 px-3 text-muted"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control border-0 bg-light py-3 px-4" id="password" name="password" placeholder="••••••••" required>
            </div>
        </div>
        <div class="d-grid gap-3">
            <button class="btn btn-premium btn-lg py-3 shadow-lg" type="submit">Sign In to Dashboard</button>
            <a href="{{ route('register') }}" class="btn btn-light bg-white border-0 py-3 rounded-4 fw-bold text-muted shadow-sm">
                Create New Account
            </a>
        </div>
    </form>

    <div class="text-center mt-5 pt-4 border-top opacity-50">
        <p class="small text-muted mb-0">&copy; {{ date('Y') }} G-Man Logistics Global</p>
    </div>

    <style>
        .ls-wide { letter-spacing: 0.05em; }
        .fw-600 { font-weight: 600; }
    </style>
@endsection
