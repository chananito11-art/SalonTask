@extends('layouts.app')

@section('title', 'Payments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Payments</h1>
        <p class="text-muted mb-0">Track payment history and statuses.</p>
    </div>
    <a href="{{ route('payments.create') }}" class="btn btn-primary">Process Payment</a>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Reference</th>
                    <th>Status</th>
                    <th>Payment Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $payment->appointment->customer_name }}</td>
                        <td>{{ $payment->appointment->service->name }}</td>
                        <td>₱{{ number_format($payment->amount, 2) }}</td>
                        <td>{{ $payment->reference ?: 'N/A' }}</td>
                        <td>{{ ucfirst($payment->status) }}</td>
                        <td>{{ $payment->payment_date ? $payment->payment_date->format('M d, Y h:i A') : 'N/A' }}</td>
                        <td class="text-end">
                            <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="{{ route('payments.destroy', $payment) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this payment?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-muted">No payments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
