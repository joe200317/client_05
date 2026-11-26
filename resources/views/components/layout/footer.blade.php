<footer class="site-footer">
    <div class="section-container">
        <div class="footer-main">
            <div class="footer-brand-block">
                <a href="{{ route('home') }}" class="footer-brand" aria-label="Mind Training home">
                    <img class="footer-brand-icon" src="{{ asset('images/mind-training-lotus-mark.png') }}" alt="" width="45" height="42">
                    <span>Mind Training<small>Mind &amp; memory development</small></span>
                </a>
                <p>Practical mind training to support focus, learning and personal growth in everyday life.</p>
            </div>

            <div class="footer-column">
                <h2>Explore</h2>
                <nav aria-label="Footer navigation">
                    <a href="{{ route('about') }}">About us</a>
                    <a href="{{ route('programs') }}">Our services</a>
                    <a href="{{ route('testimonials') }}">Learner stories</a>
                    <a href="{{ route('blogs') }}">Mind training blog</a>
                </nav>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© {{ date('Y') }} Mind Training. All rights reserved.</p>
            <p>Think clearly. Learn with confidence. Keep growing.</p>
        </div>
    </div>
</footer>