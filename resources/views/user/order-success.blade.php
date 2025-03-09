@extends('user.layouts.app')

@section('content')
<div class="container text-center">
    <h2 class="my-4">Order Successful!</h2>
    <p>Your order has been placed successfully.</p>
    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Continue Shopping</a>
</div>
@endsection
