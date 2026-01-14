@extends('partials.app')

@section('content')
    <div class="mb-5">
        <a href="{{ route('suppliers.index') }}"
            class="btn btn-link text-decoration-none p-0 mb-3 small fw-bold text-primary transition-all hover-translate-x">
            <i class="fas fa-arrow-left me-1"></i> Back to Suppliers
        </a>
        <div class="d-flex align-items-center">
            <div class="bg-primary-soft p-3 rounded-4 me-3 shadow-sm">
                <i class="fas fa-truck fs-3 text-primary"></i>
            </div>
            <div>
                <h2 class="h3 mb-1 fw-800 tracking-tight text-slate-900">Add New Supplier</h2>
                <p class="text-muted fw-500 mb-0">Partner with a new supplier for your inventory needs.</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('suppliers.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Supplier Name
                                *</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                        class="fas fa-building"></i></span>
                                <input type="text"
                                    class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="e.g. PT. Supplier Indonesia" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="contact_person"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Contact
                                Person</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                        class="fas fa-user"></i></span>
                                <input type="text"
                                    class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('contact_person') is-invalid @enderror"
                                    id="contact_person" name="contact_person" value="{{ old('contact_person') }}"
                                    placeholder="e.g. John Doe">
                                @error('contact_person')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="phone"
                                    class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Phone
                                    Number</label>
                                <div class="input-group">
                                    <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                            class="fas fa-phone"></i></span>
                                    <input type="text"
                                        class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone') }}"
                                        placeholder="+62 812 3456 7890">
                                    @error('phone')
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
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="supplier@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="address"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Address</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4 align-items-start pt-3"><i
                                        class="fas fa-map-marker-alt"></i></span>
                                <textarea class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('address') is-invalid @enderror"
                                    id="address" name="address" rows="3" placeholder="Enter full address">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-premium btn-lg px-5 py-3 shadow-lg">
                                <i class="fas fa-save me-2"></i> Create Supplier
                            </button>
                            <a href="{{ route('suppliers.index') }}"
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
