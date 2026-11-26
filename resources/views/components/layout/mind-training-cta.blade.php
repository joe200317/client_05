@props([
    'eyebrow',
    'title',
    'description',
    'buttonText',
    'buttonUrl',
])

<section class="mind-training-cta">
    <div class="section-container">
        <div class="mind-training-cta-card reveal">
            <div class="mind-training-cta-copy">
                <p class="section-kicker">{{ $eyebrow }}</p>
                <h2>{{ $title }}</h2>
                <p>{{ $description }}</p>
                <a href="{{ $buttonUrl }}" class="btn btn-light">
                    {{ $buttonText }} <span aria-hidden="true">→</span>
                </a>
            </div>

            <div class="mind-training-cta-visual" aria-hidden="true">
                <div class="mind-training-cta-orbit mind-training-cta-orbit--outer"></div>
                <div class="mind-training-cta-orbit mind-training-cta-orbit--inner"></div>
                <span class="mind-training-cta-satellite mind-training-cta-satellite--outer"></span>
                <span class="mind-training-cta-satellite mind-training-cta-satellite--inner"></span>

                <div class="mind-training-cta-center">
                    <svg viewBox="0 0 80 80" fill="none">
                        <path d="M40 17C33 8 19 13 20 24C10 27 9 40 17 46C13 57 23 68 34 64C37 73 45 73 40 63V17Z"/>
                        <path d="M40 17C47 8 61 13 60 24C70 27 71 40 63 46C67 57 57 68 46 64C43 73 35 73 40 63V17Z"/>
                        <path d="M40 20V62M25 30C32 30 35 35 35 41M55 30C48 30 45 35 45 41"/>
                    </svg>
                    <strong>Mind Training</strong>
                    <span>Focus · Memory · Growth</span>
                </div>

                <div class="mind-training-cta-chip mind-training-cta-chip--focus"><span>01</span>Focus</div>
                <div class="mind-training-cta-chip mind-training-cta-chip--memory"><span>02</span>Memory</div>
                <div class="mind-training-cta-chip mind-training-cta-chip--growth"><span>03</span>Growth</div>
            </div>
        </div>
    </div>
</section>