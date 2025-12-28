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
            --primary-soft: #4f46e5;
            --primary-deep: #4338ca;
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            --sidebar-width: 280px;
            --topbar-height: 75px;
            --bg-body: #f1f5f9;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
            --premium-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.03);
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-blur: blur(12px);
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
            background: #1e293b;
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
            border-radius: 1.25rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            background: #fff;
        }
        .card:hover {
            box-shadow: var(--premium-shadow);
        }

        /* Auth Layout */
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }
        .auth-container::before {
            content: '';
            position: absolute;
            width: 140%;
            height: 140%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 86c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm66-3c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-40-39c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm29 8c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM32 56c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-20-17c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm66-15c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zm-33 10c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zm-23 35c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zm49 17c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zM28 5c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zm67 26c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zM72 10c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zm0 80c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zm35-64c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zm-35 25c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zM18 44c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1zM5 88c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1z' fill='%236366f1' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.5;
            z-index: 0;
        }

        .auth-card {
            border: none;
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            z-index: 10;
        }

        .btn-premium {
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
            color: #fff;
        }

        /* Form Controls */
        .form-control, .form-select {
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-soft);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
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
            <div class="card auth-card" style="max-width: @yield('auth_width', '450px');">
                <div class="card-body p-4 p-md-5">
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
