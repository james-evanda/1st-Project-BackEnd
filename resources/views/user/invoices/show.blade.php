@extends('user.layouts.app')

@section('content')
<div class="container">
    <h1>Invoice Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Invoice Number: {{ $invoice->invoice_number }}</h5>
            <p class="card-text"><strong>Total Price:</strong> Rp. {{ number_format($invoice->total_price, 0, ',', '.') }}</p>
            <p class="card-text"><strong>Status:</strong> 
                <span class="badge bg-{{ $invoice->status == 'Paid' ? 'success' : 'warning' }}">
                    {{ $invoice->status }}
                </span>
            </p>

            <a href="{{ route('user.invoices.index') }}" class="btn btn-secondary">Back to Invoices</a>
        </div>
    </div>
</div>
@endsection
