@extends('layouts.app')

@section('title', 'Participant Stories | Mind Training')

@section('meta_description', 'Explore the kinds of growth participants may experience through mind training, from steadier focus to more confident learning.')

@push('styles')
@vite('resources/css/pages/testimonials.css')
@endpush

@section('content')
<x-layout.navbar />

<main>
    <section class="testimonials-hero">
        <x-home.leaf class="testimonials-botanical-leaf testimonials-botanical-leaf--hero" />
        <div class="testimonials-hero-warmth" aria-hidden="true"></div>

        <div class="section-container testimonials-hero-grid">
            <div class="testimonials-hero-copy reveal">
                <p class="section-kicker">Participant stories</p>
                <h1>Every mind learns at its <span>own pace.</span></h1>
                <p>
                    Growth is personal. These reflections share how learners notice
                    change in focus, memory, confidence and everyday practice —
                    in their own words, with permission.
                </p>
                <a href="#participant-reflections" class="btn btn-primary">
                    Explore reflections <span aria-hidden="true">↓</span>
                </a>
            </div>

            <div class="testimonials-hero-visual reveal">
                <div class="testimonials-hero-photo">
                    <img
                        src="{{ asset('images/testimonials-hero.webp') }}"
                        alt="A young learner reflecting beside books in a calm, green setting">
                    <div class="testimonials-photo-caption">
                        <span aria-hidden="true">✦</span>
                        <span><strong>One meaningful change</strong><small>can begin with a single practice</small></span>
                    </div>
                </div>

                <div class="testimonials-orbit testimonials-orbit--outer" aria-hidden="true"></div>
                <div class="testimonials-orbit testimonials-orbit--inner" aria-hidden="true"></div>
                <span class="testimonials-satellite testimonials-satellite--one" aria-hidden="true"></span>
                <span class="testimonials-satellite testimonials-satellite--two" aria-hidden="true"></span>
            </div>
        </div>
    </section>

    <section class="journey-section section-pad">
        <div class="section-container journey-grid">
            <div class="journey-mosaic reveal">
                <div class="journey-image journey-image--large">
                    <img src="{{ asset('images/mind-training-focus.jpg') }}" alt="A child exploring nature through curiosity and focus">
                </div>
                <div class="journey-image journey-image--small">
                    <img src="{{ asset('images/testimonials-child-steps.jpe') }}" alt="A child taking confident steps forward">
                </div>
                <div class="journey-quote-card">
                    <span aria-hidden="true">“</span>
                    <p>Every small practice adds another way to meet life with intention.</p>
                </div>
            </div>

            <div class="journey-copy reveal">
                <p class="section-kicker">The shape of a journey</p>
                <h2>Change does not need to be loud to be meaningful.</h2>
                <p>
                    A useful mind-training journey might begin with awareness,
                    move through guided practice and become a habit that feels natural
                    in everyday life.
                </p>

                <ol class="journey-steps">
                    <li>
                        <span>01</span>
                        <div><strong>Notice</strong>
                            <p>Become aware of attention, memory or learning patterns.</p>
                        </div>
                    </li>
                    <li>
                        <span>02</span>
                        <div><strong>Practise</strong>
                            <p>Try approachable tools with a clear purpose.</p>
                        </div>
                    </li>
                    <li>
                        <span>03</span>
                        <div><strong>Reflect</strong>
                            <p>Keep what helps and shape a routine around it.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <section class="reflections-section section-pad" id="participant-reflections">
        <x-home.leaf class="testimonials-botanical-leaf testimonials-botanical-leaf--reflections" />
        <x-home.leaf class="testimonials-botanical-leaf testimonials-botanical-leaf--reflections-top" />
        <x-home.leaf class="testimonials-botanical-leaf testimonials-botanical-leaf--reflections-right" />
        <div class="section-container">
            <header class="reflections-heading reveal">
                <div>
                    <p class="section-kicker">Participant reflections</p>
                    <h2>Real voices, shared with care</h2>
                </div>
                <p>Participant stories appear here with permission. We share the person’s own words without guessing, improving or inventing their experience.</p>
            </header>


            @if ($testimonials->isEmpty())
                <div class="reflection-layout">
                    <article class="reflection-feature reveal">
                        <span class="reflection-status">Coming soon</span>

                        <div class="reflection-feature-mark" aria-hidden="true">“</div>

                        <p>
                            Individual experiences will be shared here when participants
                            choose to contribute their reflections.
                        </p>

                        <div class="reflection-feature-footer">
                            <span></span>
                            <small>
                                Participant name and context<br>
                                will only appear with permission
                            </small>
                        </div>
                    </article>

                    <div class="reflection-aside reveal">
                        <div class="reflection-seal">
                            <span aria-hidden="true">✦</span>
                            <strong>Respectful<br>storytelling</strong>
                        </div>

                        <p>
                            We believe a learner’s story should remain personal,
                            specific and honestly told.
                        </p>

                        <a href="{{ route('programs') }}" class="text-link">
                            Explore the learning paths
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            @else
                <div class="reflection-cards">
                    @foreach ($testimonials as $testimonial)
                        @php
                            $nameParts = preg_split('/\s+/', trim((string) $testimonial->learner_name)) ?: [];
                            $initials = collect($nameParts)
                                ->filter()
                                ->take(2)
                                ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
                                ->implode('');
                        @endphp
                        <article class="reflection-card reveal">
                            <div class="reflection-card-top">
                                <span class="reflection-card-mark" aria-hidden="true">“</span>
                                <span class="reflection-card-badge">Participant story</span>
                            </div>
                            <p class="reflection-card-quote">{{ $testimonial->quote }}</p>
                            <div class="reflection-card-footer">
                                @if ($testimonial->photo_url)
                                    <img
                                        class="reflection-card-avatar reflection-card-avatar--photo"
                                        src="{{ $testimonial->photo_url }}"
                                        alt="{{ $testimonial->learner_name }}"
                                        width="44"
                                        height="44"
                                        loading="lazy"
                                    >
                                @else
                                    <span class="reflection-card-avatar" aria-hidden="true">{{ $initials !== '' ? $initials : 'MT' }}</span>
                                @endif
                                <div>
                                    <strong>{{ $testimonial->learner_name }}</strong>
                                    @if ($testimonial->program_or_role)
                                        <span>{{ $testimonial->program_or_role }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach

                    @if ($testimonials->count() < 6)
                        <article class="reflection-card reflection-card--coming reveal">
                            <div class="reflection-card-top">
                                <span class="reflection-card-mark" aria-hidden="true">“</span>
                                <span class="reflection-card-badge">Upcoming</span>
                            </div>
                            <p class="reflection-card-quote">More client stories coming soon.</p>
                            <div class="reflection-card-footer">
                                <span class="reflection-card-avatar" aria-hidden="true">✦</span>
                                <div>
                                    <strong>Shared with care</strong>
                                    <span>New reflections will appear here with permission</span>
                                </div>
                            </div>
                        </article>
                    @endif
                </div>
            @endif

        </div>
    </section>
</main>

<x-layout.mind-training-cta
    eyebrow="Your next step"
    title="Your next step could be the start of a new story."
    description="Explore how mind training can support everyday learning, focus and personal growth."
    button-text="Explore programs"
    :button-url="route('programs')" />

<x-layout.footer />
@endsection