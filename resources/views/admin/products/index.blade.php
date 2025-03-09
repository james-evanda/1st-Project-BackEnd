@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Product List</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">Add New Product</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($product->photo)
                        <img src="{{ asset('storage/' . $product->photo) }}" width="50" height="50" alt="{{ $product->name }}">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
