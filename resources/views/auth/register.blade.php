@extends('partials.app')

@section('auth_width', '750px')

@section('content')
    <div class="text-center mb-4">
        <div class="mb-3">
            <i class="fas fa-warehouse text-primary" style="font-size: 3rem;"></i>
        </div>
        <h4 class="fw-bold">Join G-MAN</h4>
        <p class="text-muted small">Create your warehouse management account</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2 small">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="John Doe" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ old('email') }}" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Role</label>
                <select name="role" class="form-select" required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="supplier" {{ old('role') == 'supplier' ? 'selected' : '' }}>Supplier</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Gender</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label small fw-semibold">Occupation</label>
                <input type="text" name="pekerjaan" class="form-control" placeholder="e.g. Warehouse Staff" value="{{ old('pekerjaan') }}">
            </div>

            <div class="col-12">
                <label class="form-label small fw-semibold">Address</label>
                <textarea name="alamat" class="form-control" placeholder="Full address..." rows="2">{{ old('alamat') }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label small fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
            </div>
        </div>

        <div class="d-grid mt-4">
            <button class="btn btn-primary fw-bold p-2" type="submit">Create Account</button>
        </div>
    </form>

    <div class="text-center mt-4 pt-3 border-top">
        <p class="small text-muted mb-0">Already have an account? <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">Sign In</a></p>
    </div>
@endsection
