@extends('layouts.app')

@section('title', 'Mind Training Gallery | Moments of Learning and Growth')

@section('meta_description', 'Explore moments from mind training sessions, workshops and shared learning experiences.')

@push('styles')
    @vite('resources/css/pages/gallery.css')
@endpush

@section('content')
    <x-layout.navbar />

    <main>
        <section class="gallery-hero">
            <x-home.leaf class="gallery-botanical-leaf gallery-botanical-leaf--hero" />
            <div class="gallery-hero-ring gallery-hero-ring--one" aria-hidden="true"></div>
            <div class="gallery-hero-ring gallery-hero-ring--two" aria-hidden="true"></div>

            <div class="section-container gallery-hero-grid">
                <div class="gallery-hero-copy reveal">
                    <p class="section-kicker">Moments from our community</p>
                    <h1>Learning, growth and <span>shared experiences.</span></h1>
                    <p>
                        Explore photos from mind training sessions, workshops and
                        everyday moments of learning.
                    </p>
                </div>

                <div class="gallery-hero-orb reveal" aria-hidden="true">
                    <span class="gallery-hero-orb-dot gallery-hero-orb-dot--one"></span>
                    <span class="gallery-hero-orb-dot gallery-hero-orb-dot--two"></span>
                    <div class="gallery-hero-orb-center">
                        <img src="{{ asset('images/mind-training-lotus-mark.png') }}" alt="">
                        <span>Moments that grow</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="gallery-masonry-section section-pad">
            <x-home.leaf class="gallery-botanical-leaf gallery-botanical-leaf--section" />
            <div class="section-container">
                @if ($photos->isEmpty())
                    <div class="gallery-empty reveal">
                        <span aria-hidden="true">✦</span>
                        <p class="section-kicker">A growing collection</p>
                        <h2>Gallery photos are coming soon.</h2>
                        <p>New moments will appear here as workshops and programs are shared.</p>
                    </div>
                @endif

                <div class="gallery-masonry" @if($photos->isEmpty()) style="margin-top:18px;" @endif>
                    @foreach ($photos as $photo)
                        @php
                            $index = str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <article class="gallery-card reveal">
                            <div class="gallery-card-image">
                                <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}">
                                <span>{{ $index }}</span>
                            </div>
                            <div class="gallery-card-copy">
                                <p>Gallery moment</p>
                                <h2>{{ $photo->title }}</h2>
                                @if ($photo->description)
                                    <span>{{ $photo->description }}</span>
                                @endif
                            </div>
                        </article>
                    @endforeach

                    @if ($photos->count() > 0 && $photos->count() < 6)
                        <article class="gallery-card gallery-card--coming reveal">
                            <div class="gallery-card-image gallery-card-image--coming" aria-hidden="true">
                                <span>✦</span>
                            </div>
                            <div class="gallery-card-copy">
                                <p>Upcoming</p>
                                <h2>New gallery moments coming soon</h2>
                                <span>More workshop and learning moments will be shared here soon.</span>
                            </div>
                        </article>
                    @endif
                </div>
            </div>
        </section>
    </main>

    <x-layout.mind-training-cta
        eyebrow="See what growth can look like"
        title="Make room for a more intentional way to learn."
        description="From focus to memory, mind training can meet you in the moments that matter."
        button-text="Explore programs"
        :button-url="route('programs')"
    />

    <x-layout.footer />
@endsection
