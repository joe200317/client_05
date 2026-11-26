<?php

namespace Tests\Feature;

use App\Models\Program;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgramsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_programs_page_presents_training_options_and_coming_soon_when_empty(): void
    {
        $response = $this->get(route('programs'));

        $response->assertOk()
            ->assertSee('Programs designed around real life')
            ->assertSee('programs-hero-callout--focus', false)
            ->assertSee('programs-hero-callout--memory', false)
            ->assertSee('programs-hero-callout--learning', false)
            ->assertSee(asset('images/mind-training-focus.jpg'), false)
            ->assertSee(asset('images/blogs-memory-conversation.png'), false)
            ->assertSee(asset('images/testimonials-child-steps.jpe'), false)
            ->assertSee('Practical skills for')
            ->assertSee('Memory improvement techniques')
            ->assertSee('Concentration and focus development')
            ->assertSee('Effective learning and study methods')
            ->assertSee('Mind development exercises')
            ->assertSee('Confidence and personal development')
            ->assertSee('Learning habits and self-improvement')
            ->assertSee('Training approach')
            ->assertSee('Available programs')
            ->assertSee('Upcoming programs')
            ->assertDontSee('Mind Trainer 1-on-1 Seminar')
            ->assertSee(route('contact'), false)
            ->assertSee('<img class="brand-icon"', false)
            ->assertSee('<img class="footer-brand-icon"', false)
            ->assertSee('<link rel="icon" type="image/png"', false)
            ->assertSee(asset('images/mind-training-lotus-mark.png'), false)
            ->assertSee('Think clearly. Learn with confidence. Keep growing.');
    }

    public function test_visible_programs_render_as_offer_cards(): void
    {
        Program::create([
            'category' => 'Mind Trainer',
            'type' => 'Group',
            'title' => 'Memory Methods',
            'slug' => 'memory-methods',
            'description' => 'Build stronger recall with practical tools.',
            'schedule_or_format' => 'Flexible format',
            'button_label' => 'Ask about this program',
            'button_link' => '/contact',
            'is_visible' => true,
            'display_order' => 1,
        ]);

        $this->get(route('programs'))
            ->assertOk()
            ->assertSee('Memory Methods')
            ->assertSee('Build stronger recall with practical tools.')
            ->assertSee('Ask about this program')
            ->assertSee('Upcoming programs');
    }
}
