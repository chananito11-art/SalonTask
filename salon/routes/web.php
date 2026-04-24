<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'serviceCount' => \App\Models\Service::count(),
            'appointmentCount' => \App\Models\Appointment::count(),
            'paymentCount' => \App\Models\Payment::count(),
            'paidPaymentCount' => \App\Models\Payment::where('status', 'paid')->count(),
            'recentAppointments' => \App\Models\Appointment::with('service', 'payment')->latest()->take(5)->get(),
            'recentPayments' => \App\Models\Payment::with('appointment.service')->latest()->take(5)->get(),
        ]);
    })->name('dashboard');

    Route::resource('services', ServiceController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('payments', PaymentController::class);
});
