
@extends('layouts.app')

@section('title', 'About Us | Mind Training for Everyday Growth')

@section('meta_description', 'Discover the philosophy behind Mind Training. Learn how our practical approach supports focus, memory, confident learning and personal growth.')

@push('styles')
    @vite('resources/css/pages/about.css')
@endpush

@section('content')
    <x-layout.navbar />

    <main>
        {{-- About hero --}}
        <section class="about-hero">
            <div class="about-hero-decoration about-hero-decoration--one"></div>
            <div class="about-hero-decoration about-hero-decoration--two"></div>

            <div class="section-container about-hero-grid">
                <div class="about-hero-copy reveal">
                    <p class="section-kicker">A little about us</p>
                    <h1>A more thoughtful way to <span>learn, grow and thrive.</span></h1>
                    <p>
                        We believe that the mind is something we can keep exploring.
                        With practical training and consistent practice, everyday skills
                        like focus, memory and learning can become more intentional.
                    </p>
                    <div class="about-hero-actions">
                        <a href="{{ route('programs') }}" class="btn btn-primary">
                            Explore our programs <span aria-hidden="true">↗</span>
                        </a>
                        <a href="#our-approach" class="text-link">
                            Discover our approach <span aria-hidden="true">↓</span>
                        </a>
                    </div>
                    <div class="about-hero-note">
                        <span aria-hidden="true">✳</span>
                        <p>Small steps can shape meaningful change.</p>
                    </div>
                </div>

                <div class="about-hero-visual reveal" role="img" aria-label="Decorative illustration representing mindful learning and personal growth">
                    <div class="about-hero-sun"></div>
                    <div class="about-hero-orbit about-hero-orbit--outer"></div>
                    <div class="about-hero-orbit about-hero-orbit--inner"></div>

                    <div class="about-hero-plant about-hero-plant--left">
                        <svg viewBox="0 0 130 230" fill="none" aria-hidden="true">
                            <path d="M65 220C64 160 66 105 65 18" stroke="currentColor" stroke-width="2"/>
                            <path d="M65 170C34 158 19 137 22 111C49 116 65 137 65 170Z" fill="#8DAE72" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M65 135C91 121 103 99 98 77C75 83 64 103 65 135Z" fill="#A6BD83" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M65 101C39 88 31 67 39 47C60 56 68 76 65 101Z" fill="#73975D" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M65 67C82 55 87 38 79 22C64 31 59 48 65 67Z" fill="#B8C995" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                    </div>

                    <div class="about-hero-center">
                        <span class="about-center-symbol" aria-hidden="true">
                            <svg viewBox="0 0 80 80" fill="none">
                                <path d="M40 17C33 8 19 13 20 24C10 27 9 40 17 46C13 57 23 68 34 64C37 73 45 73 40 63V17Z"/>
                                <path d="M40 17C47 8 61 13 60 24C70 27 71 40 63 46C67 57 57 68 46 64C43 73 35 73 40 63V17Z"/>
                                <path d="M40 20V62M25 30C32 30 35 35 35 41M55 30C48 30 45 35 45 41"/>
                            </svg>
                        </span>
                        <span class="about-center-title">Mind Training</span>
                        <span class="about-center-subtitle">Learn with intention</span>
                    </div>

                    <x-home.mind-skill-callout skill="focus" number="01" label="Focus" caption="Stay present" class="about-floating-card--top mind-skill-callout--image-left" />
                    <x-home.mind-skill-callout skill="growth" number="02" label="Growth" caption="Keep exploring" class="about-floating-card--bottom" />

                    <p class="about-visual-caption">A journey of everyday growth</p>
                </div>
            </div>
        </section>

        {{-- Our purpose --}}
        <section class="about-purpose section-pad">
            <x-home.leaf class="about-botanical-leaf about-botanical-leaf--purpose reveal" />

            <div class="section-container about-purpose-grid">
                <div class="about-purpose-label reveal">
                    <p class="section-kicker">Why we are here</p>
                    <span class="about-big-number">01</span>
                    <span class="about-number-caption">Our purpose</span>
                </div>

                <div class="about-purpose-copy reveal">
                    <h2>Helping people make the most of the mind they use every day.</h2>
                    <p>
                        Learning, remembering, concentrating and making decisions are
                        part of everyday life. Yet, we rarely pause to think about how
                        we use these abilities or how we might develop them.
                    </p>
                    <p>
                        Mind Training is built around making these skills easier to
                        understand and practise. We bring attention to small, useful
                        techniques that people can explore in their studies, work
                        and personal lives.
                    </p>
                    <div class="about-purpose-quote">
                        <span aria-hidden="true">“</span>
                        <p>Growth begins when we become more intentional about how we learn.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Philosophy --}}
        <section class="about-philosophy section-pad" id="our-approach">
            <x-home.leaf class="about-botanical-leaf about-botanical-leaf--philosophy reveal" />

            <div class="section-container">
                <header class="section-heading reveal">
                    <p class="section-kicker">Our philosophy</p>
                    <h2>Progress doesn't have to be complicated.</h2>
                    <p>
                        We believe meaningful development can begin with simple ideas,
                        thoughtful guidance and regular practice.
                    </p>
                </header>

                <div class="philosophy-grid">
                    <article class="philosophy-card reveal">
                        <span class="philosophy-number">01</span>
                        <span class="philosophy-icon philosophy-icon--focus" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="16"/>
                                <circle cx="24" cy="24" r="7"/>
                                <path d="M24 3v6m0 30v6M3 24h6m30 0h6"/>
                            </svg>
                        </span>
                        <h3>Understand your mind</h3>
                        <p>
                            Become more aware of how you pay attention, process
                            information and approach everyday challenges.
                        </p>
                    </article>

                    <article class="philosophy-card reveal">
                        <span class="philosophy-number">02</span>
                        <span class="philosophy-icon philosophy-icon--practice" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none">
                                <path d="M24 7C17 1 7 7 10 16C3 21 8 33 17 32C18 41 29 44 32 35C42 36 46 24 38 18C42 9 31 3 24 7Z"/>
                                <path d="M24 9v27m-9-17c4 0 7 3 7 7m11-7c-4 0-7 3-7 7"/>
                            </svg>
                        </span>
                        <h3>Practise with purpose</h3>
                        <p>
                            Explore practical exercises and techniques that connect
                            learning goals with everyday routines.
                        </p>
                    </article>

                    <article class="philosophy-card reveal">
                        <span class="philosophy-number">03</span>
                        <span class="philosophy-icon philosophy-icon--growth" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none">
                                <path d="M24 41V20"/>
                                <path d="M24 29C11 29 7 20 9 10C19 10 25 17 24 29Z"/>
                                <path d="M24 22C24 11 31 5 41 6C42 17 35 24 24 22Z"/>
                            </svg>
                        </span>
                        <h3>Grow step by step</h3>
                        <p>
                            Make room for reflection, consistency and gradual
                            improvement at a pace that feels realistic.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        {{-- What makes the approach thoughtful --}}
        <section class="about-beliefs section-pad">
            <div class="section-container about-beliefs-grid">
                <div class="about-beliefs-visual reveal">
                    <div class="beliefs-visual-ring beliefs-visual-ring--one"></div>
                    <div class="beliefs-visual-ring beliefs-visual-ring--two"></div>
                    <div class="beliefs-visual-leaf">
                        <svg viewBox="0 0 180 220" fill="none" aria-hidden="true">
                            <path d="M88 202C83 143 88 78 91 17" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M88 159C46 158 22 130 28 91C66 95 88 119 88 159Z" fill="#86A96B" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M89 126C127 116 148 89 139 53C105 61 87 88 89 126Z" fill="#B0C58D" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M90 85C58 74 48 49 61 23C87 37 96 58 90 85Z" fill="#6F965D" stroke="currentColor" stroke-width="1.8"/>
                        </svg>
                    </div>
                    <div class="beliefs-stamp">
                        <span>THOUGHTFUL</span>
                        <strong>by nature</strong>
                        <span>GROWING BY PRACTICE</span>
                    </div>
                </div>

                <div class="about-beliefs-copy reveal">
                    <p class="section-kicker">What guides us</p>
                    <h2>People are different. Their learning journeys should be, too.</h2>
                    <p>
                        There isn't one approach that works the same way for everyone.
                        A student's learning goals may look different from a professional's
                        or a team's. That's why we value an approach that starts by
                        understanding the person and what they want to work towards.
                    </p>

                    <div class="belief-list">
                        <div>
                            <span>01</span>
                            <p><strong>Personal and purposeful</strong><small>Start with the goals and skills that matter to you.</small></p>
                        </div>
                        <div>
                            <span>02</span>
                            <p><strong>Practical and approachable</strong><small>Focus on ideas that can be explored in everyday life.</small></p>
                        </div>
                        <div>
                            <span>03</span>
                            <p><strong>Consistent and encouraging</strong><small>Make progress through small steps and regular practice.</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Who it is for --}}
        <section class="about-audience section-pad">
            <x-home.leaf class="about-botanical-leaf about-botanical-leaf--audience reveal" />

            <div class="section-container">
                <div class="about-audience-heading reveal">
                    <div>
                        <p class="section-kicker">Learning for every stage</p>
                        <h2>Different people. Different goals. Room to grow.</h2>
                    </div>
                    <p>
                        Our areas of focus can support people across learning,
                        professional life and personal development.
                    </p>
                </div>

                <div class="about-audience-grid">
                    <article class="about-audience-card reveal">
                        <span class="audience-card-index">01 / LEARN</span>
                        <div class="about-audience-art audience-art--learn" aria-hidden="true">
                            <svg viewBox="0 0 64 64" fill="none">
                                <path d="M8 15c9-3 17-1 24 5 7-6 15-8 24-5v35c-9-3-17-1-24 5-7-6-15-8-24-5V15Z"/>
                                <path d="M32 20v35m-16-27c5-1 9 0 12 2m20-2c-5-1-9 0-12 2"/>
                            </svg>
                        </div>
                        <h3>Students & learners</h3>
                        <p>Explore focus, memory and study habits that support more intentional learning.</p>
                    </article>

                    <article class="about-audience-card reveal">
                        <span class="audience-card-index">02 / DEVELOP</span>
                        <div class="about-audience-art audience-art--develop" aria-hidden="true">
                            <svg viewBox="0 0 64 64" fill="none">
                                <circle cx="32" cy="22" r="11"/>
                                <path d="M12 55c1-13 8-20 20-20s19 7 20 20"/>
                                <path d="m25 23 5 5 10-12"/>
                            </svg>
                        </div>
                        <h3>Personal growth</h3>
                        <p>Build awareness, confidence and everyday habits that encourage continued development.</p>
                    </article>

                    <article class="about-audience-card reveal">
                        <span class="audience-card-index">03 / WORK TOGETHER</span>
                        <div class="about-audience-art audience-art--teams" aria-hidden="true">
                            <svg viewBox="0 0 64 64" fill="none">
                                <circle cx="32" cy="19" r="9"/>
                                <circle cx="13" cy="25" r="6"/>
                                <circle cx="51" cy="25" r="6"/>
                                <path d="M15 54c1-10 7-16 17-16s16 6 17 16M3 51c1-8 4-12 11-13m47 13c-1-8-4-12-11-13"/>
                            </svg>
                        </div>
                        <h3>Professionals & teams</h3>
                        <p>Explore practical approaches to focus, communication and a more mindful workday.</p>
                    </article>
                </div>
            </div>
        </section>

        <x-layout.mind-training-cta
            eyebrow="A thoughtful next step"
            title="Find a mind training path that feels right for you."
            description="Whether you want to strengthen focus, memory or everyday learning, we can help you explore a practical place to begin."
            button-text="Get in touch"
            :button-url="route('contact')"
        />
    </main>

    <x-layout.footer />
@endsection
