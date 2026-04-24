<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('service', 'payment')->latest()->get();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $services = Service::all();
        return view('appointments.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $service = Service::findOrFail($validated['service_id']);

        Appointment::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'service_id' => $validated['service_id'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'total_price' => $service->price,
            'status' => 'booked',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $services = Service::all();
        return view('appointments.edit', compact('appointment', 'services'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|in:booked,completed,cancelled',
        ]);

        $service = Service::findOrFail($validated['service_id']);

        $appointment->update([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'service_id' => $validated['service_id'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'total_price' => $service->price,
            'status' => $validated['status'],
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
