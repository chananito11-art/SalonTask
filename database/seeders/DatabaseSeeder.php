<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'chananito11@gmail.com'],
            [
                'name' => 'Chan Anito',
                'password' => Hash::make('Chananito_112699'),
            ]
        );

        $services = collect([
            [
                'name' => 'Classic Manicure',
                'price' => 250,
                'duration' => '45 minutes',
                'description' => 'Nail trimming, shaping, cuticle care, and regular polish.',
            ],
            [
                'name' => 'Spa Pedicure',
                'price' => 450,
                'duration' => '1 hour',
                'description' => 'Relaxing foot soak, scrub, massage, and polish finish.',
            ],
            [
                'name' => 'Gel Polish',
                'price' => 550,
                'duration' => '1 hour',
                'description' => 'Long-wear gel color with glossy top coat.',
            ],
            [
                'name' => 'Nail Extension',
                'price' => 1200,
                'duration' => '2 hours',
                'description' => 'Full extension set with shaping and polish application.',
            ],
        ])->map(fn (array $service) => Service::updateOrCreate(
            ['name' => $service['name']],
            $service
        ));

        $firstAppointment = Appointment::updateOrCreate(
            ['customer_name' => 'Camille Reyes', 'customer_contact' => '09171234567'],
            [
                'service_id' => $services[0]->id,
                'appointment_at' => now()->addDay()->setTime(10, 0),
                'price' => $services[0]->price,
                'payment_status' => 'paid',
            ]
        );

        Appointment::updateOrCreate(
            ['customer_name' => 'Janelle Cruz', 'customer_contact' => '09179876543'],
            [
                'service_id' => $services[2]->id,
                'appointment_at' => now()->addDays(2)->setTime(14, 30),
                'price' => $services[2]->price,
                'payment_status' => 'unpaid',
            ]
        );

        Payment::updateOrCreate(
            ['appointment_id' => $firstAppointment->id],
            [
                'amount_due' => $firstAppointment->price,
                'amount_paid' => $firstAppointment->price,
                'change_amount' => 0,
                'status' => 'paid',
                'paid_at' => now(),
            ]
        );

        $admin->refresh();
        $admin->update([
            'password' => Hash::make('Chananito_112699'),
        ]);
    }
}
