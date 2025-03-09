@extends('user.layouts.app')

@section('content')
<div class="container">
    <h1>Your Invoices</h1>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Invoice Number</th>
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
                <td>Rp. {{ number_format($invoice->total_price, 0, ',', '.') }}</td>
                <td>
                    <span class="badge bg-{{ $invoice->status == 'Paid' ? 'success' : 'warning' }}">
                        {{ $invoice->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('user.invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
