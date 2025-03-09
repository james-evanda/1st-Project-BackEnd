@extends('user.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Product Catalog</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="card-text">Quantity: {{ $product->quantity }}</p>

                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}" class="form-control mb-2">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <a href="{{ route('user.invoices.index') }}" class="btn btn-secondary mt-4">Go to Cart</a>
</div>
@endsection
