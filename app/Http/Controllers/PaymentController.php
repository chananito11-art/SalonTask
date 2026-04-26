<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('payments.index', [
            'appointments' => Appointment::with(['service', 'payment'])
                ->latest('appointment_at')
                ->get(),
            'unpaidAppointments' => Appointment::with('service')
                ->where('payment_status', 'unpaid')
                ->doesntHave('payment')
                ->latest('appointment_at')
                ->get(),
            'payments' => Payment::with('appointment.service')
                ->latest('created_at')
                ->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'appointment_id' => ['required', 'exists:appointments,id'],
            'amount_paid' => ['required', 'numeric', 'min:0'],
        ]);

        $appointment = Appointment::with('service')->findOrFail($validated['appointment_id']);
        $amountDue = (float) $appointment->price;
        $amountPaid = (float) $validated['amount_paid'];

        if ($appointment->payment()->exists()) {
            return back()->withErrors([
                'appointment_id' => 'Payment has already been recorded for this booking.',
            ]);
        }

        if ($amountPaid < $amountDue) {
            return back()->withErrors([
                'amount_paid' => 'Amount paid must be equal to or greater than the service price.',
            ])->withInput();
        }

        Payment::create([
            'appointment_id' => $appointment->id,
            'amount_due' => $amountDue,
            'amount_paid' => $amountPaid,
            'change_amount' => $amountPaid - $amountDue,
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        $appointment->update([
            'payment_status' => 'paid',
        ]);

        return redirect()
            ->route('payments.index')
            ->with('status', 'Payment processed successfully.');
    }

    public function update(Request $request, Payment $payment): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:paid,unpaid'],
        ]);

        $payment->update([
            'status' => $validated['status'],
            'paid_at' => $validated['status'] === 'paid' ? ($payment->paid_at ?? now()) : null,
        ]);

        $payment->appointment()->update([
            'payment_status' => $validated['status'],
        ]);

        return redirect()
            ->route('payments.index')
            ->with('status', 'Payment status updated successfully.');
    }
}
