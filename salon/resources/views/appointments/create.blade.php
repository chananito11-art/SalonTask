@extends('layouts.app')

@section('title', 'Create Appointment')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Create New Appointment</div>
            <div class="card-body">
                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customer_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="customer_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="service_id" class="form-label">Service</label>
                        <select class="form-select" id="service_id" name="service_id" required>
                            <option value="">Select a service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>
                                    {{ $service->name }} - ₱{{ number_format($service->price, 2) }} ({{ $service->duration }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="time" class="form-label">Time</label>
                            <input type="time" class="form-control" id="time" name="time" value="{{ old('time') }}" required>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Appointment</button>
                        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
