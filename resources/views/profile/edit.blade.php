@extends('partials.app')

@section('css')
<style>
    .ls-wide { letter-spacing: 0.05em; }
    .input-group-text { border: none; background-color: #f8fafc; color: #64748b; }
    .form-control, .form-select { border: 1px solid #e2e8f0; }
    .form-control:focus, .form-select:focus { box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); border-color: #6366f1; }
    .profile-avatar {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: bold;
        color: white;
        border: 5px solid #fff;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .stat-card {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%);
        border-left: 4px solid #6366f1;
    }
</style>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-md-auto text-center text-md-start mb-4 mb-md-0">
                        <div class="profile-avatar rounded-circle mx-auto mx-md-0">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="col-md">
                        <h2 class="h3 mb-1 fw-bold">{{ $user->name }}</h2>
                        <p class="text-muted mb-2">{{ $user->email }}</p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                <i class="fas fa-shield-alt me-1"></i> {{ ucfirst($user->role) }}
                            </span>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                <i class="fas fa-check-circle me-1"></i> Active Account
                            </span>
                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                <i class="fas fa-calendar me-1"></i> Joined {{ $user->created_at->format('M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm rounded-4 stat-card h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="fas fa-user-clock fs-4 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Member Since</p>
                        <h5 class="mb-0 fw-bold">{{ $user->created_at->diffForHumans() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm rounded-4 stat-card h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="fas fa-clock fs-4 text-success"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Last Updated</p>
                        <h5 class="mb-0 fw-bold">{{ $user->updated_at->diffForHumans() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm rounded-4 stat-card h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="fas fa-id-badge fs-4 text-warning"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">User ID</p>
                        <h5 class="mb-0 fw-bold">#{{ $user->id }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-light border-0 p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                        <i class="fas fa-user-edit fs-5 text-primary"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Edit Profile Information</h5>
                        <p class="text-muted small mb-0">Update your personal details below</p>
                    </div>
                </div>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="name" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="jenis_kelamin" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Gender</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i class="fas fa-venus-mars"></i></span>
                                <select class="form-select py-3 px-4 border-start-0 rounded-end-4 @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="pekerjaan" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Job Title <span class="text-lowercase fw-normal">(optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i class="fas fa-briefcase"></i></span>
                                <input type="text" class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan) }}" placeholder="e.g. Software Engineer, Teacher...">
                                @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Address <span class="text-lowercase fw-normal">(optional)</span></label>
                        <div class="input-group">
                            <span class="input-group-text px-3 border-end-0 rounded-start-4 align-items-start pt-3"><i class="fas fa-map-marker-alt"></i></span>
                            <textarea class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" placeholder="Enter your full address...">{{ old('alamat', $user->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-info border-0 rounded-4 mb-4 d-flex align-items-start">
                        <i class="fas fa-info-circle me-3 mt-1 fs-5"></i>
                        <div>
                            <strong>Account Security</strong>
                            <p class="mb-0 small">Your role is <span class="badge bg-primary">{{ ucfirst($user->role) }}</span> and cannot be changed from this page. Contact an administrator if you need role changes.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 pt-3 border-top">
                        <button type="submit" class="btn btn-premium btn-lg px-5 py-3 shadow-lg">
                            <i class="fas fa-save me-2"></i> Update Profile
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-4 py-3 text-muted fw-bold border-0 shadow-sm rounded-4">
                            <i class="fas fa-times me-2"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .tracking-tight { letter-spacing: -0.02em; }
</style>
@endsection
