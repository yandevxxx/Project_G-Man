@extends('partials.app')

@section('auth_width', '450px')

@section('content')
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark">Welcome Back</h3>
                <p class="text-muted small">Sign in to your account</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success border-0 rounded-3 mb-4 py-2 px-3 small">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger border-0 rounded-3 mb-4 py-2 px-3 small">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.authenticate') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-muted">Email Address</label>
                    <input type="email" class="form-control bg-light border-0 py-2" id="email" name="email"
                        value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold text-muted">Password</label>
                    <input type="password" class="form-control bg-light border-0 py-2" id="password" name="password"
                        required>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary py-2 fw-semibold rounded-3">Sign In</button>
                </div>

                <div class="text-center">
                    <p class="text-muted small mb-0">Don't have an account? <a href="{{ route('register') }}"
                            class="text-decoration-none fw-semibold">Register</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
