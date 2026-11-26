@extends('layouts.admin')

@section('title', 'Overview')

@push('styles')
<style>
    .overview-hero {
        margin-bottom: 28px;
        padding: 28px 30px;
        border-radius: 24px;
        border: 1px solid var(--border-soft);
        background:
            radial-gradient(circle at 92% 12%, rgba(168, 204, 148, .22), transparent 28%),
            linear-gradient(135deg, #ffffff, #f4f8ee);
        box-shadow: var(--shadow-card);
    }

    .overview-hero h1 {
        margin: 0 0 8px;
        font-family: 'Playfair Display', serif;
        font-size: clamp(30px, 3.4vw, 40px);
        line-height: 1.1;
        color: var(--text-ink);
    }

    .overview-hero p {
        margin: 0;
        max-width: 560px;
        color: var(--text-muted);
        font-size: 14.5px;
        line-height: 1.65;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 22px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid var(--border-soft);
        border-radius: 20px;
        padding: 20px;
        box-shadow: var(--shadow-card);
        text-decoration: none;
        color: inherit;
        transition: transform .18s ease, border-color .18s ease;
        display: block;
        min-height: 132px;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        border-color: #b7d2b5;
    }

    .stat-card__label {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 12px;
    }

    .stat-card__value {
        font-family: 'Playfair Display', serif;
        font-size: 34px;
        font-weight: 700;
        line-height: 1;
        color: var(--text-ink);
        margin-bottom: 10px;
    }

    .stat-card__meta {
        font-size: 12.5px;
        color: #6f826f;
        line-height: 1.45;
    }

    .quick-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .quick-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 18px 20px;
        background: #fff;
        border: 1px solid var(--border-soft);
        border-radius: 18px;
        text-decoration: none;
        color: inherit;
        box-shadow: var(--shadow-card);
    }

    .quick-card:hover { border-color: var(--brand-primary); }

    .quick-card__left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .quick-card__badge {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--brand-soft);
        color: var(--brand-deep);
        font-weight: 700;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .quick-card__title { font-size: 14.5px; font-weight: 700; margin-bottom: 2px; }
    .quick-card__sub { font-size: 12.5px; color: var(--text-muted); }

    @media (max-width: 1100px) {
        .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 720px) {
        .stats-grid,
        .quick-grid { grid-template-columns: 1fr; }
        .overview-hero { padding: 22px 18px; }
    }
</style>
@endpush

@section('content')
    <div class="overview-hero">
        <p class="page-kicker" style="margin-bottom:8px;">Mind Training Website</p>
        <h1>Overview</h1>
        <p>Track what is live on the website and jump into any content area from here.</p>
    </div>

    <div class="stats-grid">
        <a href="{{ route('admin.programs.index') }}" class="stat-card">
            <div class="stat-card__label">Programs</div>
            <div class="stat-card__value">{{ $stats['programs_total'] }}</div>
            <div class="stat-card__meta">{{ $stats['programs_visible'] }} visible on /programs</div>
        </a>

        <a href="{{ route('admin.testimonials.index') }}" class="stat-card">
            <div class="stat-card__label">Testimonials</div>
            <div class="stat-card__value">{{ $stats['testimonials_total'] }}</div>
            <div class="stat-card__meta">{{ $stats['testimonials_published'] }} published on site</div>
        </a>

        <a href="{{ route('admin.blogs.index') }}" class="stat-card">
            <div class="stat-card__label">Blog posts</div>
            <div class="stat-card__value">{{ $stats['blogs_total'] }}</div>
            <div class="stat-card__meta">{{ $stats['blogs_published'] }} published on /blogs</div>
        </a>

        <a href="{{ route('admin.gallery.index') }}" class="stat-card">
            <div class="stat-card__label">Gallery</div>
            <div class="stat-card__value">{{ $stats['gallery_total'] }}</div>
            <div class="stat-card__meta">{{ $stats['gallery_visible'] }} visible on /gallery</div>
        </a>
    </div>

    <div class="quick-grid">
        <a href="{{ route('admin.programs.index') }}" class="quick-card">
            <div class="quick-card__left">
                <div class="quick-card__badge">P</div>
                <div>
                    <div class="quick-card__title">Manage programs</div>
                    <div class="quick-card__sub">Add or edit training programs.</div>
                </div>
            </div>
            <span aria-hidden="true">→</span>
        </a>

        <a href="{{ route('admin.testimonials.index') }}" class="quick-card">
            <div class="quick-card__left">
                <div class="quick-card__badge">T</div>
                <div>
                    <div class="quick-card__title">Manage testimonials</div>
                    <div class="quick-card__sub">Publish participant reflections.</div>
                </div>
            </div>
            <span aria-hidden="true">→</span>
        </a>

        <a href="{{ route('admin.blogs.index') }}" class="quick-card">
            <div class="quick-card__left">
                <div class="quick-card__badge">B</div>
                <div>
                    <div class="quick-card__title">Manage blog</div>
                    <div class="quick-card__sub">Write and publish insights.</div>
                </div>
            </div>
            <span aria-hidden="true">→</span>
        </a>

        <a href="{{ route('admin.gallery.index') }}" class="quick-card">
            <div class="quick-card__left">
                <div class="quick-card__badge">G</div>
                <div>
                    <div class="quick-card__title">Manage gallery</div>
                    <div class="quick-card__sub">Upload photos from sessions.</div>
                </div>
            </div>
            <span aria-hidden="true">→</span>
        </a>
    </div>
@endsection
