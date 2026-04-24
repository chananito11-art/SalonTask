@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Appointments</h1>
        <p class="text-muted mb-0">Create and manage customer bookings.</p>
    </div>
    <a href="{{ route('appointments.create') }}" class="btn btn-primary">Create Appointment</a>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $appointment)
                    <tr>
                        <td>
                            <strong>{{ $appointment->customer_name }}</strong>
                            <div class="text-muted small">{{ $appointment->customer_email }}</div>
                            <div class="text-muted small">{{ $appointment->customer_phone }}</div>
                        </td>
                        <td>{{ $appointment->service->name }}</td>
                        <td>{{ $appointment->date->format('M d, Y') }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>₱{{ number_format($appointment->total_price, 2) }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        <td>
                            @if ($appointment->payment)
                                {{ ucfirst($appointment->payment->status) }}
                            @else
                                Unpaid
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="{{ route('appointments.destroy', $appointment) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this appointment?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-muted">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
