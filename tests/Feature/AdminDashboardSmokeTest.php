<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_dashboard_to_login(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Site Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Overview')
            ->assertSee('Programs')
            ->assertSee('Testimonials')
            ->assertSee('Blog posts')
            ->assertSee('Gallery')
            ->assertDontSee('+ Add program')
            ->assertSee('Create admin')
            ->assertSee('Change Password');
    }
}
