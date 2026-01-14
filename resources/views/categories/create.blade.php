@extends('partials.app')

@section('content')
    <div class="mb-5">
        <a href="{{ route('categories.index') }}"
            class="btn btn-link text-decoration-none p-0 mb-3 small fw-bold text-primary transition-all hover-translate-x">
            <i class="fas fa-arrow-left me-1"></i> Back to Categories
        </a>
        <div class="d-flex align-items-center">
            <div class="bg-primary-soft p-3 rounded-4 me-3 shadow-sm">
                <i class="fas fa-plus-circle fs-3 text-primary"></i>
            </div>
            <div>
                <h2 class="h3 mb-1 fw-800 tracking-tight text-slate-900">Add New Category</h2>
                <p class="text-muted fw-500 mb-0">Create a new classification for your inventory items.</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Category
                                Name</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                        class="fas fa-tag"></i></span>
                                <input type="text"
                                    class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="e.g. Electronics, Raw Materials..." required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-premium btn-lg px-5 py-3 shadow-lg">
                                <i class="fas fa-save me-2"></i> Create Category
                            </button>
                            <a href="{{ route('categories.index') }}"
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

        .border-dashed {
            border: 2px dashed rgba(99, 102, 241, 0.2);
        }

        .tracking-tight {
            letter-spacing: -0.02em;
        }
    </style>
@endsection
