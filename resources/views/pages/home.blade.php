@extends('layouts.app')

@section('title', 'Mind Training for Focus, Memory & Personal Growth')

@section('meta_description', 'Explore practical mind and memory training for stronger focus, confident learning and personal growth. Programs for students, professionals and teams.')

@push('styles')
    @vite(['resources/css/pages/home.css', 'resources/css/pages/programs.css'])
@endpush

@section('content')
    <x-layout.navbar />

    <main>
        <x-home.hero />

        <section class="home-pillars" aria-label="Mind training skills">
            <div class="section-container pillars-grid">
                <article class="pillar-item">
                    <span class="pillar-icon" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none"><circle cx="16" cy="16" r="11"/><circle cx="16" cy="16" r="5"/><path d="M16 2v3m0 22v3M2 16h3m22 0h3"/></svg>
                    </span>
                    <span>Focus &amp; attention</span>
                </article>
                <article class="pillar-item">
                    <span class="pillar-icon" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none"><path d="M16 6c-3-3-8-1-8 4-4 1-5 6-2 9-2 4 1 8 5 7 1 3 4 4 5 2V6Zm0 0c3-3 8-1 8 4 4 1 5 6 2 9 2 4-1 8-5 7-1 3-4 4-5 2V6Z"/><path d="M16 8v17m-6-12c3 0 4 2 4 4m8-4c-3 0-4 2-4 4"/></svg>
                    </span>
                    <span>Memory &amp; recall</span>
                </article>
                <article class="pillar-item">
                    <span class="pillar-icon" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none"><path d="M6 25V15m7 10V9m7 16v-7m7 7V5"/><path d="m5 11 8-5 7 5 8-8"/></svg>
                    </span>
                    <span>Confident learning</span>
                </article>
                <article class="pillar-item">
                    <span class="pillar-icon" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none"><path d="M16 27C8 23 6 17 10 11c3 2 5 6 6 12 1-6 3-10 6-12 4 6 2 12-6 16Z"/><path d="M16 26V5"/></svg>
                    </span>
                    <span>Personal growth</span>
                </article>
            </div>
        </section>

        <section class="mind-intro section-pad" id="training-approach">
            <div class="section-container intro-grid">
                <div class="mind-visual reveal" role="img" aria-label="A visual map of focus, memory and growth skills with connected illustrations">
                    <div class="mind-visual-orbit orbit-outer"></div>
                    <div class="mind-visual-orbit orbit-inner"></div>
                    <div class="mind-visual-center">
                        <svg viewBox="0 0 64 64" fill="none" aria-hidden="true">
                            <path d="M32 13c-5-7-16-3-16 5-8 1-11 12-5 17-3 8 4 16 12 14 2 6 8 7 9 2V13Z"/>
                            <path d="M32 13c5-7 16-3 16 5 8 1 11 12 5 17 3 8-4 16-12 14-2 6-8 7-9 2V13Z"/>
                            <path d="M22 22c5 0 7 4 7 8m-15 3c5-2 10 0 11 5m17-16c-5 0-7 4-7 8m15 3c-5-2-10 0-11 5M32 19v31"/>
                        </svg>
                        <span>Mind training</span>
                    </div>
                    <x-home.mind-skill-callout skill="focus" number="01" label="Focus" caption="Stay present" class="mind-visual-callout--focus mind-skill-callout--image-left" />
                    <x-home.mind-skill-callout skill="memory" number="02" label="Memory" caption="Recall clearly" class="mind-visual-callout--memory" />
                    <x-home.mind-skill-callout skill="growth" number="03" label="Growth" caption="Keep growing" class="mind-visual-callout--growth" />
                    <p class="mind-visual-caption">Small steps. Stronger skills.</p>
                </div>

                <div class="intro-copy reveal">
                    <p class="section-kicker">A practical approach</p>
                    <h2>Your mind is trainable. Start with the skills you use every day.</h2>
                    <p>Mind and memory training turns big goals into useful everyday practices. Explore ways to strengthen attention, remember what matters and build learning habits that work for you.</p>
                    <ul class="intro-points">
                        <li><span aria-hidden="true">✓</span> Strategies you can practise in daily life</li>
                        <li><span aria-hidden="true">✓</span> A learning experience shaped around your goals</li>
                        <li><span aria-hidden="true">✓</span> Skills for study, work and personal growth</li>
                    </ul>
                    <a href="{{ route('about') }}" class="text-link">Get to know our approach <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </section>

        <section class="skills-section section-pad">
            <div class="section-container">
                <header class="section-heading reveal">
                    <p class="section-kicker">Everyday skills</p>
                    <h2>Make more room for what matters</h2>
                    <p>Build practical skills you can bring to learning, work and life.</p>
                </header>

                <div class="skills-grid">
                    <article class="skill-card reveal">
                        <span class="skill-number">01</span>
                        <span class="skill-card-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="15"/><circle cx="24" cy="24" r="7"/><path d="M24 4v5m0 30v5M4 24h5m30 0h5"/></svg>
                        </span>
                        <h3>Focus &amp; concentration</h3>
                        <p>Practise bringing your attention back to the task, lesson or conversation in front of you.</p>
                    </article>
                    <article class="skill-card reveal">
                        <span class="skill-number">02</span>
                        <span class="skill-card-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none"><path d="M15 10c-6 0-9 5-8 10-4 5-1 11 4 12 1 6 8 8 13 4V12c-2-2-5-3-9-2Zm18 0c6 0 9 5 8 10 4 5 1 11-4 12-1 6-8 8-13 4V12c2-2 5-3 9-2Z"/><path d="M24 12v24m-11-17c4 0 6 2 6 5m16-5c-4 0-6 2-6 5"/></svg>
                        </span>
                        <h3>Memory &amp; recall</h3>
                        <p>Explore simple ways to organise information and make remembering feel less overwhelming.</p>
                    </article>
                    <article class="skill-card reveal">
                        <span class="skill-number">03</span>
                        <span class="skill-card-icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none"><path d="M9 38V24m10 14V14m10 24V20m10 18V8"/><path d="m7 19 12-9 10 6L41 6"/></svg>
                        </span>
                        <h3>Learning &amp; confidence</h3>
                        <p>Build steady routines and find approaches that help you learn with greater clarity and confidence.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="audience-section section-pad">
            <div class="section-container audience-layout">
                <header class="audience-heading reveal">
                    <p class="section-kicker">Made for real life</p>
                    <h2>Different goals. One thoughtful starting point.</h2>
                    <p>Mind training can be shaped around the way you learn, work and grow.</p>
                    <a href="{{ route('programs') }}" class="btn btn-outline-green">Find your program <span aria-hidden="true">↗</span></a>
                </header>

                <div class="audience-list">
                    <article class="audience-card reveal">
                        <span class="audience-card-number">01</span>
                        <div><h3>Students &amp; learners</h3><p>Useful study habits, focus strategies and memory techniques for learning with more purpose.</p></div>
                        <span class="audience-arrow" aria-hidden="true">↗</span>
                    </article>
                    <article class="audience-card reveal">
                        <span class="audience-card-number">02</span>
                        <div><h3>Personal growth</h3><p>Practical ways to nurture self-awareness, confidence and positive everyday habits.</p></div>
                        <span class="audience-arrow" aria-hidden="true">↗</span>
                    </article>
                    <article class="audience-card reveal">
                        <span class="audience-card-number">03</span>
                        <div><h3>Professionals &amp; teams</h3><p>Explore focus, communication and wellbeing practices for a more intentional workday.</p></div>
                        <span class="audience-arrow" aria-hidden="true">↗</span>
                    </article>
                </div>
            </div>
        </section>

        <section class="coach-section section-pad">
            <x-home.leaf class="botanical-leaf--coach reveal" />
            <div class="section-container coach-grid">
                <div class="coach-visual reveal" role="img" aria-label="Illustration of a one-to-one mind training session">
                    <div class="coach-visual-orbit orbit-large"></div>
                    <div class="coach-visual-orbit orbit-small"></div>
                    <div class="coach-session-card">
                        <div class="coach-card-top">
                            <span class="coach-status-dot"></span>
                            <span>One-to-one coaching</span>
                            <span class="coach-card-index">01 / 01</span>
                        </div>
                        <div class="coach-people-icon" aria-hidden="true">
                            <svg viewBox="0 0 80 80" fill="none">
                                <circle cx="40" cy="27" r="13"/>
                                <path d="M17 68c1-13 9-21 23-21s22 8 23 21"/>
                                <path d="M15 20a8 8 0 1 0 0 16m50-16a8 8 0 1 1 0 16M5 57c1-7 5-11 12-12m46 0c7 1 11 5 12 12"/>
                            </svg>
                        </div>
                        <p class="coach-card-label">Your goals, your pace</p>
                        <h3>A space to learn<br>and grow.</h3>
                        <div class="coach-card-tags"><span>Focus</span><span>Memory</span><span>Learning</span></div>
                    </div>
                    <div class="coach-floating-note"><span class="coach-note-check">✓</span><span><strong>Made personal</strong><small>Built around your goals</small></span></div>
                </div>

                <div class="coach-copy reveal">
                    <p class="section-kicker">Learn with a coach</p>
                    <h2>Personal guidance for the way you think and learn.</h2>
                    <p>Work one-to-one with a coach to explore your goals, practise useful techniques and find approaches that fit your daily routine.</p>
                    <div class="coach-steps">
                        <div><span>01</span><p><strong>Start with your goals</strong><small>Choose the skill you want to work on.</small></p></div>
                        <div><span>02</span><p><strong>Find practical tools</strong><small>Explore strategies for focus, memory or learning.</small></p></div>
                        <div><span>03</span><p><strong>Keep practising</strong><small>Take useful ideas into everyday life.</small></p></div>
                    </div>
                    <a href="{{ route('contact') }}" class="text-link">Talk to a coach <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </section>

        <section class="services-section section-pad">
            <x-home.leaf class="botanical-leaf--services reveal" />
            <div class="section-container">
                <header class="section-heading reveal">
                    <p class="section-kicker">Explore our services</p>
                    <h2>Find the kind of training that fits your goals</h2>
                    <p>Choose a personal session, focused practice or a shared learning experience.</p>
                </header>

                <div class="program-offers-grid home-programs-grid">
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
                                <p>New learning formats will appear here as they become available.</p>
                                <a href="{{ route('programs') }}" class="btn btn-primary program-card-cta">View all programs <span aria-hidden="true">→</span></a>
                            </div>
                        </article>
                    @endif
                </div>
                <div class="services-action reveal"><a href="{{ route('programs') }}" class="btn btn-outline-green">View all programs <span aria-hidden="true">→</span></a></div>
            </div>
        </section>

        <section class="insights-section section-pad">
            <x-home.leaf class="botanical-leaf--insights reveal" />
            <div class="section-container">
                <div class="insights-heading reveal">
                    <div>
                        <p class="section-kicker">From the mind training blog</p>
                        <h2>Ideas to take into everyday life</h2>
                        <p>Explore practical topics around attention, memory and learning.</p>
                    </div>
                    <a href="{{ route('blogs') }}" class="text-link">Visit the blog <span aria-hidden="true">→</span></a>
                </div>

                <div class="insights-grid">
                    <article class="insight-card reveal">
                        <div class="insight-art insight-art-focus" aria-hidden="true">
                            <svg viewBox="0 0 64 64" fill="none"><circle cx="32" cy="32" r="21"/><circle cx="32" cy="32" r="11"/><circle cx="32" cy="32" r="3"/><path d="M32 4v7m0 42v7M4 32h7m42 0h7"/></svg>
                            <span>FOCUS</span>
                        </div>
                        <div class="insight-copy"><p class="insight-category">Focus &amp; attention</p><h3>Make space for focused moments</h3><p>Small ways to bring your attention back to the task in front of you.</p><a href="{{ route('blogs') }}" aria-label="Read focus and attention insights">Read insight <span aria-hidden="true">→</span></a></div>
                    </article>
                    <article class="insight-card reveal">
                        <div class="insight-art insight-art-memory" aria-hidden="true">
                            <svg viewBox="0 0 64 64" fill="none"><path d="M32 10c-5-5-14-2-14 5-7 1-9 10-4 15-3 7 3 14 10 12 2 5 7 6 8 2V10Zm0 0c5-5 14-2 14 5 7 1 9 10 4 15 3 7-3 14-10 12-2 5-7 6-8 2V10Z"/><path d="M32 14v27m-9-19c4 0 6 3 6 6m12-6c-4 0-6 3-6 6"/></svg>
                            <span>MEMORY</span>
                        </div>
                        <div class="insight-copy"><p class="insight-category">Memory &amp; recall</p><h3>Remember more by making meaning</h3><p>Explore how organising ideas can make new information easier to revisit.</p><a href="{{ route('blogs') }}" aria-label="Read memory and recall insights">Read insight <span aria-hidden="true">→</span></a></div>
                    </article>
                    <article class="insight-card reveal">
                        <div class="insight-art insight-art-learning" aria-hidden="true">
                            <svg viewBox="0 0 64 64" fill="none"><path d="M10 15c9-3 16-1 22 4 6-5 13-7 22-4v34c-9-3-16-1-22 4-6-5-13-7-22-4V15Z"/><path d="M32 19v34m-14-27c4-1 7 0 10 1m18-1c-4-1-7 0-10 1m-18 7c4-1 7 0 10 1m18-1c-4-1-7 0-10 1"/></svg>
                            <span>LEARNING</span>
                        </div>
                        <div class="insight-copy"><p class="insight-category">Learning habits</p><h3>Build a routine that feels doable</h3><p>Start with a simple learning rhythm you can return to, one day at a time.</p><a href="{{ route('blogs') }}" aria-label="Read learning habits insights">Read insight <span aria-hidden="true">→</span></a></div>
                    </article>
                </div>
            </div>
        </section>

        <section class="stories-section section-pad">
            <x-home.leaf class="botanical-leaf--stories reveal" />
            <div class="section-container stories-layout">
                <div class="stories-heading reveal">
                    <p class="section-kicker">Learner stories</p>
                    <h2>Every learning journey is personal.</h2>
                    <p>We’re gathering first-hand feedback so this space can share real experiences from learners, coaches and teams.</p>
                    <a href="{{ route('testimonials') }}" class="text-link">Visit learner stories <span aria-hidden="true">→</span></a>
                </div>
                <div class="stories-note reveal">
                    @php $featuredStory = ($homeTestimonials ?? collect())->first(); @endphp
                    @if ($featuredStory)
                        @if ($featuredStory->photo_url)
                            <img
                                class="stories-note-avatar"
                                src="{{ $featuredStory->photo_url }}"
                                alt="{{ $featuredStory->learner_name }}"
                                width="56"
                                height="56"
                                loading="lazy"
                            >
                        @else
                            <svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M8 12h14v14H12c0 5 3 8 8 9v5C10 38 6 32 6 23V14c0-1 1-2 2-2Zm22 0h12v14h-9c0 5 3 8 8 9v5c-10-2-14-8-14-17v-9c0-1 1-2 3-2Z"/></svg>
                        @endif
                        <p>{{ \Illuminate\Support\Str::limit($featuredStory->quote, 120) }}</p>
                        <span>{{ $featuredStory->learner_name }}@if($featuredStory->program_or_role) · {{ $featuredStory->program_or_role }}@endif</span>
                    @else
                        <svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M8 12h14v14H12c0 5 3 8 8 9v5C10 38 6 32 6 23V14c0-1 1-2 2-2Zm22 0h12v14h-9c0 5 3 8 8 9v5c-10-2-14-8-14-17v-9c0-1 1-2 3-2Z"/></svg>
                        <p>Participant reflections will appear here soon.</p>
                        <span>We’ll share real voices, with permission.</span>
                    @endif
                </div>
            </div>
        </section>

        <x-layout.mind-training-cta
            eyebrow="Your next step"
            title="Make space for a stronger, more focused you."
            description="Start a conversation and find a mind training path that fits your goals."
            button-text="Talk to us"
            :button-url="route('contact')"
        />
    </main>

    <x-layout.footer />
@endsection
