@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h2>Payment Management</h2>
        </div>
    </section>

    <section class="grid" style="grid-template-columns: minmax(0, 360px) minmax(0, 1fr); align-items: start;">
        <article class="panel">
            <h3 style="margin-top: 0;">Process Payment</h3>

            @if ($unpaidAppointments->isEmpty())
                <div class="empty">All current bookings already have payment records.</div>
            @else
                <form action="{{ route('payments.store') }}" method="POST" class="stack">
                    @csrf

                    <div>
                        <label for="appointment_id">Select Booking</label>
                        <select id="appointment_id" name="appointment_id" required>
                            <option value="">Choose an appointment</option>
                            @foreach ($unpaidAppointments as $appointment)
                                <option value="{{ $appointment->id }}" @selected(old('appointment_id') == $appointment->id)>
                                    {{ $appointment->customer_name }} - {{ $appointment->service->name }} - PHP {{ number_format($appointment->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="amount_paid">Amount Paid</label>
                        <input id="amount_paid" type="number" name="amount_paid" min="0" step="0.01" value="{{ old('amount_paid') }}" required>
                    </div>

                    <button class="btn" type="submit">Record Payment</button>
                </form>
            @endif
        </article>

        <article class="panel">
            <h3 style="margin-top: 0;">Appointment Payment Status</h3>

            @if ($appointments->isEmpty())
                <div class="empty">No appointments available.</div>
            @else
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Service</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->customer_name }}</td>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td>PHP {{ number_format($appointment->price, 2) }}</td>
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
    </section>

    <section class="panel" style="margin-top: 24px;">
        <h3 style="margin-top: 0;">Payment History</h3>

        @if ($payments->isEmpty())
            <div class="empty">No payment transactions have been recorded yet.</div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Amount Due</th>
                            <th>Amount Paid</th>
                            <th>Change</th>
                            <th>Status</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->appointment->customer_name }}</td>
                                <td>{{ $payment->appointment->service->name }}</td>
                                <td>PHP {{ number_format($payment->amount_due, 2) }}</td>
                                <td>PHP {{ number_format($payment->amount_paid, 2) }}</td>
                                <td>PHP {{ number_format($payment->change_amount, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $payment->status }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('payments.update', $payment) }}" method="POST" class="actions">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" style="min-width: 120px;">
                                            <option value="paid" @selected($payment->status === 'paid')>Paid</option>
                                            <option value="unpaid" @selected($payment->status === 'unpaid')>Unpaid</option>
                                        </select>
                                        <button type="submit">Save</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
