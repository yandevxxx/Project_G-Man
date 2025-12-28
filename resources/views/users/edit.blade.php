@extends('partials.app')

@section('css')
    <style>
        .ls-wide {
            letter-spacing: 0.05em;
        }

        .input-group-text {
            border: none;
            background-color: #f8fafc;
            color: #64748b;
        }

        .form-control,
        .form-select {
            border: 1px solid #e2e8f0;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            border-color: #6366f1;
        }
    </style>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('users.index') }}"
            class="btn btn-link text-decoration-none p-0 mb-3 small fw-bold text-primary transition-all hover-translate-x">
            <i class="fas fa-arrow-left me-1"></i> Back to Users
        </a>
        <div class="d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 p-3 rounded-4 me-3 shadow-sm text-primary">
                <i class="fas fa-user-edit fs-3"></i>
            </div>
            <div>
                <h2 class="h3 mb-1 fw-bold tracking-tight">Edit User</h2>
                <p class="text-muted small mb-0">Update information for: <strong
                        class="text-dark">{{ $user->name }}</strong></p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                        class="fas fa-user"></i></span>
                                <input type="text"
                                    class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Email
                                Address</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                        class="fas fa-envelope"></i></span>
                                <input type="email"
                                    class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="role"
                                    class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Role</label>
                                <div class="input-group">
                                    <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                            class="fas fa-shield-alt"></i></span>
                                    <select
                                        class="form-select py-3 px-4 border-start-0 rounded-end-4 @error('role') is-invalid @enderror"
                                        id="role" name="role" required>
                                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                            User</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                            Admin</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="jenis_kelamin"
                                    class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Gender</label>
                                <div class="input-group">
                                    <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                            class="fas fa-venus-mars"></i></span>
                                    <select
                                        class="form-select py-3 px-4 border-start-0 rounded-end-4 @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="pekerjaan"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Job <span
                                    class="text-lowercase fw-normal">(optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                        class="fas fa-briefcase"></i></span>
                                <input type="text"
                                    class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('pekerjaan') is-invalid @enderror"
                                    id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan) }}"
                                    placeholder="e.g. Software Engineer, Teacher...">
                                @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="alamat"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Address <span
                                    class="text-lowercase fw-normal">(optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4 align-items-start pt-3"><i
                                        class="fas fa-map-marker-alt"></i></span>
                                <textarea class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('alamat') is-invalid @enderror"
                                    id="alamat" name="alamat" rows="3" placeholder="Enter full address...">{{ old('alamat', $user->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-premium btn-lg px-5 py-3 shadow-lg">
                                <i class="fas fa-save me-2"></i> Update User
                            </button>
                            <a href="{{ route('users.index') }}"
                                class="btn btn-light btn-lg px-4 py-3 text-muted fw-bold border-0 shadow-sm rounded-4">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-translate-x:hover {
            transform: translateX(-5px);
        }

        .tracking-tight {
            letter-spacing: -0.02em;
        }
    </style>
@endsection
