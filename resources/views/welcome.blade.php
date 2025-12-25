<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-MAN | Warehouse Management</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff;
            color: #1a1a1a;
            letter-spacing: -0.01em;
        }
        .hero-section {
            padding: 120px 0;
            background: linear-gradient(135deg, #f8fcfd 0%, #f1f5f9 100%);
        }
        .feature-card {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }
        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }
        .navbar {
            padding: 25px 0;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.75rem;
            color: #4f46e5;
            letter-spacing: -0.05em;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-warehouse me-2"></i>G-MAN
            </a>
            <div class="ms-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary border-2 me-2 rounded-3 px-4 fw-bold">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-dark fw-bold me-3">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary px-4 fw-bold">Get Started</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-4 fw-bold">v2.0 Professional Edition</span>
                    <h1 class="display-3 fw-bold mb-4 tracking-tight">Smart Warehouse <span class="text-primary" style="color: #4f46e5 !important;">Management</span> for Enterprise</h1>
                    <p class="lead text-muted mb-5 px-lg-5">Maximize efficiency for your warehouse inventory management. Control stock, monitor shipments, and optimize operations in one unified platform.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">Start Trial Now</a>
                        <a href="#features" class="btn btn-outline-secondary border-2 btn-lg px-5 rounded-3 fw-bold">Explore Features</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="py-5 my-5">
        <div class="container">
            <div class="text-center mb-5 pb-3">
                <h2 class="fw-bold fs-1 tracking-tight">Core Features</h2>
                <p class="text-muted fw-medium fs-5">Complete solutions for modern warehouse needs</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card p-5 h-100 text-center border-0">
                        <div class="bg-primary bg-opacity-10 p-4 rounded-circle d-inline-block mb-4 mx-auto" style="width: 100px; height: 100px; display: flex !important; align-items: center; justify-content: center;">
                            <i class="fas fa-boxes-stacked fa-2x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Inventory Tracking</h4>
                        <p class="text-muted mb-0">Monitor items in real-time with high-precision tracking systems and automated alerts.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card p-5 h-100 text-center border-0">
                        <div class="bg-success bg-opacity-10 p-4 rounded-circle d-inline-block mb-4 mx-auto" style="width: 100px; height: 100px; display: flex !important; align-items: center; justify-content: center;">
                            <i class="fas fa-truck-fast fa-2x text-success"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Seamless Logistics</h4>
                        <p class="text-muted mb-0">Manage incoming and outgoing shipments with efficient, multi-channel workflows.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card p-5 h-100 text-center border-0">
                        <div class="bg-warning bg-opacity-10 p-4 rounded-circle d-inline-block mb-4 mx-auto" style="width: 100px; height: 100px; display: flex !important; align-items: center; justify-content: center;">
                            <i class="fas fa-chart-pie fa-2x text-warning"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Live Insights</h4>
                        <p class="text-muted mb-0">Gain deep insights into your warehouse performance with powerful, real-time analytics.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-light border-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                    <div class="fw-bold text-primary mb-2">G-MAN Warehouse System</div>
                    <p class="text-muted mb-0">&copy; {{ date('Y') }} G-Man Logistics Global. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="d-flex justify-content-center justify-content-md-end gap-4">
                        <a href="#" class="text-muted text-decoration-none small fw-bold">Documentation</a>
                        <a href="#" class="text-muted text-decoration-none small fw-bold">Privacy Policy</a>
                        <a href="#" class="text-muted text-decoration-none small fw-bold">Support</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
