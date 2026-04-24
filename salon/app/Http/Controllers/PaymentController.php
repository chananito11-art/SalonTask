<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Appointment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('appointment.service')->latest()->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $appointments = Appointment::with('service')
            ->whereDoesntHave('payment')
            ->latest()
            ->get();

        return view('payments.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:paid,unpaid',
            'reference' => 'nullable|string|max:255',
        ]);

        Payment::create([
            'appointment_id' => $validated['appointment_id'],
            'amount' => $validated['amount'],
            'status' => $validated['status'],
            'reference' => $validated['reference'] ?? null,
            'payment_date' => $validated['status'] === 'paid' ? now() : null,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully.');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:paid,unpaid',
            'reference' => 'nullable|string|max:255',
        ]);

        $payment->update([
            'status' => $validated['status'],
            'reference' => $validated['reference'] ?? $payment->reference,
            'payment_date' => $validated['status'] === 'paid' ? now() : null,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment status updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
