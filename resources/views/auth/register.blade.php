@extends('partials.app')

@section('auth_width', '600px')

@section('content')
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark">Create Account</h3>
                <p class="text-muted small">Join us today</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-4 py-2 px-3 small">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label small fw-semibold text-muted">Full Name</label>
                        <input type="text" class="form-control bg-light border-0 py-2" id="name" name="name"
                            value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label small fw-semibold text-muted">Email Address</label>
                        <input type="email" class="form-control bg-light border-0 py-2" id="email" name="email"
                            value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label small fw-semibold text-muted">Role</label>
                        <select class="form-select bg-light border-0 py-2" id="role" name="role" required>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pekerjaan" class="form-label small fw-semibold text-muted">Job Title</label>
                        <input type="text" class="form-control bg-light border-0 py-2" id="pekerjaan" name="pekerjaan"
                            value="{{ old('pekerjaan') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted mb-2">Gender</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="male"
                                value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                            <label class="form-check-label small" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="female"
                                value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                            <label class="form-check-label small" for="female">Female</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label small fw-semibold text-muted">Address</label>
                    <textarea class="form-control bg-light border-0 py-2" id="alamat" name="alamat" rows="2">{{ old('alamat') }}</textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-6 mb-4">
                        <label for="password" class="form-label small fw-semibold text-muted">Password</label>
                        <input type="password" class="form-control bg-light border-0 py-2" id="password" name="password"
                            required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="password_confirmation" class="form-label small fw-semibold text-muted">Confirm
                            Password</label>
                        <input type="password" class="form-control bg-light border-0 py-2" id="password_confirmation"
                            name="password_confirmation" required>
                    </div>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary py-2 fw-semibold rounded-3">Register</button>
                </div>

                <div class="text-center">
                    <p class="text-muted small mb-0">Already have an account? <a href="{{ route('login') }}"
                            class="text-decoration-none fw-semibold">Sign In</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
