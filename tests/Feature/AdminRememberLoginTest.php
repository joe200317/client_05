<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRememberLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_remember_me_stores_email_cookie_for_next_login(): void
    {
        User::create([
            'name' => 'Site Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->post(route('admin.login.submit'), [
            'email' => 'admin@example.com',
            'password' => 'password',
            'remember' => '1',
        ])
            ->assertRedirect(route('admin.dashboard'))
            ->assertPlainCookie('admin_remembered_email', 'admin@example.com');
    }

    public function test_login_form_prefills_remembered_email(): void
    {
        $this->withUnencryptedCookie('admin_remembered_email', 'admin@example.com')
            ->get(route('admin.login'))
            ->assertOk()
            ->assertSee('value="admin@example.com"', false)
            ->assertSee('checked', false);
    }
}
