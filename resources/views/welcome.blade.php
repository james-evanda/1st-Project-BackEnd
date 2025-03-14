<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Chipichapa') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Chipichapa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        @if(auth()->user()->role === 'admin')
                            <!-- Admin: Manage Products -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="manageProductsDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Manage Products
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('admin/products/create') }}">Create Product</a></li>
                                    <li><a class="dropdown-item" href="{{ url('admin/products') }}">View Products</a></li>
                                </ul>
                            </li>

                            <!-- Admin: Manage Invoices -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="manageInvoicesDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Manage Invoices
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('admin/invoices') }}">View Invoices</a></li>
                                </ul>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout ({{ auth()->user()->name }})
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="container text-center mt-5">
            <h1 class="display-4">Welcome to Chipichapa</h1>
            <p class="lead">Your ultimate platform for managing products and invoices.</p>
        
            <div class="mt-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Register</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
