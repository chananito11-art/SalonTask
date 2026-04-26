<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalonManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_user_can_log_in_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@salon.com',
            'password' => 'password',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticated_user_can_create_service_booking_and_payment(): void
    {
        $user = User::factory()->create();
        $service = Service::create([
            'name' => 'Manicure',
            'price' => 300,
            'duration' => '45 minutes',
            'description' => 'Classic manicure service.',
        ]);

        $this->actingAs($user)
            ->post(route('appointments.store'), [
                'service_id' => $service->id,
                'customer_name' => 'Jamie Flores',
                'customer_contact' => '09175551234',
                'appointment_date' => '2026-04-30',
                'appointment_time' => '13:30',
            ])
            ->assertRedirect(route('appointments.index'));

        $appointment = Appointment::firstOrFail();

        $this->actingAs($user)
            ->post(route('payments.store'), [
                'appointment_id' => $appointment->id,
                'amount_paid' => 500,
            ])
            ->assertRedirect(route('payments.index'));

        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'payment_status' => 'paid',
        ]);

        $this->assertDatabaseHas('payments', [
            'appointment_id' => $appointment->id,
            'status' => 'paid',
        ]);
    }
}
