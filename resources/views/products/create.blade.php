@extends('partials.app')

@section('css')
<style>
    .ls-wide { letter-spacing: 0.05em; }
    .form-floating > label { padding-left: 3rem; }
    .input-group-text { border: none; background-color: #f8fafc; color: #64748b; }
    .form-control, .form-select { border: 1px solid #e2e8f0; }
    .form-control:focus, .form-select:focus { box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); border-color: #6366f1; }
</style>
@endsection

@section('content')
<div class="mb-5">
    <a href="{{ route('products.index') }}" class="btn btn-link text-decoration-none p-0 mb-3 small fw-bold text-primary transition-all hover-translate-x">
        <i class="fas fa-arrow-left me-1"></i> Back to Products
    </a>
    <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 p-3 rounded-4 me-3 shadow-sm text-primary">
            <i class="fas fa-plus-circle fs-3"></i>
        </div>
        <div>
            <h2 class="h3 mb-1 fw-bold tracking-tight">Add New Product</h2>
            <p class="text-muted small mb-0">Add a new item to your inventory.</p>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Product Name</label>
                        <div class="input-group">
                            <span class="input-group-text px-3 border-end-0 rounded-start-4"><i class="fas fa-box"></i></span>
                            <input type="text" class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Wireless Mouse" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Category</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i class="fas fa-tags"></i></span>
                                <select class="form-select py-3 px-4 border-start-0 rounded-end-4 @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="stock" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Stock</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i class="fas fa-cubes"></i></span>
                                <input type="number" class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" placeholder="0" min="0" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Price (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text px-3 border-end-0 rounded-start-4 fw-bold">Rp</span>
                            <input type="number" class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="0" min="0" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Description <span class="text-lowercase fw-normal">(optional)</span></label>
                        <div class="input-group">
                            <span class="input-group-text px-3 border-end-0 rounded-start-4 align-items-start pt-3"><i class="fas fa-align-left"></i></span>
                            <textarea class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Product details...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-premium btn-lg px-5 py-3 shadow-lg">
                            <i class="fas fa-save me-2"></i> Save Product
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-4 py-3 text-muted fw-bold border-0 shadow-sm rounded-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
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
