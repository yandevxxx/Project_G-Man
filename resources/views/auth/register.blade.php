@extends('partials.app')

@section('auth_width', '850px')

@section('content')
    <div class="text-center mb-5">
        <div class="mb-4 d-inline-flex p-4 bg-primary bg-opacity-10 rounded-4 shadow-sm">
            <i class="fas fa-warehouse text-primary" style="font-size: 2.5rem;"></i>
        </div>
        <h2 class="fw-bold text-dark tracking-tighter">Join the Enterprise</h2>
        <p class="text-muted fw-medium">Register your professional warehouse management account</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-5 rounded-4 py-3 px-4">
            <ul class="mb-0 small fw-semibold list-unstyled">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle me-2"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <!-- Account Info Section -->
            <div class="col-12 mb-2">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 0.7rem;">1</div>
                    <span class="fw-bold text-uppercase tracking-wider small text-muted">Account Information</span>
                    <div class="flex-grow-1 border-bottom ms-3 opacity-10"></div>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2 ps-1">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 px-3 text-muted"><i class="fas fa-user-circle"></i></span>
                    <input type="text" name="name" class="form-control border-0 bg-light py-3 px-4" placeholder="e.g. Alexander Pierce" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2 ps-1">Work Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 px-3 text-muted"><i class="fas fa-envelope-open"></i></span>
                    <input type="email" name="email" class="form-control border-0 bg-light py-3 px-4" placeholder="alex@gman.com" value="{{ old('email') }}" required>
                </div>
            </div>
            
            <!-- Professional Section -->
            <div class="col-12 mt-5 mb-2">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 0.7rem;">2</div>
                    <span class="fw-bold text-uppercase tracking-wider small text-muted">Professional Details</span>
                    <div class="flex-grow-1 border-bottom ms-3 opacity-10"></div>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2 ps-1">System Role</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 px-3 text-muted"><i class="fas fa-shield-halved"></i></span>
                    <select name="role" class="form-select border-0 bg-light py-3 px-4 fw-medium" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Standard User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>System Admin</option>
                        <option value="supplier" {{ old('role') == 'supplier' ? 'selected' : '' }}>Fulfillment Partner</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2 ps-1">Professional Title</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 px-3 text-muted"><i class="fas fa-briefcase"></i></span>
                    <input type="text" name="pekerjaan" class="form-control border-0 bg-light py-3 px-4" placeholder="e.g. Lead Logistics" value="{{ old('pekerjaan') }}">
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2 ps-1">Gender Identification</label>
                <div class="d-flex gap-3">
                    <input type="radio" class="btn-check" name="jenis_kelamin" id="male" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required autofocus>
                    <label class="btn btn-outline-light border-0 bg-light text-muted fw-bold flex-fill py-3 rounded-4" for="male">Male</label>

                    <input type="radio" class="btn-check" name="jenis_kelamin" id="female" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                    <label class="btn btn-outline-light border-0 bg-light text-muted fw-bold flex-fill py-3 rounded-4" for="female">Female</label>
                </div>
            </div>

            <div class="col-12 mt-4">
                <label class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2 ps-1">Office/Facility Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 px-3 text-muted align-items-start pt-3"><i class="fas fa-location-dot"></i></span>
                    <textarea name="alamat" class="form-control border-0 bg-light py-3 px-4" placeholder="Detail your facility location..." rows="2">{{ old('alamat') }}</textarea>
                </div>
            </div>

            <!-- Security Section -->
            <div class="col-12 mt-5 mb-2">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 0.7rem;">3</div>
                    <span class="fw-bold text-uppercase tracking-wider small text-muted">Account Security</span>
                    <div class="flex-grow-1 border-bottom ms-3 opacity-10"></div>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2 ps-1">Create Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 px-3 text-muted"><i class="fas fa-key"></i></span>
                    <input type="password" name="password" class="form-control border-0 bg-light py-3 px-4" placeholder="••••••••" required>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2 ps-1">Confirm Security Key</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 px-3 text-muted"><i class="fas fa-check-double"></i></span>
                    <input type="password" name="password_confirmation" class="form-control border-0 bg-light py-3 px-4" placeholder="••••••••" required>
                </div>
            </div>
        </div>

        <div class="d-grid mt-5 gap-3">
            <button class="btn btn-premium btn-lg py-3 shadow-lg" type="submit">Complete Enterprise Registration</button>
            <div class="text-center mt-3">
                <p class="text-muted fw-medium mb-0">Already have an account? <a href="{{ route('login') }}" class="fw-bold text-decoration-none ms-1">Sign In Here</a></p>
            </div>
        </div>
    </form>

    <style>
        .ls-wide { letter-spacing: 0.05em; }
        .btn-check:checked + .btn-outline-light {
            background: var(--primary-soft) !important;
            color: #fff !important;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
        }
    </style>
@endsection
