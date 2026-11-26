@extends('layouts.app')

@section('title', 'Mind Training Insights | Focus, Memory & Learning')

@section('meta_description', 'Practical ideas for focus, memory, learning and personal growth.')

@push('styles')
    @vite('resources/css/pages/blogs.css')
@endpush

@section('content')
    <x-layout.navbar />

    <main>
        <section class="blogs-hero">
            <x-home.leaf class="blogs-botanical-leaf blogs-botanical-leaf--hero" />
            <div class="blogs-hero-orb" aria-hidden="true"></div>

            <div class="section-container blogs-hero-grid">
                <div class="blogs-hero-copy reveal">
                    <p class="section-kicker">Mind Training Insights</p>
                    <h1>Ideas to practise.<br><span>Space to grow.</span></h1>
                    <p>
                        Thoughtful notes about attention, memory, learning and
                        everyday wellbeing—made practical enough to use today.
                    </p>
                </div>

                <div class="blogs-featured reveal">
                    <div class="blogs-featured-art">
                        <img
                            src="{{ asset('images/blogs-growth-reflection.webp') }}"
                            alt="Quiet reflection for mindful learning and growth">
                        <span>Mind Training journal</span>
                    </div>
                    <div class="blogs-featured-copy">
                        <p>Mind Training journal</p>
                        <h2>Make focus feel possible, one moment at a time.</h2>
                        <a href="#articles" class="text-link">Explore the journal <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="blogs-explore section-pad" id="articles">
            <x-home.leaf class="blogs-botanical-leaf blogs-botanical-leaf--explore" />
            <x-home.leaf class="blogs-botanical-leaf blogs-botanical-leaf--explore-left" />
            <div class="section-container">
                <header class="blogs-section-heading reveal">
                    <p class="section-kicker">Explore the journal</p>
                    <h2>Ideas for clearer focus and meaningful growth</h2>
                </header>

                <div class="blogs-grid">
                    @foreach ($posts as $post)
                        <article class="blog-card reveal" id="article-{{ $post->id }}">
                            <div class="blog-card-image">
                                <img
                                    src="{{ $post->cover_image_url ?: asset('images/blogs-growth-reflection.webp') }}"
                                    alt="{{ $post->title }}">
                            </div>
                            <div class="blog-card-copy">
                                <p>{{ $post->category }}@if($post->reading_time) · {{ $post->reading_time }}@endif</p>
                                <h3>{{ $post->title }}</h3>
                                <p>{{ $post->excerpt }}</p>
                            </div>
                        </article>
                    @endforeach

                    @if ($posts->count() < 6)
                        <article class="blog-card blog-card--coming reveal">
                            <div class="blog-card-image blog-card-image--coming" aria-hidden="true">
                                <span>✦</span>
                            </div>
                            <div class="blog-card-copy">
                                <p>Upcoming</p>
                                <h3>More blogs coming soon</h3>
                                <p>Thoughtful notes on focus, memory and learning habits will appear here as new stories are published.</p>
                            </div>
                        </article>
                    @endif
                </div>
            </div>
        </section>

        <section class="blogs-practice section-pad">
            <x-home.leaf class="blogs-botanical-leaf blogs-botanical-leaf--practice" />
            <div class="section-container blogs-practice-grid">
                <div class="blogs-practice-copy reveal">
                    <p class="section-kicker">One practice at a time</p>
                    <h2>Start small. Keep what helps.</h2>
                    <p>
                        The most useful ideas are usually the ones you can return to.
                        Choose one focus for the week and give it a little space.
                    </p>
                </div>

                <div class="blogs-practice-card reveal">
                    <span class="blogs-practice-day">TODAY’S PRACTICE</span>
                    <div class="blogs-practice-icon" aria-hidden="true">
                        <svg viewBox="0 0 48 48" fill="none">
                            <circle cx="24" cy="24" r="14"/>
                            <circle cx="24" cy="24" r="7"/>
                            <circle cx="24" cy="24" r="2" fill="currentColor" stroke="none"/>
                        </svg>
                    </div>
                    <h3>One minute of clear attention</h3>
                    <p>Choose one task. Place both feet on the ground. Begin again whenever your attention wanders.</p>
                    <a href="{{ route('programs') }}" class="btn btn-primary">Explore practical programs <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </section>
    </main>

    <x-layout.mind-training-cta
        eyebrow="Take one idea further"
        title="Turn a little insight into a daily practice."
        description="Explore practical ways to bring mind training into your learning, work and everyday routines."
        button-text="Explore programs"
        :button-url="route('programs')"
    />

    <x-layout.footer />
@endsection