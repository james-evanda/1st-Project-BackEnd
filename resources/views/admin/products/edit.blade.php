@extends('products.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    
        <label for="name">Product Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
    
        <label for="price">Price</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control" required>
    
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control" required>
    
        <button type="submit" class="btn btn-primary mt-3">Update Product</button>
    </form>
</div>
@endsection