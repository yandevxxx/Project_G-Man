@extends('partials.app')

@section('css')
<style>
    .ls-wide { letter-spacing: 0.05em; }
    .input-group-text { border: none; background-color: #f8fafc; color: #64748b; }
    .form-control { border: 1px solid #e2e8f0; }
    .form-control:focus { box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); border-color: #6366f1; }
</style>
@endsection

@section('content')
<div class="mb-5">
    <a href="{{ route('categories.index') }}" class="btn btn-link text-decoration-none p-0 mb-3 small fw-bold text-primary transition-all hover-translate-x">
        <i class="fas fa-arrow-left me-1"></i> Back to Categories
    </a>
    <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 p-3 rounded-4 me-3 shadow-sm text-primary">
            <i class="fas fa-edit fs-3"></i>
        </div>
        <div>
            <h2 class="h3 mb-1 fw-bold tracking-tight">Edit Category</h2>
            <p class="text-muted small mb-0">Update information for category: <strong class="text-dark">{{ $category->name }}</strong></p>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Category Name</label>
                        <div class="input-group">
                            <span class="input-group-text px-3 border-end-0 rounded-start-4"><i class="fas fa-tag"></i></span>
                            <input type="text" class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="e.g. Electronics, Raw Materials..." required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-premium btn-lg px-5 py-3 shadow-lg">
                            <i class="fas fa-save me-2"></i> Update Category
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-light btn-lg px-4 py-3 text-muted fw-bold border-0 shadow-sm rounded-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-translate-x:hover { transform: translateX(-5px); }
    .border-dashed { border: 2px dashed rgba(99, 102, 241, 0.2); }
    .tracking-tight { letter-spacing: -0.02em; }
</style>
@endsection
