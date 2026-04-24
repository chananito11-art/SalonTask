@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Edit Appointment</div>
            <div class="card-body">
                <form method="POST" action="{{ route('appointments.update', $appointment) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name', $appointment->customer_name) }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customer_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email', $appointment->customer_email) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="customer_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $appointment->customer_phone) }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="service_id" class="form-label">Service</label>
                        <select class="form-select" id="service_id" name="service_id" required>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(old('service_id', $appointment->service_id) == $service->id)>
                                    {{ $service->name }} - ₱{{ number_format($service->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $appointment->date->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="time" class="form-label">Time</label>
                            <input type="time" class="form-control" id="time" name="time" value="{{ old('time', $appointment->time) }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="booked" @selected(old('status', $appointment->status) === 'booked')>Booked</option>
                            <option value="completed" @selected(old('status', $appointment->status) === 'completed')>Completed</option>
                            <option value="cancelled" @selected(old('status', $appointment->status) === 'cancelled')>Cancelled</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Appointment</button>
                        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
