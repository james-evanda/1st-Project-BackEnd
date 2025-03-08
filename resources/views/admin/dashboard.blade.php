@extends('products.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Manage Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->quantity }}</td>
                <td><img src="{{ asset('storage/' . $product->photo) }}" width="100"></td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
            