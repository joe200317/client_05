
<header class="site-header">
    <div class="nav-container">

        <a href="{{ route('home') }}" class="brand" aria-label="Mind Training home">
            <img class="brand-icon" src="{{ asset('images/mind-training-lotus-mark.png') }}" alt="" width="43" height="43">

            <span class="brand-copy">
                <strong>Mind Training</strong>
                <small>Mind &amp; Memory Training</small>
            </span>
        </a>

        <button class="mobile-menu-toggle"
                type="button"
                aria-label="Open navigation menu"
                aria-expanded="false"
                aria-controls="primary-navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="primary-navigation" id="primary-navigation"
             aria-label="Main navigation">

            <a href="{{ route('home') }}" class="nav-link{{ request()->routeIs('home') ? ' active' : '' }}" @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>
            <a href="{{ route('about') }}" class="nav-link{{ request()->routeIs('about') ? ' active' : '' }}" @if (request()->routeIs('about')) aria-current="page" @endif>About Us</a>
            <a href="{{ route('programs') }}" class="nav-link{{ request()->routeIs('programs') ? ' active' : '' }}" @if (request()->routeIs('programs')) aria-current="page" @endif>Programs</a>
            <a href="{{ route('testimonials') }}" class="nav-link{{ request()->routeIs('testimonials') ? ' active' : '' }}" @if (request()->routeIs('testimonials')) aria-current="page" @endif>Testimonials</a>
            <a href="{{ route('blogs') }}" class="nav-link{{ request()->routeIs('blogs') ? ' active' : '' }}" @if (request()->routeIs('blogs')) aria-current="page" @endif>Blogs</a>
            <a href="{{ route('gallery') }}" class="nav-link{{ request()->routeIs('gallery') ? ' active' : '' }}" @if (request()->routeIs('gallery')) aria-current="page" @endif>Gallery</a>
            <a href="{{ route('contact') }}" class="nav-link{{ request()->routeIs('contact') ? ' active' : '' }}" @if (request()->routeIs('contact')) aria-current="page" @endif>Contact Us</a>

            <a href="{{ route('contact') }}" class="btn btn-primary nav-cta">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <rect x="4" y="6" width="16" height="14" rx="2"/>
                    <path d="M8 3v6m8-6v6M4 10h16"/>
                </svg>
                Book a Session
            </a>
        </nav>

    </div>
</header>
