@extends('partials.app')

@section('content')
    <div class="row g-4 mb-5">
        <div class="col-12">
            <div class="card border-0 bg-premium text-white overflow-hidden p-2 shadow-premium">
                <div
                    class="card-body p-4 p-md-5 d-flex flex-column flex-md-row align-items-center justify-content-between position-relative">
                    <div class="position-relative z-1 mb-4 mb-md-0 text-center text-md-start">
                        <h1 class="display-6 fw-bold mb-2 tracking-tighter">Hello, {{ Auth::user()->name }}! 👋</h1>
                        <p class="mb-4 opacity-75 fw-medium fs-5">Welcome back to the G-MAN operational control.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .shadow-premium {
            box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.2), 0 10px 10px -5px rgba(99, 102, 241, 0.1) !important;
        }

        .btn-white-glass {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            transition: all 0.2s ease;
        }

        .btn-white-glass:hover {
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
        }

        .btn-white-soft {
            background: #fff;
            color: var(--primary-soft);
            border: none;
            transition: all 0.2s ease;
        }

        .btn-white-soft:hover {
            background: #f8fafc;
            transform: translateY(-2px);
        }

        .fa-15x {
            font-size: 15rem;
        }

        .bg-indigo-soft {
            background: rgba(79, 70, 229, 0.1);
        }

        .text-indigo {
            color: #4f46e5;
        }

        .bg-indigo {
            background: #4f46e5;
        }

        .bg-teal-soft {
            background: rgba(20, 184, 166, 0.1);
        }

        .text-teal {
            color: #14b8a6;
        }

        .bg-teal {
            background: #14b8a6;
        }

        .bg-rose-soft {
            background: rgba(244, 63, 94, 0.1);
        }

        .text-rose {
            color: #f43f5e;
        }

        .bg-rose {
            background: #f43f5e;
        }

        .bg-amber-soft {
            background: rgba(245, 158, 11, 0.1);
        }

        .text-amber {
            color: #f59e0b;
        }

        .bg-amber {
            background: #f59e0b;
        }

        .stats-card {
            border-radius: 1.5rem !important;
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endsection
