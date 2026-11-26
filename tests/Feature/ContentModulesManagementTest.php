<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\GalleryPhoto;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentModulesManagementTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsAdmin(): void
    {
        $admin = User::create([
            'name' => 'Site Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->actingAs($admin);
    }

    public function test_published_testimonial_appears_on_public_page(): void
    {
        $this->actingAsAdmin();

        $this->post(route('admin.testimonials.store'), [
            'learner_name' => 'Asha',
            'program_or_role' => 'Focus program',
            'quote' => 'I found steadier attention in daily practice.',
            'display_order' => 1,
            'is_published' => 1,
        ])->assertRedirect(route('admin.testimonials.index'));

        $this->get(route('testimonials'))
            ->assertOk()
            ->assertSee('I found steadier attention in daily practice.')
            ->assertSee('Asha')
            ->assertDontSee('Coming soon');
    }

    public function test_published_blog_appears_on_public_page(): void
    {
        $this->actingAsAdmin();

        $this->post(route('admin.blogs.store'), [
            'category' => 'Focus',
            'title' => 'One minute of attention',
            'excerpt' => 'A short practice for clearer days.',
            'content' => 'Begin with one minute of clear attention.',
            'reading_time' => '3 min read',
            'published_at' => now()->toDateString(),
            'is_published' => 1,
        ])->assertRedirect(route('admin.blogs.index'));

        $this->get(route('blogs'))
            ->assertOk()
            ->assertSee('One minute of attention')
            ->assertSee('A short practice for clearer days.')
            ->assertSee('More blogs coming soon');
    }

    public function test_visible_gallery_photo_appears_on_public_page(): void
    {
        GalleryPhoto::create([
            'title' => 'Workshop morning',
            'description' => 'Learners practising together.',
            'image_path' => 'gallery/workshop.jpg',
            'display_order' => 1,
            'is_visible' => true,
        ]);

        $this->get(route('gallery'))
            ->assertOk()
            ->assertSee('Workshop morning')
            ->assertDontSee('Gallery photos are coming soon.');
    }

    public function test_admin_can_open_gallery_create_form(): void
    {
        $this->actingAsAdmin();

        $this->get(route('admin.gallery.create'))
            ->assertOk()
            ->assertSee('Add photo');
    }

    public function test_empty_public_pages_show_coming_soon_states(): void
    {
        $this->get(route('testimonials'))
            ->assertOk()
            ->assertSee('Coming soon');

        $this->get(route('blogs'))
            ->assertOk()
            ->assertSee('More blogs coming soon');

        $this->get(route('gallery'))
            ->assertOk()
            ->assertSee('Gallery photos are coming soon.');
    }

    public function test_hidden_content_stays_off_public_pages(): void
    {
        Testimonial::create([
            'learner_name' => 'Hidden Learner',
            'quote' => 'This should stay private.',
            'is_published' => false,
            'display_order' => 1,
        ]);

        BlogPost::create([
            'category' => 'Draft',
            'title' => 'Hidden Draft',
            'slug' => 'hidden-draft',
            'excerpt' => 'Not ready yet.',
            'content' => 'Draft body.',
            'published_at' => now()->toDateString(),
            'is_published' => false,
        ]);

        GalleryPhoto::create([
            'title' => 'Hidden Photo',
            'image_path' => 'gallery/hidden.jpg',
            'is_visible' => false,
            'display_order' => 1,
        ]);

        $this->get(route('testimonials'))->assertDontSee('Hidden Learner');
        $this->get(route('blogs'))->assertDontSee('Hidden Draft');
        $this->get(route('gallery'))->assertDontSee('Hidden Photo');
    }
}
