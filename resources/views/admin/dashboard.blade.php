@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Admin Dashboard</h1>

        <div class="row">
            <!-- Total Products -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text display-4">{{ $totalProducts }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text display-4">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Categories</h5>
                        <p class="card-text display-4">{{ $totalCategories }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Invoices -->
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Invoices</h5>
                        <p class="card-text display-4">{{ $totalInvoices }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Sales Revenue -->
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text display-4">Rp. {{ number_format($totalSales, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Manage Products</a>
        <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">Manage Invoices</a>
    </div>
@endsection
