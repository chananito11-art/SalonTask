@extends('layouts.app')

@section('title', 'Process Payment')

@section('content')
<div class="payment-page">
    <div class="page-title">Process Payment</div>

    <div class="payment-panel">
        <form method="POST" action="{{ route('payments.store') }}">
            @csrf
            <div class="mb-4">
                <label for="appointment_id" class="form-label">Appointment</label>
                <select class="form-select" id="appointment_id" name="appointment_id" required>
                    <option value="">Select an appointment</option>
                    @foreach ($appointments as $appointment)
                        <option value="{{ $appointment->id }}" @selected(old('appointment_id') == $appointment->id)>
                            {{ $appointment->customer_name }} - {{ $appointment->service->name }} - {{ $appointment->date->format('M d, Y h:i A') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label for="amount" class="form-label">Amount (₱)</label>
                    <input type="number" step="0.01" class="form-control dark-field" id="amount" name="amount" value="{{ old('amount') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select dark-field" id="status" name="status" required>
                        <option value="paid" @selected(old('status', 'paid') === 'paid')>Paid</option>
                        <option value="unpaid" @selected(old('status') === 'unpaid')>Unpaid</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label for="reference" class="form-label">Reference</label>
                <input type="text" class="form-control dark-field" id="reference" name="reference" value="{{ old('reference') }}" placeholder="Enter payment reference">
            </div>

            <div class="d-flex align-items-center gap-3 mt-4">
                <button type="submit" class="btn btn-primary">Save Payment</button>
                <a href="{{ route('payments.index') }}" class="btn-link">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
