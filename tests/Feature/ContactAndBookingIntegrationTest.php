<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Program;
use App\Models\SessionBooking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactAndBookingIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_stores_message_for_admin(): void
    {
        $this->post(route('contact.store'), [
            'name' => 'Riya Shah',
            'email' => 'riya@example.com',
            'phone' => '9876543210',
            'interest' => 'Focus and attention',
            'message' => 'I would like to learn more about focus training.',
        ])->assertRedirect(route('contact'));

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'riya@example.com',
            'topic' => 'Focus and attention',
            'is_read' => 0,
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $message = ContactMessage::query()->firstOrFail();

        $this->actingAs($admin)
            ->get(route('admin.messages.show', $message))
            ->assertOk()
            ->assertSee('Riya Shah')
            ->assertSee('I would like to learn more about focus training.');

        $this->assertTrue($message->fresh()->is_read);
    }

    public function test_session_booking_is_saved_and_visible_in_admin(): void
    {
        Program::create([
            'category' => 'Mind Trainer',
            'type' => 'Seminar',
            'title' => 'Focus Foundations',
            'slug' => 'focus-foundations',
            'description' => 'A practical focus program.',
            'is_visible' => true,
            'display_order' => 1,
        ]);

        $this->postJson(route('session-bookings.store'), [
            'name' => 'Aman Verma',
            'email' => 'aman@example.com',
            'program' => 'Focus Foundations',
            'timing' => 'Morning (8:00 AM – 11:00 AM IST)',
            'message' => 'Looking for a morning slot.',
        ])->assertCreated();

        $this->assertDatabaseHas('session_bookings', [
            'email' => 'aman@example.com',
            'program' => 'Focus Foundations',
            'status' => 'new',
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $booking = SessionBooking::query()->firstOrFail();

        $this->actingAs($admin)
            ->get(route('admin.bookings.show', $booking))
            ->assertOk()
            ->assertSee('Aman Verma')
            ->assertSee('Focus Foundations')
            ->assertSee('Looking for a morning slot.');
    }

    public function test_programs_page_shows_coming_soon_when_under_six_items(): void
    {
        Program::create([
            'category' => 'Mind Trainer',
            'type' => 'Webinar',
            'title' => 'Only Program',
            'slug' => 'only-program',
            'description' => 'Single visible program.',
            'is_visible' => true,
            'display_order' => 1,
        ]);

        $this->get(route('programs'))
            ->assertOk()
            ->assertSee('Only Program')
            ->assertSee('Upcoming programs');
    }
}
