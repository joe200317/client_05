@extends('layouts.app')

@section('title', 'Contact Mind Training | Begin a Thoughtful Conversation')

@section('meta_description', 'Contact Mind Training to ask about focus, memory, learning and personal growth programs.')

@push('styles')
    @vite('resources/css/pages/contact.css')
@endpush

@section('content')
    <x-layout.navbar />

    <main>
        <section class="contact-hero">
            <x-home.leaf class="contact-botanical-leaf contact-botanical-leaf--hero" />
            <div class="contact-hero-ring contact-hero-ring--one" aria-hidden="true"></div>
            <div class="contact-hero-ring contact-hero-ring--two" aria-hidden="true"></div>

            <div class="section-container contact-hero-grid">
                <div class="contact-hero-copy reveal">
                    <p class="section-kicker">Contact Mind Training</p>
                    <h1>Let’s find a thoughtful place to <span>begin.</span></h1>
                    <p>
                        Share what you would like to explore—focus, memory, learning,
                        personal growth or a training program for your team.
                    </p>
                    <div class="contact-hero-actions">
                        <a href="#contact-form" class="btn btn-primary">Start a conversation <span aria-hidden="true">↓</span></a>
                        <a href="{{ route('programs') }}" class="text-link">Explore programs <span aria-hidden="true">→</span></a>
                    </div>
                </div>

                <div class="contact-hero-visual reveal" aria-label="Mind Training contact illustration">
                    <div class="contact-orbit contact-orbit--outer" aria-hidden="true"></div>
                    <div class="contact-orbit contact-orbit--inner" aria-hidden="true"></div>
                    <span class="contact-satellite contact-satellite--one" aria-hidden="true"></span>
                    <span class="contact-satellite contact-satellite--two" aria-hidden="true"></span>

                    <div class="contact-lotus-card">
                        <span class="contact-lotus-icon">
                            <img src="{{ asset('images/mind-training-lotus-mark.png') }}" alt="">
                        </span>
                        <strong>Mind Training</strong>
                        <small>A conversation is a good beginning</small>
                        <div class="contact-lotus-lines" aria-hidden="true">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-main section-pad">
            <div class="section-container contact-main-grid">
                <aside class="contact-details reveal">
                    <p class="section-kicker">Ways to connect</p>
                    <h2>A simple place to start</h2>
                    <p>
                        Tell us what feels relevant now. We can help you identify a
                        practical program or the right next question.
                    </p>

                    <div class="contact-detail-list">
                        <a href="mailto:hello@mindtraining.com" class="contact-detail">
                            <span class="contact-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 48 48" fill="none">
                                    <rect x="7" y="11" width="34" height="26" rx="5"/>
                                    <path d="m9 14 15 12 15-12"/>
                                </svg>
                            </span>
                            <span><small>Email us</small><strong>hello@mindtraining.com</strong></span>
                        </a>

                        <a href="tel:+919876543210" class="contact-detail">
                            <span class="contact-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 48 48" fill="none">
                                    <path d="M15 7 9 10c-3 2-2 10 4 18s16 14 20 12l5-5-9-8-5 4c-4-2-7-5-9-9l4-5-4-10Z"/>
                                </svg>
                            </span>
                            <span><small>Call us</small><strong>+91 98765 43210</strong></span>
                        </a>

                        <div class="contact-detail">
                            <span class="contact-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 48 48" fill="none">
                                    <path d="M24 42s14-13 14-26A14 14 0 0 0 10 16c0 13 14 26 14 26Z"/>
                                    <circle cx="24" cy="16" r="5"/>
                                </svg>
                            </span>
                            <span><small>Visit us</small><strong>Pune, Maharashtra</strong></span>
                        </div>
                    </div>

                    <div class="contact-hours">
                        <span aria-hidden="true">✦</span>
                        <p><strong>Conversation hours</strong><small>Monday–Friday · 9:30 am–6:00 pm</small></p>
                    </div>
                </aside>

                <form class="contact-form reveal" id="contact-form" action="{{ route('contact.store') }}" method="post">
                    @csrf
                    <div class="contact-form-heading">
                        <p class="section-kicker">Send a message</p>
                        <h2>Tell us what you are exploring</h2>
                    </div>

                    @if (session('status'))
                        <div class="contact-form-status" role="status">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="contact-form-error" role="alert">{{ $errors->first() }}</div>
                    @endif

                    <div class="contact-form-grid">
                        <label>
                            <span>Full name</span>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required>
                        </label>
                        <label>
                            <span>Email address</span>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                        </label>
                        <label>
                            <span>Phone number <small>Optional</small></span>
                            <input type="tel" name="phone" value="{{ old('phone') }}" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" placeholder="00000 00000">
                        </label>
                        <label>
                            <span>I am interested in</span>
                            <select class="contact-native-select" name="interest" required aria-hidden="true" tabindex="-1">
                                <option value="">Choose a focus</option>
                                @foreach ([
                                    'Focus and attention',
                                    'Memory and recall',
                                    'Mindset and emotional tools',
                                    'Trainer and facilitator programs',
                                    'Mindfulness and stress skills',
                                    'Workplace wellbeing',
                                ] as $interest)
                                    <option value="{{ $interest }}" @selected(old('interest') === $interest)>{{ $interest }}</option>
                                @endforeach
                            </select>
                            <button class="contact-dropdown" type="button" aria-haspopup="listbox" aria-expanded="false">
                                <span class="contact-dropdown-value">{{ old('interest') ?: 'Choose a focus' }}</span>
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m7 10 5 5 5-5"/>
                                </svg>
                            </button>
                            <div class="contact-dropdown-menu" role="listbox" aria-label="I am interested in">
                                <button type="button" role="option" data-value="">Choose a focus</button>
                                <button type="button" role="option" data-value="Focus and attention">Focus and attention</button>
                                <button type="button" role="option" data-value="Memory and recall">Memory and recall</button>
                                <button type="button" role="option" data-value="Mindset and emotional tools">Mindset and emotional tools</button>
                                <button type="button" role="option" data-value="Trainer and facilitator programs">Trainer and facilitator programs</button>
                                <button type="button" role="option" data-value="Mindfulness and stress skills">Mindfulness and stress skills</button>
                                <button type="button" role="option" data-value="Workplace wellbeing">Workplace wellbeing</button>
                            </div>
                        </label>
                    </div>

                    <label class="contact-form-message">
                        <span>How can we help?</span>
                        <textarea name="message" rows="5" placeholder="Share a little about your goal or question" required>{{ old('message') }}</textarea>
                    </label>

                    <button type="submit" class="btn btn-primary">
                        Send message <span aria-hidden="true">→</span>
                    </button>
                </form>
            </div>
        </section>

        <section class="contact-paths section-pad">
            <div class="section-container">
                <header class="section-heading reveal">
                    <p class="section-kicker">Choose a starting point</p>
                    <h2>Every conversation can begin differently</h2>
                </header>

                <div class="contact-path-grid">
                    <article class="contact-path-card reveal">
                        <span>01</span>
                        <h3>Personal growth</h3>
                        <p>Explore focus, memory and mindset practices for your own everyday goals.</p>
                        <a href="{{ route('programs') }}" class="text-link">View programs <span aria-hidden="true">→</span></a>
                    </article>
                    <article class="contact-path-card reveal">
                        <span>02</span>
                        <h3>Trainer pathway</h3>
                        <p>Ask about session facilitation, trainer tracks and thoughtful learning formats.</p>
                        <a href="{{ route('programs') }}" class="text-link">Explore training <span aria-hidden="true">→</span></a>
                    </article>
                    <article class="contact-path-card reveal">
                        <span>03</span>
                        <h3>Teams and workshops</h3>
                        <p>Discuss workplace focus, communication, wellbeing and shared practice.</p>
                        <a href="{{ route('programs') }}" class="text-link">Plan a session <span aria-hidden="true">→</span></a>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <x-layout.mind-training-cta
        eyebrow="A thoughtful next step"
        title="Let’s find a good place to begin."
        description="Share what you’re hoping to work on, and we’ll help connect you with a mind training path."
        button-text="Explore programs"
        :button-url="route('programs')"
    />

    <x-layout.footer />
@endsection
