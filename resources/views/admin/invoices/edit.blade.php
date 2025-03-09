@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Invoice</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', $invoice->customer_name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Total Price</label>
            <input type="number" name="total_price" class="form-control" value="{{ old('total_price', $invoice->total_price) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Pending" {{ old('status', $invoice->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Paid" {{ old('status', $invoice->status) == 'Paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Invoice</button>
    </form>
</div>
@endsection
