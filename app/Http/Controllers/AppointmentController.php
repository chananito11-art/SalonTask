<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(): View
    {
        return view('appointments.index', [
            'appointments' => Appointment::with(['service', 'payment'])
                ->latest('appointment_at')
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('appointments.create', [
            'services' => Service::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_contact' => ['required', 'string', 'max:255'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required', 'date_format:H:i'],
        ]);

        $service = Service::findOrFail($validated['service_id']);

        Appointment::create([
            'service_id' => $service->id,
            'customer_name' => $validated['customer_name'],
            'customer_contact' => $validated['customer_contact'],
            'appointment_at' => $validated['appointment_date'].' '.$validated['appointment_time'],
            'price' => $service->price,
            'payment_status' => 'unpaid',
        ]);

        return redirect()
            ->route('appointments.index')
            ->with('status', 'Appointment booked successfully.');
    }

    public function show(Appointment $appointment): View
    {
        $appointment->load(['service', 'payment']);

        return view('appointments.show', compact('appointment'));
    }
}
