@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h2>Appointments</h2>
        </div>

        <a class="btn" href="{{ route('appointments.create') }}">New Booking</a>
    </section>

    <section class="panel">
        @if ($appointments->isEmpty())
            <div class="empty">No appointments have been booked yet.</div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Service</th>
                            <th>Schedule</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->customer_name }}</td>
                                <td>{{ $appointment->customer_contact }}</td>
                                <td>{{ $appointment->service->name }}</td>
                                <td>{{ $appointment->appointment_at->format('M d, Y h:i A') }}</td>
                                <td>PHP {{ number_format($appointment->price, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $appointment->payment_status }}">
                                        {{ ucfirst($appointment->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ route('appointments.show', $appointment) }}">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
