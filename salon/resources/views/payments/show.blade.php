@extends('layouts.app')

@section('title', 'Payment Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Payment Details</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Customer</dt>
                    <dd class="col-sm-8">{{ $payment->appointment->customer_name }}</dd>

                    <dt class="col-sm-4">Service</dt>
                    <dd class="col-sm-8">{{ $payment->appointment->service->name }}</dd>

                    <dt class="col-sm-4">Amount</dt>
                    <dd class="col-sm-8">₱{{ number_format($payment->amount, 2) }}</dd>

                    <dt class="col-sm-4">Reference</dt>
                    <dd class="col-sm-8">{{ $payment->reference ?: 'N/A' }}</dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">{{ ucfirst($payment->status) }}</dd>

                    <dt class="col-sm-4">Payment Date</dt>
                    <dd class="col-sm-8">{{ $payment->payment_date ? $payment->payment_date->format('M d, Y h:i A') : 'N/A' }}</dd>
                </dl>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('payments.edit', $payment) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
