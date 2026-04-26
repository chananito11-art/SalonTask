@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h2>Create Booking</h2>
        </div>
    </section>

    <section class="panel">
        @if ($services->isEmpty())
            <div class="empty">
                Add at least one service before creating a booking.
                <div class="actions" style="justify-content: center; margin-top: 16px;">
                    <a class="btn" href="{{ route('services.create') }}">Add Service</a>
                </div>
            </div>
        @else
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div>
                        <label for="customer_name">Customer Name</label>
                        <input id="customer_name" type="text" name="customer_name" value="{{ old('customer_name') }}" required>
                    </div>

                    <div>
                        <label for="customer_contact">Contact Information</label>
                        <input id="customer_contact" type="text" name="customer_contact" value="{{ old('customer_contact') }}" required>
                    </div>

                    <div>
                        <label for="service_id">Service</label>
                        <select id="service_id" name="service_id" required>
                            <option value="">Select a service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>
                                    {{ $service->name }} - PHP {{ number_format($service->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="appointment_date">Appointment Date</label>
                        <input id="appointment_date" type="date" name="appointment_date" value="{{ old('appointment_date') }}" required>
                    </div>

                    <div>
                        <label for="appointment_time">Appointment Time</label>
                        <input id="appointment_time" type="time" name="appointment_time" value="{{ old('appointment_time') }}" required>
                    </div>
                </div>

                <div class="actions" style="margin-top: 18px;">
                    <button class="btn" type="submit">Save Booking</button>
                    <a class="btn btn-secondary" href="{{ route('appointments.index') }}">Cancel</a>
                </div>
            </form>
        @endif
    </section>
@endsection
