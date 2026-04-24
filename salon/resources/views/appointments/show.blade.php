@extends('layouts.app')

@section('title', 'Appointment Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Appointment Details</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Customer</dt>
                    <dd class="col-sm-8">{{ $appointment->customer_name }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $appointment->customer_email }}</dd>

                    <dt class="col-sm-4">Phone</dt>
                    <dd class="col-sm-8">{{ $appointment->customer_phone }}</dd>

                    <dt class="col-sm-4">Service</dt>
                    <dd class="col-sm-8">{{ $appointment->service->name }}</dd>

                    <dt class="col-sm-4">Date</dt>
                    <dd class="col-sm-8">{{ $appointment->date->format('M d, Y') }}</dd>

                    <dt class="col-sm-4">Time</dt>
                    <dd class="col-sm-8">{{ $appointment->time }}</dd>

                    <dt class="col-sm-4">Price</dt>
                    <dd class="col-sm-8">₱{{ number_format($appointment->total_price, 2) }}</dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">{{ ucfirst($appointment->status) }}</dd>
                </dl>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
