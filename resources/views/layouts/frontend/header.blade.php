<header class="site-header">
    <nav class="navbar navbar-expand-xl site-nav" aria-label="Main">
        <div class="container-fluid container-nav">
            <a class="navbar-brand site-brand" href="{{ route('home') }}">
                <img src="{{ asset('frontend/assets/icons/logo-mark.svg') }}" alt="" />
                <span>Techudio</span>
            </a>
            <button
                class="navbar-toggler site-nav__toggle"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#siteNav"
                aria-controls="siteNav"
                aria-expanded="false"
                aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
            <div class="collapse navbar-collapse" id="siteNav">
                <div class="site-nav__panel">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#services">Our Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#how-it-works">How it Works</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#our-work">Our Work</a></li>
                    </ul>
                    <div class="site-nav__actions">
                        <a class="btn btn-quote" href="{{ route('quote') }}">Get a Free Quote</a>
                        <a class="btn btn-contact" href="{{ route('contact') }}">Contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>