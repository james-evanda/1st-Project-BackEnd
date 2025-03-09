@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Invoices</h1>
    <a href="{{ route('admin.invoices.create') }}" class="btn btn-success mb-3">Create New Invoice</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Invoice Number</th>
                <th>Customer Name</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $invoice->invoice_number }}</td>
                <td>{{ $invoice->customer_name }}</td>
                <td>Rp. {{ number_format($invoice->total_price, 0, ',', '.') }}</td>
                <td>
                    <span class="badge bg-{{ $invoice->status == 'Paid' ? 'success' : 'warning' }}">
                        {{ $invoice->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
