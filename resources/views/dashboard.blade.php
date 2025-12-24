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

    <!-- Stats -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted small text-uppercase fw-bold">Total Items</h6>
                <div class="d-flex align-items-center">
                    <h2 class="fw-bold mb-0 me-3">1,250</h2>
                    <span class="badge bg-primary">Stocks</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted small text-uppercase fw-bold">Stock In (Today)</h6>
                <div class="d-flex align-items-center">
                    <h2 class="fw-bold mb-0 me-3">45</h2>
                    <span class="badge bg-success">+12%</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted small text-uppercase fw-bold">Stock Out (Today)</h6>
                <div class="d-flex align-items-center">
                    <h2 class="fw-bold mb-0 me-3">12</h2>
                    <span class="badge bg-danger">-5%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Recent Activities</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="small text-uppercase fw-bold">
                                <th class="px-3">Type</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th class="text-end px-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-3"><span class="badge bg-success">IN</span></td>
                                <td>Macbook Air M2</td>
                                <td>5 units</td>
                                <td class="text-end px-3 text-muted small">Done</td>
                            </tr>
                            <tr>
                                <td class="px-3"><span class="badge bg-danger">OUT</span></td>
                                <td>iPhone 15 Pro</td>
                                <td>2 units</td>
                                <td class="text-end px-3 text-muted small">Done</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100 bg-dark text-white">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Quick Actions</h6>
                <div class="list-group list-group-flush border-0 rounded">
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">
                        <i class="fas fa-plus me-2 text-primary"></i> Add Item
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 px-0">
                        <i class="fas fa-file-alt me-2 text-success"></i> Generate Report
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

