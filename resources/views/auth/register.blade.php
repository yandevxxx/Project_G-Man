@extends('partials.app')

@section('auth_width', '600px')

@section('content')
    <div class="text-center mb-5 mt-1">
        <!-- Brand Section -->
        <div class="d-inline-flex flex-column align-items-center mb-3">
            <div class="d-flex align-items-center justify-content-center bg-premium p-2 rounded-3 shadow-sm mb-2" style="width: 45px; height: 45px; background: linear-gradient(135deg, var(--primary-soft) 0%, var(--accent-color) 100%) !important;">
                <i class="fas fa-warehouse fs-5 text-white"></i>
            </div>
            <h2 class="fw-bolder text-dark mb-0 h6 tracking-tighter">G-MAN</h2>
            <p class="text-accent fw-bold text-uppercase mb-0" style="font-size: 0.5rem; letter-spacing: 0.2em; color: var(--accent-color) !important;">Warehouse Solutions</p>
        </div>
        
        <!-- Subtle Divider -->
        <div class="d-flex justify-content-center mb-4">
            <div style="width: 30px; height: 1.5px; background: var(--primary-soft); opacity: 0.2;"></div>
        </div>

        <!-- Welcome Section -->
        <h3 class="fw-bold text-dark h5 mb-1">Create Account</h3>
        <p class="text-muted small">Join our professional ecosystem today</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 rounded-4 mb-4 py-3 px-4 small shadow-sm">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label for="name" class="form-label small fw-bold text-secondary ms-1 mb-2 text-uppercase tracking-wide" style="font-size: 0.75rem;">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text border-0"><i class="fas fa-user text-muted" style="font-size: 0.9rem;"></i></span>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                </div>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label small fw-bold text-secondary ms-1 mb-2 text-uppercase tracking-wide" style="font-size: 0.75rem;">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text border-0"><i class="fas fa-envelope text-muted" style="font-size: 0.9rem;"></i></span>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="johndoe@example.com" value="{{ old('email') }}" required>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label for="role" class="form-label small fw-bold text-secondary ms-1 mb-2 text-uppercase tracking-wide" style="font-size: 0.75rem;">Role</label>
                <div class="input-group">
                    <span class="input-group-text border-0"><i class="fas fa-user-tag text-muted" style="font-size: 0.9rem;"></i></span>
                    <select class="form-select border-0" id="role" name="role" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="pekerjaan" class="form-label small fw-bold text-secondary ms-1 mb-2 text-uppercase tracking-wide" style="font-size: 0.75rem;">Job Title</label>
                <div class="input-group">
                    <span class="input-group-text border-0"><i class="fas fa-briefcase text-muted" style="font-size: 0.9rem;"></i></span>
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                        placeholder="Warehouse Manager" value="{{ old('pekerjaan') }}">
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-secondary ms-1 mb-2 text-uppercase tracking-wide" style="font-size: 0.75rem;">Gender</label>
            <div class="d-flex gap-4 ms-1">
                <div class="form-check custom-radio">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="male"
                        value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                    <label class="form-check-label small" for="male">Male</label>
                </div>
                <div class="form-check custom-radio">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="female"
                        value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                    <label class="form-check-label small" for="female">Female</label>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label for="alamat" class="form-label small fw-bold text-secondary ms-1 mb-2 text-uppercase tracking-wide" style="font-size: 0.75rem;">Address</label>
            <div class="input-group">
                <span class="input-group-text border-0 align-items-start pt-3"><i class="fas fa-map-marker-alt text-muted" style="font-size: 0.9rem;"></i></span>
                <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Full address...">{{ old('alamat') }}</textarea>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <label for="password" class="form-label small fw-bold text-secondary ms-1 mb-2 text-uppercase tracking-wide" style="font-size: 0.75rem;">Password</label>
                <div class="input-group">
                    <span class="input-group-text border-0"><i class="fas fa-lock text-muted" style="font-size: 0.9rem;"></i></span>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="••••••••" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label small fw-bold text-secondary ms-1 mb-2 text-uppercase tracking-wide" style="font-size: 0.75rem;">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text border-0"><i class="fas fa-shield-alt text-muted" style="font-size: 0.9rem;"></i></span>
                    <input type="password" class="form-control" id="password_confirmation"
                        name="password_confirmation" placeholder="••••••••" required>
                </div>
            </div>
        </div>

        <div class="d-grid mb-5">
            <button type="submit" class="btn btn-premium shadow-lg">
                <span>Create New Account</span>
                <i class="fas fa-user-plus ms-2" style="font-size: 0.8rem;"></i>
            </button>
        </div>

        <div class="text-center pt-3 border-top border-light">
            <p class="text-muted small mb-0">Already have an account? <a href="{{ route('login') }}"
                    class="text-primary fw-bold text-decoration-none hover-underline">Sign In</a></p>
        </div>
    </form>
@endsection
