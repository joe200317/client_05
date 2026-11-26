<?php

namespace Tests\Feature;

use App\Models\Program;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProgramManagementTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsAdmin(): User
    {
        $admin = User::create([
            'name' => 'Site Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        return $admin;
    }

    public function test_admin_can_create_program_and_it_appears_on_public_page(): void
    {
        $this->actingAsAdmin();

        $this->post(route('admin.programs.store'), [
            'category_option' => 'Mind Trainer',
            'type_option' => 'Seminar',
            'title' => 'Focus Foundations',
            'description' => 'A practical program for everyday focus.',
            'schedule_or_format' => 'Weekly sessions',
            'button_label' => 'Ask about this program',
            'button_link' => '/contact',
            'display_order' => 1,
            'is_visible' => 1,
        ])->assertRedirect(route('admin.programs.index'));

        $this->assertDatabaseHas('programs', [
            'title' => 'Focus Foundations',
            'slug' => 'focus-foundations',
            'is_visible' => 1,
        ]);

        $this->get(route('programs'))
            ->assertOk()
            ->assertSee('Focus Foundations')
            ->assertSee('A practical program for everyday focus.')
            ->assertSee('Upcoming programs');
    }

    public function test_admin_can_remove_program_thumbnail(): void
    {
        $this->actingAsAdmin();

        $program = Program::create([
            'category' => 'Mind Trainer',
            'type' => 'Seminar',
            'title' => 'Focus Foundations',
            'slug' => 'focus-foundations',
            'description' => 'A practical program for everyday focus.',
            'thumbnail_path' => 'programs/demo-thumb.jpg',
            'is_visible' => true,
            'display_order' => 1,
        ]);

        $this->put(route('admin.programs.update', $program), [
            'category_option' => 'Mind Trainer',
            'type_option' => 'Seminar',
            'title' => 'Focus Foundations',
            'description' => 'A practical program for everyday focus.',
            'display_order' => 1,
            'is_visible' => 1,
            'remove_thumbnail' => 1,
        ])->assertRedirect(route('admin.programs.index'));

        $this->assertDatabaseHas('programs', [
            'id' => $program->id,
            'thumbnail_path' => null,
        ]);
    }

    public function test_hidden_programs_do_not_appear_on_public_page(): void
    {
        $this->actingAsAdmin();

        Program::create([
            'category' => 'Mind Trainer',
            'type' => '1-on-1',
            'title' => 'Private Draft Program',
            'slug' => 'private-draft-program',
            'description' => 'Should stay hidden.',
            'is_visible' => false,
            'display_order' => 1,
        ]);

        $this->get(route('programs'))
            ->assertOk()
            ->assertDontSee('Private Draft Program')
            ->assertSee('Upcoming programs');
    }

    public function test_guest_cannot_access_admin_programs(): void
    {
        $this->get(route('admin.programs.index'))
            ->assertRedirect(route('admin.login'));
    }
}
