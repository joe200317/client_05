


<section class="hero-section" aria-labelledby="hero-title">
    <x-home.leaf class="botanical-leaf--hero" />
    <div class="hero-container">

        <div class="hero-content">
            <p class="hero-eyebrow"><span class="hero-eyebrow-mark" aria-hidden="true"></span> Practical Mind &amp; Memory Training</p>

            <h1 id="hero-title">
                Focus better.<br>
                <span class="hero-title-accent">Grow with confidence.</span>
            </h1>

            <p class="hero-description">
                Practical training for stronger focus, memory and learning habits —
                helping students, professionals and teams make room for meaningful growth.
            </p>

            <div class="hero-actions">
                <a href="{{ route('programs') }}" class="btn btn-primary hero-primary-action">
                    Explore Programs
                    <span aria-hidden="true">↗</span>
                </a>

                <a href="#training-approach" class="btn btn-outline hero-secondary-action">
                    How Training Works
                </a>
            </div>

            <p class="hero-reassurance"><span aria-hidden="true">✳</span> Personal practice. Practical tools. Progress at your pace.</p>
        </div>

        <div class="hero-image-wrapper">
            <img
                src="{{ asset('images/mindfulness-hero.png') }}"
                alt="Woman meditating among green plants in a peaceful wellness setting"
                class="hero-image"
                fetchpriority="high"
                width="768"
                height="823"
            >
            <div class="hero-image-note">
                <span class="hero-image-note-icon" aria-hidden="true">✳</span>
                <span><strong>A moment to reset</strong><small>Focus · Memory · Growth</small></span>
            </div>
        </div>

    </div>
</section>
