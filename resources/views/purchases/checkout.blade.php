@extends('partials.app')

@section('content')
    <div class="mb-5">
        <a href="{{ route('purchases.catalog') }}"
            class="btn btn-link text-decoration-none p-0 mb-4 small fw-bold text-primary transition-all hover-translate-x">
            <i class="fas fa-arrow-left me-1"></i> Cancel & Return to Shop
        </a>

        <h2 class="h3 mb-4 fw-bold tracking-tight">Checkout</h2>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-header bg-white border-0 py-3 px-4">
                        <h5 class="fw-bold mb-0 text-dark">Order Confirmation</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block mb-3">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                    class="rounded-4 shadow-lg border-4 border-white"
                                    style="width: 160px; height: 160px; object-fit: cover;">
                            </div>
                            <h4 class="fw-bold text-dark">{{ $product->name }}</h4>
                            <p class="text-muted small mb-0">{{ $product->category->name }}</p>
                        </div>

                        <div class="alert alert-info border-0 shadow-sm rounded-4 mb-4 small">
                            <h6 class="fw-800 mb-1"><i class="fas fa-university me-2"></i> Payment Instructions</h6>
                            <p class="mb-0">Please transfer the total amount to: <br>
                                <strong>Bank: 123-456-7890 (G-MAN Store)</strong><br>
                                Upload your transfer receipt below to proceed.
                            </p>
                        </div>

                        <form action="{{ route('purchases.process_checkout') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="mb-4">
                                <label for="quantity"
                                    class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Quantity</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-light border text-muted" type="button"
                                        onclick="updateQuantity(-1)"><i class="fas fa-minus"></i></button>
                                    <input type="number"
                                        class="form-control text-center bg-white border-start-0 border-end-0" id="quantity"
                                        name="quantity" value="1" min="1" max="{{ $product->stock }}" readonly>
                                    <button class="btn btn-outline-light border text-muted" type="button"
                                        onclick="updateQuantity(1)"><i class="fas fa-plus"></i></button>
                                </div>
                                <div class="form-text text-muted text-center mt-2">Available Stock: {{ $product->stock }}
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="payment_proof"
                                    class="form-label small fw-bold text-uppercase ls-wide text-muted mb-2">Payment Proof
                                    (Image)</label>
                                <input type="file" class="form-control @error('payment_proof') is-invalid @enderror"
                                    id="payment_proof" name="payment_proof" accept="image/*" required>
                                @error('payment_proof')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text small opacity-75">Upload receipt/screenshoot of your transfer (Max
                                    2MB).</div>
                            </div>

                            <div class="d-flex justify-content-between mb-3 py-3 border-top border-bottom">
                                <span class="fw-bold text-muted">Price per unit</span>
                                <span class="fw-bold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="h5 fw-bold mb-0">Total to Pay</span>
                                <span class="h5 fw-bold mb-0 text-primary" id="total-display">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg py-3 rounded-4 shadow-sm fw-bold">
                                    Submit Request & Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const price = {{ $product->price }};
        const maxStock = {{ $product->stock }};

        function updateQuantity(change) {
            const input = document.getElementById('quantity');
            const display = document.getElementById('total-display');
            let newVal = parseInt(input.value) + change;

            if (newVal >= 1 && newVal <= maxStock) {
                input.value = newVal;
                const total = price * newVal;
                display.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            }
        }
    </script>
@endsection
