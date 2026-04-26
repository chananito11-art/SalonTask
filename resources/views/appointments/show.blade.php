@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h2>Booking Details</h2>
            <p>Review the customer, selected service, schedule, and payment information for this appointment.</p>
        </div>

        <a class="btn btn-secondary" href="{{ route('appointments.index') }}">Back to Appointments</a>
    </section>

    <section class="panel">
        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
            <div>
                <div class="muted">Customer Name</div>
                <strong>{{ $appointment->customer_name }}</strong>
            </div>

            <div>
                <div class="muted">Contact Information</div>
                <strong>{{ $appointment->customer_contact }}</strong>
            </div>

            <div>
                <div class="muted">Service Selected</div>
                <strong>{{ $appointment->service->name }}</strong>
            </div>

            <div>
                <div class="muted">Schedule</div>
                <strong>{{ $appointment->appointment_at->format('M d, Y h:i A') }}</strong>
            </div>

            <div>
                <div class="muted">Price</div>
                <strong>PHP {{ number_format($appointment->price, 2) }}</strong>
            </div>

            <div>
                <div class="muted">Payment Status</div>
                <span class="badge badge-{{ $appointment->payment_status }}">{{ ucfirst($appointment->payment_status) }}</span>
            </div>
        </div>

        @if ($appointment->payment)
            <div class="panel" style="margin-top: 24px;">
                <h3 style="margin-top: 0;">Recorded Payment</h3>
                <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));">
                    <div>
                        <div class="muted">Amount Due</div>
                        <strong>PHP {{ number_format($appointment->payment->amount_due, 2) }}</strong>
                    </div>

                    <div>
                        <div class="muted">Amount Paid</div>
                        <strong>PHP {{ number_format($appointment->payment->amount_paid, 2) }}</strong>
                    </div>

                    <div>
                        <div class="muted">Change</div>
                        <strong>PHP {{ number_format($appointment->payment->change_amount, 2) }}</strong>
                    </div>

                    <div>
                        <div class="muted">Paid At</div>
                        <strong>{{ optional($appointment->payment->paid_at)->format('M d, Y h:i A') ?? 'Pending' }}</strong>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
