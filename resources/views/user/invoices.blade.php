@extends('user.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart) || count($cart) == 0)
        <p>Your cart is empty.</p>
        <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Continue Shopping</a>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('user.cart.remove', $id) }}" class="btn btn-danger btn-sm">Remove</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('user.cart.checkout') }}" class="btn btn-success">Checkout</a>
    @endif
</div>
@endsection
