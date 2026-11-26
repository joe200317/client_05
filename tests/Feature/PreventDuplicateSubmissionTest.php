<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\SessionBooking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PreventDuplicateSubmissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
    }

    public function test_duplicate_contact_submissions_create_only_one_message(): void
    {
        $payload = [
            'name' => 'Riya Shah',
            'email' => 'riya@example.com',
            'phone' => '9876543210',
            'interest' => 'Focus and attention',
            'message' => 'I would like to learn more about focus training.',
        ];

        $this->post(route('contact.store'), $payload)->assertRedirect(route('contact'));
        $this->post(route('contact.store'), $payload)->assertRedirect();

        $this->assertSame(1, ContactMessage::query()->count());
    }

    public function test_duplicate_session_booking_submissions_create_only_one_booking(): void
    {
        $payload = [
            'name' => 'Aman Verma',
            'email' => 'aman@example.com',
            'program' => 'Focus Foundations',
            'timing' => 'Morning (8:00 AM – 11:00 AM IST)',
            'message' => 'Looking for a morning slot.',
        ];

        $this->postJson(route('session-bookings.store'), $payload)->assertCreated();
        $this->postJson(route('session-bookings.store'), $payload)
            ->assertOk()
            ->assertJsonPath('duplicate', true);

        $this->assertSame(1, SessionBooking::query()->count());
    }
}
