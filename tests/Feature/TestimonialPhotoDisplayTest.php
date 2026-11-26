<?php

namespace Tests\Feature;

use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestimonialPhotoDisplayTest extends TestCase
{
    use RefreshDatabase;

    public function test_testimonials_page_renders_photo_url_when_present(): void
    {
        $photoUrl = 'https://cdn.example.com/testimonials/learner.webp';

        Testimonial::query()->create([
            'quote' => 'Mind training helped me stay present during exams.',
            'learner_name' => 'Ananya Mehta',
            'program_or_role' => 'Focus Foundations',
            'photo_path' => $photoUrl,
            'is_published' => true,
            'show_on_home' => true,
            'display_order' => 0,
        ]);

        $this->get(route('testimonials'))
            ->assertOk()
            ->assertSee($photoUrl, false)
            ->assertSee('Ananya Mehta')
            ->assertSee('Mind training helped me stay present during exams.');
    }

    public function test_testimonials_page_falls_back_to_initials_without_photo(): void
    {
        Testimonial::query()->create([
            'quote' => 'I feel calmer when I practise daily.',
            'learner_name' => 'Kabir Singh',
            'program_or_role' => null,
            'photo_path' => null,
            'is_published' => true,
            'show_on_home' => false,
            'display_order' => 1,
        ]);

        $this->get(route('testimonials'))
            ->assertOk()
            ->assertSee('Kabir Singh')
            ->assertSee('KS')
            ->assertDontSee('reflection-card-avatar--photo', false);
    }

    public function test_home_page_shows_featured_testimonial_photo_when_marked_for_home(): void
    {
        $photoUrl = 'https://cdn.example.com/testimonials/home-learner.webp';

        Testimonial::query()->create([
            'quote' => 'A steady practice changed my mornings.',
            'learner_name' => 'Meera Joshi',
            'program_or_role' => 'Memory Skills',
            'photo_path' => $photoUrl,
            'is_published' => true,
            'show_on_home' => true,
            'display_order' => 0,
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee($photoUrl, false)
            ->assertSee('Meera Joshi')
            ->assertSee('A steady practice changed my mornings.');
    }
}
