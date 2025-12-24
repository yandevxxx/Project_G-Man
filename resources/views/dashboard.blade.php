@extends('partials.app')

@section('content')
<div class="row g-3">
    <!-- Welcome -->
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-1 text-primary">Warehouse Dashboard</h4>
                <p class="text-muted mb-0">Logged in as <strong>{{ Auth::user()->name }}</strong></p>
            </div>
        </div>
    </div>
</div>
@endsection

