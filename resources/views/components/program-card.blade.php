@props([
    'program',
    'index' => '01',
])

@php
    $hasLink = filled($program->button_link);
    $buttonLabel = $program->button_label ?: 'Book a Session';
@endphp

<article {{ $attributes->class(['program-offer-card', 'program-offer-card--rich', 'reveal']) }}>
    <div class="program-offer-media">
        @if ($program->thumbnail_url)
            <img src="{{ $program->thumbnail_url }}" alt="{{ $program->title }}">
        @else
            <div class="program-offer-media__fallback" aria-hidden="true">
                <span>✦</span>
            </div>
        @endif
        <span class="program-offer-index">{{ $index }}</span>
    </div>

    <div class="program-offer-body">
        <div class="program-offer-badges">
            <span>{{ $program->category }}</span>
            <span>{{ $program->type }}</span>
        </div>

        <h3>{{ $program->title }}</h3>
        <p>{{ $program->excerpt }}</p>

        @if ($program->schedule_or_format || $program->price)
            <div class="program-offer-meta">
                @if ($program->schedule_or_format)
                    <span>{{ $program->schedule_or_format }}</span>
                @endif
                @if ($program->price)
                    <span>₹{{ number_format((float) $program->price, 0) }}</span>
                @endif
            </div>
        @endif

        @if ($hasLink)
            <a href="{{ $program->button_link }}" class="btn btn-primary program-card-cta">
                {{ $buttonLabel }} <span aria-hidden="true">→</span>
            </a>
        @else
            <button
                type="button"
                class="btn btn-primary program-card-cta"
                data-open-session-modal
                data-program="{{ $program->title }}"
            >
                {{ $buttonLabel }} <span aria-hidden="true">→</span>
            </button>
        @endif
    </div>
</article>
