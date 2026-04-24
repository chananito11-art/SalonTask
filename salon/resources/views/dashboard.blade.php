@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="hero-section">
    <h1>Salon Dashboard</h1>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="dashboard-card">
            <h3>{{ $serviceCount }}</h3>
            <p class="mb-0">Services</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card secondary">
            <h3>{{ $appointmentCount }}</h3>
            <p class="mb-0">Appointments</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card accent">
            <h3>{{ $paymentCount }}</h3>
            <p class="mb-0">Payments</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <h3>{{ $paidPaymentCount }}</h3>
            <p class="mb-0">Paid Transactions</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">Quick Actions</div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('services.create') }}" class="btn btn-primary">Add New Service</a>
                    <a href="{{ route('appointments.create') }}" class="btn btn-secondary">Create Appointment</a>
                    <a href="{{ route('payments.create') }}" class="btn btn-warning">Process Payment</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">Recent Appointments</div>
            <div class="card-body">
                @forelse ($recentAppointments as $appointment)
                    <div class="border-bottom py-2">
                        <strong>{{ $appointment->customer_name }}</strong>
                        <div class="text-muted small">
                            {{ $appointment->service->name }} | {{ $appointment->date->format('M d, Y') }} at {{ $appointment->time }}
                        </div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No appointments yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Recent Payments</div>
            <div class="card-body table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentPayments as $payment)
                            <tr>
                                <td>{{ $payment->appointment->customer_name }}</td>
                                <td>{{ $payment->appointment->service->name }}</td>
                                <td>₱{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ ucfirst($payment->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">No payments recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
