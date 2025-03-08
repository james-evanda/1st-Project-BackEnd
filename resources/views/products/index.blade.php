@extends('products.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Product Catalog</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="card-text">Stock: {{ $product->quantity }}</p>
                    <button class="btn btn-primary">Add to Cart</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection