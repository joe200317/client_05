@extends('layouts.app')

@section('title', 'Mind Training Programs | Focus, Memory & Learning')

@section('meta_description', 'Explore practical mind training programs for focus, memory, confident learning and more mindful workdays.')

@push('styles')
    @vite('resources/css/pages/programs.css')
@endpush

@section('content')
    <x-layout.navbar />

    <main>
        <section class="programs-hero">
            <x-home.leaf class="programs-botanical-leaf programs-botanical-leaf--hero" />
            <div class="section-container programs-hero-grid">
                <div class="programs-hero-copy reveal">
                    <p class="section-kicker">Programs designed around real life</p>
                    <h1>Find a way to train the skills you use <span>every day.</span></h1>
                    <p>
                        Explore practical ways to work on focus, memory and learning.
                        Start with the area that matters to you, then build at a pace
                        that feels realistic.
                    </p>
                    <div class="programs-hero-actions">
                        <a href="#program-options" class="btn btn-primary">
                            Explore programs <span aria-hidden="true">↓</span>
                        </a>
                        <a href="{{ route('contact') }}" class="text-link">
                            Talk to a coach <span aria-hidden="true">→</span>
                        </a>
                    </div>
                    <div class="programs-hero-note">
                        <span aria-hidden="true">✳</span>
                        Personal practice. Practical tools. Progress at your pace.
                    </div>
                </div>

                <div class="programs-hero-visual reveal" role="img" aria-label="Mind training paths for focus, memory and learning with connected illustrations">
                    <div class="programs-hero-sun"></div>
                    <div class="programs-hero-orbit programs-hero-orbit--outer"></div>
                    <div class="programs-hero-orbit programs-hero-orbit--inner"></div>

                    <div class="programs-hero-center">
                        <svg viewBox="0 0 80 80" fill="none" aria-hidden="true">
                            <path d="M40 17C33 8 19 13 20 24C10 27 9 40 17 46C13 57 23 68 34 64C37 73 45 73 40 63V17Z"/>
                            <path d="M40 17C47 8 61 13 60 24C70 27 71 40 63 46C67 57 57 68 46 64C43 73 35 73 40 63V17Z"/>
                            <path d="M40 20V62M25 30C32 30 35 35 35 41M55 30C48 30 45 35 45 41"/>
                        </svg>
                        <strong>Your mind, in practice</strong>
                        <span>Choose a place to begin</span>
                    </div>

                    <x-home.mind-skill-callout skill="focus" number="01" label="Focus" caption="Stay present" class="programs-hero-callout--focus mind-skill-callout--image-left" />
                    <x-home.mind-skill-callout skill="memory" number="02" label="Memory" caption="Recall clearly" class="programs-hero-callout--memory" />
                    <x-home.mind-skill-callout skill="learning" number="03" label="Learning" caption="Build habits" class="programs-hero-callout--learning mind-skill-callout--image-left" />
                    <p class="programs-hero-caption">Small steps. Meaningful practice.</p>
                </div>
            </div>
        </section>

        <section class="program-skills-section section-pad" id="program-options">
            <x-home.leaf class="programs-botanical-leaf programs-botanical-leaf--options reveal" />
            <div class="section-container">
                <header class="section-heading reveal">
                    <p class="section-kicker">Key training areas</p>
                    <h2>Practical skills for <span>stronger learning</span></h2>
                    <p>
                        Explore techniques that support attention, memory, confidence
                        and everyday learning. Each skill can be practised in a way that
                        feels useful in real life.
                    </p>
                </header>

                <div class="program-skill-grid">
                    <article class="program-skill-card reveal">
                        <span>01</span>
                        <div class="program-skill-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="16"/><circle cx="24" cy="24" r="7"/><path d="M24 3v6m0 30v6M3 24h6m30 0h6"/></svg>
                        </div>
                        <h3>Memory improvement techniques</h3>
                        <p>Build stronger recall and retain information with practical memory methods.</p>
                    </article>
                    <article class="program-skill-card reveal">
                        <span>02</span>
                        <div class="program-skill-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="16"/><path d="M24 14v10l7 4"/></svg>
                        </div>
                        <h3>Concentration and focus development</h3>
                        <p>Train attention to stay clear, calm and consistent throughout a task.</p>
                    </article>
                    <article class="program-skill-card reveal">
                        <span>03</span>
                        <div class="program-skill-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none"><path d="M6 11c8-3 14-1 18 4 4-5 10-7 18-4v27c-8-3-14-1-18 4-4-5-10-7-18-4V11Z"/><path d="M24 15v27"/></svg>
                        </div>
                        <h3>Effective learning and study methods</h3>
                        <p>Organise study routines that make learning more structured and useful.</p>
                    </article>
                    <article class="program-skill-card reveal">
                        <span>04</span>
                        <div class="program-skill-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none"><path d="M24 41V19"/><path d="M24 28C14 28 9 22 10 14c8 0 14 5 14 14Z"/><path d="M24 22c0-9 5-14 14-14 1 8-4 14-14 14Z"/></svg>
                        </div>
                        <h3>Mind development exercises</h3>
                        <p>Strengthen thinking skills through guided and reflective practice.</p>
                    </article>
                    <article class="program-skill-card reveal">
                        <span>05</span>
                        <div class="program-skill-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none"><path d="M24 40S8 31 8 19a9 9 0 0 1 16-6 9 9 0 0 1 16 6c0 12-16 21-16 21Z"/><path d="M16 24h5l3-6 4 12 3-6h3"/></svg>
                        </div>
                        <h3>Confidence and personal development</h3>
                        <p>Build self-belief alongside your learning ability and everyday progress.</p>
                    </article>
                    <article class="program-skill-card reveal">
                        <span>06</span>
                        <div class="program-skill-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none"><path d="M24 40c-8-4-13-10-13-18 0-5 3-9 8-11 0 7 2 11 5 14 3-3 5-7 5-14 5 2 8 6 8 11 0 8-5 14-13 18Z"/><path d="M24 25v15"/></svg>
                        </div>
                        <h3>Learning habits and self-improvement</h3>
                        <p>Create lasting routines that support steady growth and improvement.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="program-approach-section section-pad">
            <div class="section-container">
                <article class="program-approach-card reveal">
                    <div class="program-approach-icon" aria-hidden="true">
                        <svg viewBox="0 0 48 48" fill="none"><path d="M24 40V19"/><path d="M24 28C14 28 9 22 10 14c8 0 14 5 14 14Z"/><path d="M24 22c0-9 5-14 14-14 1 8-4 14-14 14Z"/></svg>
                    </div>
                    <div>
                        <p class="section-kicker">Training approach</p>
                        <h2>Our approach brings practical learning, active participation and useful techniques into everyday life.</h2>
                    </div>
                </article>
            </div>
        </section>

        <section class="program-offers-section section-pad" id="available-programs">
            <div class="section-container">
                <header class="section-heading reveal">
                    <p class="section-kicker">Available programs</p>
                    <h2>Choose a place to begin.</h2>
                    <p>Explore the programs currently open, or get in touch to find a path that fits your goals.</p>
                </header>

                <div class="program-offers-grid">
                    @foreach ($programs as $program)
                        <x-program-card
                            :program="$program"
                            :index="str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT)"
                        />
                    @endforeach

                    @if ($programs->count() < 6)
                        <article class="program-offer-card program-offer-card--coming program-offer-card--rich reveal">
                            <div class="program-offer-media">
                                <div class="program-offer-media__fallback" aria-hidden="true"><span>✦</span></div>
                                <span class="program-offer-index">{{ str_pad((string) ($programs->count() + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="program-offer-body">
                                <div class="program-offer-badges"><span>Upcoming</span></div>
                                <h3>Upcoming programs</h3>
                                <p>New learning formats and Mind Trainer tracks will be added as they become available.</p>
                                <a href="{{ route('contact') }}" class="btn btn-primary program-card-cta">Stay in touch <span aria-hidden="true">→</span></a>
                            </div>
                        </article>
                    @endif
                </div>
            </div>
        </section>

        <x-layout.mind-training-cta
            eyebrow="Find your focus"
            title="Choose a program that meets you where you are."
            description="Tell us what you want to strengthen—focus, memory or learning—and we’ll help you find a practical next step."
            button-text="Talk about programs"
            :button-url="route('contact')"
        />
    </main>

    <x-layout.footer />
@endsection
