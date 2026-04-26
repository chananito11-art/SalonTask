<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $recentAppointments = Appointment::with('service')
            ->latest('appointment_at')
            ->take(5)
            ->get();

        $recentPayments = Payment::with('appointment.service')
            ->latest('paid_at')
            ->take(5)
            ->get();

        return view('dashboard.index', [
            'serviceCount' => Service::count(),
            'appointmentCount' => Appointment::count(),
            'unpaidCount' => Appointment::where('payment_status', 'unpaid')->count(),
            'totalRevenue' => Payment::where('status', 'paid')->sum('amount_due'),
            'recentAppointments' => $recentAppointments,
            'recentPayments' => $recentPayments,
        ]);
    }
}
