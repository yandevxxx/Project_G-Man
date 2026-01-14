@extends('partials.app')

@section('css')
    <style>
        .profile-avatar {
            width: 130px;
            height: 130px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            border: 6px solid #fff;
            box-shadow: 0 15px 35px -5px rgba(99, 102, 241, 0.25);
            transition: all 0.4s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05) rotate(5deg);
        }

        .stat-card {
            background: #fff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-left: 5px solid var(--primary-soft);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.03));
            z-index: -1;
        }

        .stat-card.stat-success { border-left-color: #10b981; }
        .stat-card.stat-warning { border-left-color: #f59e0b; }
    </style>
@endsection

@section('content')
    <div class="mb-5">
        <h2 class="h3 mb-1 fw-800 tracking-tight text-slate-900">Personal Profile</h2>
        <p class="text-muted fw-500 mb-0">Manage your account information and preferences.</p>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative" style="background: linear-gradient(to right, #ffffff, #f8fafc);">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-md-auto text-center text-md-start mb-4 mb-md-0">
                            <div class="profile-avatar rounded-circle mx-auto mx-md-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="col-md ms-md-4">
                            <div class="d-flex align-items-center mb-2">
                                <h2 class="h2 mb-0 fw-800 text-slate-900">{{ $user->name }}</h2>
                            </div>
                            <p class="text-muted fw-500 mb-4 fs-5">{{ $user->email }}</p>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="soft-badge bg-primary-soft">
                                    <i class="fas fa-shield-alt me-1"></i> {{ ucfirst($user->role) }}
                                </span>
                                <span class="soft-badge bg-success-soft">
                                    <i class="fas fa-check-circle me-1"></i> Active Account
                                </span>
                                <span class="soft-badge bg-info-soft">
                                    <i class="fas fa-calendar me-1"></i> Joined {{ $user->created_at->format('M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-4 stat-card h-100 hover-translate-y">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary-soft p-3 rounded-4 me-3">
                            <i class="fas fa-user-clock fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small fw-600 mb-1">Member Since</p>
                            <h5 class="mb-0 fw-800 text-slate-900">{{ $user->created_at->diffForHumans() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-4 stat-card stat-success h-100 hover-translate-y">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success-soft p-3 rounded-4 me-3">
                            <i class="fas fa-clock fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small fw-600 mb-1">Last Updated</p>
                            <h5 class="mb-0 fw-800 text-slate-900">{{ $user->updated_at->diffForHumans() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-4 stat-card stat-warning h-100 hover-translate-y">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning-soft p-3 rounded-4 me-3">
                            <i class="fas fa-id-badge fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small fw-600 mb-1">User ID</p>
                            <h5 class="mb-0 fw-800 text-slate-900">#{{ $user->id }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 py-3 px-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-5"></i>
                <div class="fw-600">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4 pt-5">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary-soft p-3 rounded-4 me-3 shadow-sm">
                            <i class="fas fa-user-edit fs-4 text-primary"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-800 text-slate-900">Account Settings</h5>
                            <p class="text-muted fw-500 mb-0">Update your personal identification and details.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5 pt-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name"
                                    class="form-label small fw-800 text-uppercase ls-wide text-muted mb-2">Full
                                    Name</label>
                                <div class="input-group">
                                    <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                            class="fas fa-user opacity-50"></i></span>
                                    <input type="text"
                                        class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
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
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
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

                            <div class="col-md-6 mb-4">
                                <label for="pekerjaan"
                                    class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Job Title <span
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
                        </div>

                        <div class="mb-4">
                            <label for="alamat"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Address <span
                                    class="text-lowercase fw-normal">(optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4 align-items-start pt-3"><i
                                        class="fas fa-map-marker-alt"></i></span>
                                <textarea class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('alamat') is-invalid @enderror"
                                    id="alamat" name="alamat" rows="3" placeholder="Enter your full address...">{{ old('alamat', $user->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="alert bg-white border border-light rounded-4 mb-4 d-flex align-items-center p-4 shadow-sm">
                            <div class="bg-primary-soft p-3 rounded-4 me-3">
                                <i class="fas fa-shield-alt fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-800 text-slate-900">Account Security</h6>
                                <p class="mb-0 small text-muted">Your role is <span
                                        class="soft-badge bg-primary-soft py-1 px-2">{{ ucfirst($user->role) }}</span> and cannot be changed
                                    from this page. Contact an administrator for role modifications.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 pt-3">
                            <button type="submit" class="btn btn-premium btn-lg px-5 py-3 shadow-lg">
                                <i class="fas fa-save me-2"></i> Save Changes
                            </button>
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-link text-decoration-none text-muted fw-800 fs-7">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
