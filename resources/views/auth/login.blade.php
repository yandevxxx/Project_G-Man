@extends('partials.app')

@section('auth_width', '400px')

@section('content')
    <div class="text-center mb-4">
        <div class="mb-3">
            <i class="fas fa-warehouse text-primary" style="font-size: 3rem;"></i>
        </div>
        <h4 class="fw-bold">G-MAN Warehouse</h4>
        <p class="text-muted small">Sign in to manage your inventory</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success py-2 small">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger py-2 small">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger py-2 small">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login.authenticate') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label small fw-semibold">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
        </div>
        <div class="mb-4">
            <div class="d-flex justify-content-between">
                <label for="password" class="form-label small fw-semibold">Password</label>
                <a href="#" class="small text-decoration-none">Forgot Password?</a>
            </div>
            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
        </div>
        <div class="d-grid">
            <button class="btn btn-primary fw-bold p-2" type="submit">Log In</button>
        </div>
    </form>

    <div class="text-center mt-4 pt-3 border-top">
        <p class="small text-muted mb-0">Don't have an account? <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">Create Account</a></p>
    </div>
@endsection
