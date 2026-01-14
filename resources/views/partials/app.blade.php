<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-Man | Professional Warehouse Management</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --primary-soft: #6366f1;
            --primary-deep: #4f46e5;
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            --accent-color: #06b6d4;
            --accent-gradient: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            --sidebar-width: 280px;
            --topbar-height: 75px;
            --bg-body: #f8fafc;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.01);
            --premium-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-blur: blur(16px);
            --input-bg: rgba(241, 245, 249, 0.6);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: #1e293b;
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }

        .bg-premium {
            background: var(--primary-gradient) !important;
        }

        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar-wrapper {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1000;
            background: #0f172a;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        #page-content-wrapper {
            width: 100%;
            min-height: 100vh;
            background-color: var(--bg-body);
        }

        .topbar {
            height: var(--topbar-height);
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        /* Sidebar Responsive */
        @media (max-width: 1199.98px) {
            #sidebar-wrapper {
                margin-left: calc(-1 * var(--sidebar-width));
                position: fixed;
            }
            #sidebar-wrapper.active {
                margin-left: 0;
            }
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: var(--card-shadow);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            background: #fff;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--premium-shadow);
        }

        /* Auth Layout */
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0f172a; /* Deep Neutral Dark Slate */
            padding: 2rem;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        /* Clean, No-Pattern Background */
        .auth-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            z-index: -1;
        }

        /* Ambient Neutral Glow */
        .auth-container::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(99, 102, 241, 0.05) 0%, transparent 50%);
            z-index: -1;
            pointer-events: none;
        }

        /* Remove the old blobs */
        .blob { display: none; }

        @keyframes move {
            0% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(100px, 150px) scale(1.1); }
            66% { transform: translate(-50px, 100px) scale(0.9); }
            100% { transform: translate(50px, -50px) scale(1.05); }
        }

        .auth-card {
            border: 1px solid rgba(99, 102, 241, 0.15);
            border-radius: 3rem;
            box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 0.6);
            width: 100%;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            z-index: 10;
            overflow: hidden;
            animation: fadeInScale 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 60px 120px -30px rgba(0, 0, 0, 0.7);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-soft), var(--accent-color));
            z-index: 11;
            transition: height 0.3s ease;
        }

        .auth-card:hover::before {
            height: 6px;
        }

        .auth-card .card-body {
            padding: 3.5rem !important;
        }

        @media (max-width: 575.98px) {
            .auth-card .card-body {
                padding: 2.25rem 1.5rem !important;
            }
        }

        @keyframes move {
            0% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(100px, 150px) scale(1.1); }
            66% { transform: translate(-50px, 100px) scale(0.9); }
            100% { transform: translate(50px, -50px) scale(1.05); }
        }

        @keyframes fadeInScale {
            0% { opacity: 0; transform: scale(0.95) translateY(10px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--primary-soft) 0%, var(--accent-color) 100%);
            color: #fff;
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 1rem;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            letter-spacing: 0.02em;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px -6px rgba(99, 102, 241, 0.4);
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -6px rgba(79, 70, 229, 0.5);
            color: #fff;
        }

        .btn-premium:active {
            transform: translateY(1px);
        }

        .btn-premium::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-premium:hover::after {
            left: 100%;
        }

        /* Form Controls */
        .form-control, .form-select {
            font-family: 'Plus Jakarta Sans', sans-serif;
            border: 2px solid transparent;
            border-radius: 0.85rem;
            padding: 0.75rem 1.15rem;
            transition: all 0.3s ease;
            background-color: var(--input-bg);
            font-size: 0.95rem;
            color: #1e293b;
            font-weight: 500;
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: var(--primary-soft);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            color: #0f172a;
        }

        .input-group {
            background-color: var(--input-bg);
            border-radius: 0.85rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .input-group:hover {
            background-color: rgba(255, 255, 255, 0.8);
            border-color: rgba(99, 102, 241, 0.1);
        }

        .input-group:focus-within {
            background-color: #fff;
            border-color: var(--primary-soft);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
            transform: scale(1.01);
        }

        .input-group:focus-within .input-group-text {
            color: var(--primary-soft);
        }

        .input-group .form-control {
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        .input-group-text {
            background-color: transparent;
            border: none;
            color: #64748b;
            padding-left: 1.15rem;
            font-size: 0.9rem;
        }

        .auth-logo {
            width: 120px;
            height: auto;
            margin-bottom: 2rem;
        }

        .text-primary-gradient {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        /* Global Polish Utilities */
        .glass-input {
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 100px !important;
            padding-left: 3rem !important;
            transition: all 0.3s ease;
        }

        .glass-input:focus {
            background: #fff !important;
            border-color: var(--primary-soft) !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
        }

        .soft-badge {
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 100px;
            font-size: 0.75rem;
            letter-spacing: 0.025em;
        }

        .bg-primary-soft { background: rgba(99, 102, 241, 0.1) !important; color: #6366f1 !important; }
        .bg-success-soft { background: rgba(16, 185, 129, 0.1) !important; color: #10b981 !important; }
        .bg-danger-soft { background: rgba(239, 68, 68, 0.1) !important; color: #ef4444 !important; }
        .bg-warning-soft { background: rgba(245, 158, 11, 0.1) !important; color: #f59e0b !important; }
        .bg-info-soft { background: rgba(6, 182, 212, 0.1) !important; color: #06b6d4 !important; }

        .hover-translate-y {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .hover-translate-y:hover {
            transform: translateY(-4px);
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            color: #cbd5e1;
            font-size: 2rem;
        }
    </style>
    @yield('css')
</head>
<body>
    @auth
        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                @include('partials.sidebar')
            </div>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                @include('partials.navbar')

                <div class="container-fluid p-4 p-md-5">
                    @yield('content')
                    <div class="mt-5 pt-4">
                        @include('partials.footer')
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="auth-container">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
            <div class="blob blob-4"></div>
            
            <div class="card auth-card shadow-2xl" style="max-width: @yield('auth_width', '450px');">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('[data-bs-toggle="sidebar"]');
            const sidebar = document.getElementById('sidebar-wrapper');

            toggleButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            });
        });
    </script>
    @yield('js')
</body>
</html>
