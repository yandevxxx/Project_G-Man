<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-Man | Warehouse Management</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .bg-primary { background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important; }
        .topbar { height: 70px; background: #fff; border-bottom: 1px solid #dee2e6; display: flex; align-items: center; justify-content: space-between; padding: 0 1.5rem; position: sticky; top: 0; z-index: 999; }
        #sidebar-wrapper { width: 250px; min-height: 100vh; transition: margin 0.25s ease-out; }
        #page-content-wrapper { min-width: 0; width: 100%; }
        @media (max-width: 992px) {
            #sidebar-wrapper { margin-left: -250px; position: fixed; z-index: 1000; }
            #sidebar-wrapper.active { margin-left: 0; }
        }
    </style>
    @yield('css')
</head>
<body>
    @auth
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-primary" id="sidebar-wrapper">
                @include('partials.sidebar')
            </div>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                @include('partials.navbar')

                <div class="container-fluid p-4">
                    @yield('content')
                    @include('partials.footer')
                </div>
            </div>
        </div>
    @else
        <div class="vw-100 vh-100 d-flex align-items-center justify-content-center bg-light p-3">
            <div class="card border-0 shadow-sm" style="width: 100%; max-width: @yield('auth_width', '400px');">
                <div class="card-body p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    @endauth

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.querySelector('[data-bs-toggle="sidebar"]');
            if (toggle) {
                toggle.addEventListener('click', function() {
                    document.getElementById('sidebar-wrapper').classList.toggle('active');
                });
            }
        });
    </script>
    @yield('js')
</body>
</html>

</html>
