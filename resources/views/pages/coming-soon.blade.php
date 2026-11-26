@extends('layouts.app')

@section('title', $pageTitle . ' | Mind Training')

@section('meta_description', $pageDescription)

@push('styles')
    @vite('resources/css/pages/coming-soon.css')
@endpush

@section('content')
    <x-layout.navbar />

    <main class="page-placeholder">
        <div class="page-placeholder-orb" aria-hidden="true"></div>
        <div class="page-placeholder-content">
            <p class="section-kicker">A new page is taking shape</p>
            <h1>{{ $pageTitle }}</h1>
            <p>{{ $pageDescription }}</p>
            <p class="placeholder-note">We’re preparing this section. In the meantime, explore the mind training overview on our homepage.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Back to home <span aria-hidden="true">→</span></a>
        </div>
    </main>

    <x-layout.mind-training-cta
        :eyebrow="$ctaEyebrow"
        :title="$ctaTitle"
        :description="$ctaDescription"
        :button-text="$ctaButtonText"
        :button-url="route($ctaRoute)"
    />

    <x-layout.footer />
@endsection
