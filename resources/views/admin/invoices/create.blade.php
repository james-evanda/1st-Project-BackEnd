@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Create Invoice</h1>

    <form action="{{ route('admin.invoices.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Total Price</label>
            <input type="number" name="total_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Pending">Pending</option>
                <option value="Paid">Paid</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create Invoice</button>
    </form>
</div>
@endsection
