
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Mind Training | Corporate Mind Wellness')</title>

    <meta name="description" content="@yield('meta_description', 'Discover corporate mind wellness programs designed to support focus, emotional well-being and workplace productivity.')">
    <meta name="keywords" content="mind training, corporate wellness, mindfulness programs, leadership development, stress management">

    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#244c20">

    <link rel="icon" type="image/png" sizes="256x256" href="{{ asset('images/mind-training-lotus-mark.png') }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Mind Training | Corporate Mind Wellness')">
    <meta property="og:description" content="@yield('meta_description', 'Corporate mind wellness and workplace well-being programs.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/mindfulness-hero.png') }}">
    <meta name="twitter:card" content="summary_large_image">

    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@type": "ProfessionalService",
            "name": "Mind Training",
            "description": "Corporate mind wellness, mindfulness and professional growth programs.",
            "url": "{{ url('/') }}",
            "telephone": "+91-98765-43210",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Pune",
                "addressRegion": "Maharashtra",
                "addressCountry": "IN"
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/components/mind-training-cta.css', 'resources/css/components/mind-skill-callout.css', 'resources/css/components/theme-dropdown.css', 'resources/css/components/media-upload.css', 'resources/js/app.js'])
    

    @stack('styles')
</head>

<body>
    @yield('content')
    @stack('scripts')
    <x-modals.book-session />
</body>
</html>
