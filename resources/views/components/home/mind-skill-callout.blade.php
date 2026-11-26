@props([
    'skill',
    'number',
    'label',
    'caption',
])

<div {{ $attributes->merge(['class' => 'mind-skill-callout mind-skill-callout--'.$skill]) }} aria-hidden="true">
    <span class="mind-skill-orbit-node">
        <span class="mind-skill-orbit-meta">
            <span class="mind-skill-orbit-icon">
                @switch($skill)
                    @case('focus')
                        <svg viewBox="0 0 48 48" fill="none">
                            <circle cx="24" cy="24" r="15"/>
                            <circle cx="24" cy="24" r="7"/>
                            <circle cx="24" cy="24" r="2" fill="currentColor" stroke="none"/>
                        </svg>
                        @break
                    @case('memory')
                        <svg viewBox="0 0 48 48" fill="none">
                            <path d="M24 8c-5-4-12-1-11 5-6 2-7 9-3 12-2 6 2 11 8 10 2 5 6 5 6 1V8Z"/>
                            <path d="M24 8c5-4 12-1 11 5 6 2 7 9 3 12 2 6-2 11-8 10-2 5-6 5-6 1V8Z"/>
                            <path d="M24 11v23"/>
                        </svg>
                        @break
                    @case('growth')
                    @case('learning')
                        <svg viewBox="0 0 48 48" fill="none">
                            <path d="M24 39V19"/>
                            <path d="M24 28c-9 0-13-5-12-12 8 0 13 4 12 12Z"/>
                            <path d="M24 22c0-8 5-12 13-12 1 7-4 12-13 12Z"/>
                        </svg>
                        @break
                @endswitch
            </span>
            <span class="mind-skill-callout-number">{{ $number }}</span>
        </span>
        <strong>{{ $label }}</strong>
        <small>{{ $caption }}</small>
    </span>

    <span class="mind-skill-connector"></span>

    <span class="mind-skill-image-card mind-skill-image-card--{{ $skill }}">
        @if($skill === 'focus')
            <img src="{{ asset('images/mind-training-focus.jpg') }}" alt="">
        @elseif($skill === 'growth')
            <img src="{{ asset('images/blogs-growth-reflection.webp') }}" alt="">
        @elseif($skill === 'memory')
            <img src="{{ asset('images/blogs-memory-conversation.png') }}" alt="">
        @elseif($skill === 'learning')
            <img src="{{ asset('images/testimonials-child-steps.jpe') }}" alt="">
        @endif
    </span>
</div>