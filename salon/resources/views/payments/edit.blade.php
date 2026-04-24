@extends('layouts.app')

@section('title', 'Edit Payment')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Edit Payment</div>
            <div class="card-body">
                <form method="POST" action="{{ route('payments.update', $payment) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Appointment</label>
                        <div class="form-control-plaintext">
                            {{ $payment->appointment->customer_name }} - {{ $payment->appointment->service->name }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <div class="form-control-plaintext">
                            ₱{{ number_format($payment->amount, 2) }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="reference" class="form-label">Reference</label>
                        <input type="text" class="form-control" id="reference" name="reference" value="{{ old('reference', $payment->reference) }}">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="paid" @selected(old('status', $payment->status) === 'paid')>Paid</option>
                            <option value="unpaid" @selected(old('status', $payment->status) === 'unpaid')>Unpaid</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Payment</button>
                        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
