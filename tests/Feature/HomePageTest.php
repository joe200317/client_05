<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_presents_mind_training_and_links_to_separate_pages(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('Focus better.')
            ->assertSee('Grow with confidence.')
            ->assertSee('Memory')
            ->assertSee('mind-visual-callout--focus', false)
            ->assertSee('mind-visual-callout--memory', false)
            ->assertSee('mind-visual-callout--growth', false)
            ->assertSee(asset('images/mind-training-focus.jpg'), false)
            ->assertSee(asset('images/blogs-memory-conversation.png'), false)
            ->assertSee(asset('images/blogs-growth-reflection.webp'), false)
            ->assertSee('Learn with a coach')
            ->assertSee('Explore our services')
            ->assertSee('Upcoming programs')
            ->assertSee('From the mind training blog')
            ->assertSee('Learner stories')
            ->assertSee('Participant reflections will appear here soon.')
            ->assertSee('Make space for a stronger, more focused you.')
            ->assertSee('Talk to us')
            ->assertSee(route('about'), false)
            ->assertSee(route('programs'), false)
            ->assertSee(route('testimonials'), false)
            ->assertSee(route('blogs'), false)
            ->assertSee(route('gallery'), false)
            ->assertSee(route('contact'), false);
    }

    public function test_about_page_renders_its_content_and_shared_footer(): void
    {
        $response = $this->get(route('about'));

        $response->assertOk()
            ->assertSee('A little about us')
            ->assertSee('Our philosophy')
            ->assertSee('People are different. Their learning journeys should be, too.')
            ->assertSee('about-floating-card--top', false)
            ->assertSee('about-floating-card--bottom', false)
            ->assertSee('Find a mind training path that feels right for you.')
            ->assertSee('Get in touch')
            ->assertSee('Think clearly. Learn with confidence. Keep growing.')
            ->assertDontSee('Let’s connect')
            ->assertSee(route('contact'), false);
    }

    public function test_testimonials_page_renders_story_themes_and_permission_led_reflections(): void
    {
        $response = $this->get(route('testimonials'));

        $response->assertOk()
            ->assertSee('Participant stories')
            ->assertSee('Every mind learns at its')
            ->assertSee('own pace.')
            ->assertSee('Real voices, shared with care')
            ->assertSee('Participant reflections')
            ->assertSee('Coming soon')
            ->assertSee('will only appear with permission')
            ->assertSee('Explore the learning paths')
            ->assertSee('Your next step could be the start of a new story.');
    }

    public function test_blogs_page_renders_featured_and_practical_articles(): void
    {
        $response = $this->get(route('blogs'));

        $response->assertOk()
            ->assertSee('Mind Training Insights')
            ->assertSee('Ideas to practise')
            ->assertSee('Make focus feel possible')
            ->assertSee('Ideas for clearer focus and meaningful growth')
            ->assertSee('More blogs coming soon')
            ->assertSee('Turn a little insight into a daily practice.');
    }

    public function test_contact_page_renders_contact_options_form_and_starting_paths(): void
    {
        $response = $this->get(route('contact'));

        $response->assertOk()
            ->assertSee('Contact Mind Training')
            ->assertSee('Let’s find a thoughtful place')
            ->assertSee('Ways to connect')
            ->assertSee('Send a message')
            ->assertSee('Send message')
            ->assertSee('maxlength="10"', false)
            ->assertSee('inputmode="numeric"', false)
            ->assertSee('pattern="[0-9]{10}"', false)
            ->assertSee('Every conversation can begin differently')
            ->assertSee(route('programs'), false);
    }

    public function test_gallery_page_renders_reusable_photo_cards(): void
    {
        $response = $this->get(route('gallery'));

        $response->assertOk()
            ->assertSee('Moments from our community')
            ->assertSee('Learning, growth and')
            ->assertSee('Gallery photos are coming soon.')
            ->assertSee(route('programs'), false);
    }

    #[DataProvider('pageRoutes')]
    public function test_navigation_destination_renders_its_own_page(
        string $routeName,
        string $pageTitle,
        string $ctaTitle,
        string $ctaButtonText,
        string $ctaRoute,
    ): void {
        $response = $this->get(route($routeName));

        $response->assertOk()
            ->assertSee($pageTitle)
            ->assertSee($ctaTitle)
            ->assertSee($ctaButtonText)
            ->assertSee(route($ctaRoute), false)
            ->assertSee('mind-training-cta-chip--focus', false)
            ->assertSee('mind-training-cta-satellite--outer', false)
            ->assertSee('mind-training-cta-satellite--inner', false)
            ->assertSee('Think clearly. Learn with confidence. Keep growing.');
    }

    public static function pageRoutes(): array
    {
        return [
            'about' => [
                'about',
                'A little about us',
                'Find a mind training path that feels right for you.',
                'Get in touch',
                'contact',
            ],
            'testimonials' => [
                'testimonials',
                'Participant Stories',
                'Your next step could be the start of a new story.',
                'Explore programs',
                'programs',
            ],
            'blogs' => [
                'blogs',
                'Mind Training Insights',
                'Turn a little insight into a daily practice.',
                'Explore programs',
                'programs',
            ],
            'gallery' => [
                'gallery',
                'Learning, growth and',
                'Make room for a more intentional way to learn.',
                'Explore programs',
                'programs',
            ],
            'contact' => [
                'contact',
                'Contact Mind Training',
                'Let’s find a good place to begin.',
                'Explore programs',
                'programs',
            ],
        ];
    }
}
