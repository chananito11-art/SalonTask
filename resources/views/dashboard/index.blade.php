@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h2>Dashboard</h2>
        </div>
    </section>

    <section class="grid stats">
        <article class="panel">
            <div class="muted">Total Services</div>
            <div class="stat-value">{{ $serviceCount }}</div>
        </article>

        <article class="panel">
            <div class="muted">Total Appointments</div>
            <div class="stat-value">{{ $appointmentCount }}</div>
        </article>

        <article class="panel">
            <div class="muted">Total Revenue</div>
            <div class="stat-value">PHP {{ number_format($totalRevenue, 2) }}</div>
        </article>

        <article class="panel">
            <div class="muted">Unpaid Bookings</div>
            <div class="stat-value">{{ $unpaidCount }}</div>
        </article>
    </section>

    <section class="grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));">
        <article class="panel">
            <div class="page-head" style="margin-bottom: 12px;">
                <div>
                    <h2 style="font-size: 1.35rem;">Recent Appointments</h2>
                </div>
            </div>

            @if ($recentAppointments->isEmpty())
                <div class="empty">No appointments yet.</div>
            @else
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Service</th>
                                <th>Schedule</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->customer_name }}</td>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td>{{ $appointment->appointment_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $appointment->payment_status }}">
                                            {{ ucfirst($appointment->payment_status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </article>

        <article class="panel">
            <div class="page-head" style="margin-bottom: 12px;">
                <div>
                    <h2 style="font-size: 1.35rem;">Recent Payments</h2>
                </div>
            </div>

            @if ($recentPayments->isEmpty())
                <div class="empty">No payment transactions yet.</div>
            @else
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Service</th>
                                <th>Amount</th>
                                <th>Paid At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentPayments as $payment)
                                <tr>
                                    <td>{{ $payment->appointment->customer_name }}</td>
                                    <td>{{ $payment->appointment->service->name }}</td>
                                    <td>PHP {{ number_format($payment->amount_due, 2) }}</td>
                                    <td>{{ optional($payment->paid_at)->format('M d, Y h:i A') ?? 'Pending' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </article>
    </section>
@endsection
