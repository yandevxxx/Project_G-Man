@extends('partials.app')

@section('content')
    <div class="mb-5">
        <a href="{{ route('products.index') }}"
            class="btn btn-link text-decoration-none p-0 mb-3 small fw-bold text-primary transition-all hover-translate-x">
            <i class="fas fa-arrow-left me-1"></i> Back to Products
        </a>
        <div class="d-flex align-items-center">
            <div class="bg-primary-soft p-3 rounded-4 me-3 shadow-sm">
                <i class="fas fa-edit fs-3 text-primary"></i>
            </div>
            <div>
                <h2 class="h3 mb-1 fw-800 tracking-tight text-slate-900">Edit Product</h2>
                <p class="text-muted fw-500 mb-0">Update information for: <strong class="text-slate-900">{{ $product->name }}</strong></p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5 pt-4">
                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Product Name</label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                        class="fas fa-box"></i></span>
                                <input type="text"
                                    class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="category_id"
                                    class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Category</label>
                                <div class="input-group">
                                    <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                            class="fas fa-tags"></i></span>
                                    <select
                                        class="form-select py-3 px-4 border-start-0 rounded-end-4 @error('category_id') is-invalid @enderror"
                                        id="category_id" name="category_id" required>
                                        <option value="" disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="supplier_id"
                                    class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Supplier <span
                                        class="text-lowercase fw-normal">(optional)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                            class="fas fa-truck"></i></span>
                                    <select
                                        class="form-select py-3 px-4 border-start-0 rounded-end-4 @error('supplier_id') is-invalid @enderror"
                                        id="supplier_id" name="supplier_id">
                                        <option value="">No Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="stock"
                                    class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Stock</label>
                                <div class="input-group">
                                    <span class="input-group-text px-3 border-end-0 rounded-start-4"><i
                                            class="fas fa-cubes"></i></span>
                                    <input type="number"
                                        class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('stock') is-invalid @enderror"
                                        id="stock" name="stock" value="{{ old('stock', $product->stock) }}"
                                        min="0" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="price"
                                    class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Price
                                    (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text px-3 border-end-0 rounded-start-4 fw-bold">Rp</span>
                                    <input type="number"
                                        class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price', $product->price) }}"
                                        min="0" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label small fw-800 text-uppercase ls-wide text-muted mb-2">Product Image</label>
                            
                            @if($product->image)
                                <div class="mb-3">
                                    <div class="position-relative d-inline-block p-2 bg-light rounded-4 border border-dashed">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                            class="rounded-3 shadow-sm" style="width: 180px; height: 180px; object-fit: cover;">
                                        <div class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary border border-white shadow-sm px-3 py-2">
                                            Current Image
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4"><i class="fas fa-image opacity-50"></i></span>
                                <input type="file" class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('image') is-invalid @enderror" 
                                    id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text small text-muted mt-1 ms-1">Recommended: Square image, max 2MB (JPEG, PNG). Leave empty to keep current.</div>
                        </div>

                        <div class="mb-5">
                            <label for="description"
                                class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Description <span
                                    class="text-lowercase fw-normal">(optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text px-3 border-end-0 rounded-start-4 align-items-start pt-3"><i
                                        class="fas fa-align-left"></i></span>
                                <textarea class="form-control py-3 px-4 border-start-0 rounded-end-4 @error('description') is-invalid @enderror"
                                    id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-premium btn-lg px-5 py-3 shadow-lg">
                                <i class="fas fa-save me-2"></i> Update Product
                            </button>
                            <a href="{{ route('products.index') }}"
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
