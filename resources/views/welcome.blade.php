@extends('layouts.frontend.main')
@section('title', 'Home - Techudio')
@section('canonical', url('/'))
@section('meta')
@endsection
@section('content')
<main>
    <!-- Hero -->
    <section class="hero">
        <div class="hero__ribbons" aria-hidden="true">
            <div class="hero__ribbon hero__ribbon--left">
                <img src="{{ asset('frontend/assets/images/home_left_hero_bg.png') }}" alt="" />
            </div>
            <div class="hero__ribbon hero__ribbon--right">
                <img src="{{ asset('frontend/assets/images/home_hero_right_bg.png') }}" alt="" />
            </div>
        </div>

        <div class="container-fluid container-hero hero__content">
            <h1 class="hero__title">Transforming Ideas into Intelligent Digital Solutions</h1>
            <p class="hero__lead">
                We help individuals, startups, SMEs, and enterprises turn innovative ideas into scalable digital
                products. From concept and design to development, deployment, and ongoing support, we build
                reliable solutions that drive growth, improve efficiency, and create lasting business value.
            </p>
            <div class="hero__actions">
                <a class="btn btn-quote" href="{{ route('quote') }}">Get a Free Quote</a>
                <a class="btn btn-contact" href="{{ route('contact') }}">Contact us</a>
            </div>
            <p class="hero__tagline">
                You built it with AI? We help you launch, improve, maintain and scale it.
            </p>
        </div>
    </section>

    <!-- Services -->
    <section id="services" class="services">
        <div class="services__decor" aria-hidden="true">
            <div class="services__glow services__glow--purple"></div>
            <div class="services__glow services__glow--green"></div>
            <div class="services__topline"></div>
        </div>

        <div class="container-fluid container-wide services__inner">
            <header class="services__head">
                <div class="eyebrow eyebrow--square">
                    <span class="eyebrow__dot"></span>
                    <span class="eyebrow__text">Our services</span>
                </div>
                <h2 class="services__title">
                    Everything You Need to
                    <span class="bg-brand text-gradient" style="--brand-angle: 124.49deg">Build &amp; Scale</span>
                </h2>
                <p class="services__lead">
                    From idea to deployment — Techudio delivers end-to-end software solutions across web, mobile,
                    AI, cloud, and beyond.
                </p>
            </header>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 services__grid">
                <div class="col">
                    <article class="service-card" style="--accent: 74 158 255">
                        <div class="service-card__glow" aria-hidden="true"></div>
                        <div class="service-card__head">
                            <div class="icon-tile"><span>🌐</span></div>
                            <h3 class="service-card__title">Web Solutions</h3>
                        </div>
                        <div class="service-card__rule"></div>
                        <div class="service-card__lists">
                            <ul class="service-card__list">
                                <li>Website Development</li>
                                <li>Website Design</li>
                                <li>Website Redesign</li>
                                <li>Website Maintenance</li>
                                <li>Custom Admin Panel</li>
                            </ul>
                            <div class="collapse" id="service-more-1">
                                <ul class="service-card__list service-card__list--more">
                                    <li>Web Application Development</li>
                                    <li>CMS Development</li>
                                    <li>Multilingual Website</li>
                                    <li>E-Commerce Development</li>
                                </ul>
                            </div>
                        </div>
                        <button
                            class="service-card__more"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#service-more-1"
                            aria-expanded="false"
                            aria-controls="service-more-1">
                            <span class="when-closed">▼ +4 more</span>
                            <span class="when-open">▲ Show less</span>
                        </button>
                        <div class="service-card__foot">
                            <div>
                                <a class="pill-btn" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col">
                    <article class="service-card" style="--accent: 25 251 155">
                        <div class="service-card__glow" aria-hidden="true"></div>
                        <div class="service-card__head">
                            <div class="icon-tile"><span>📱</span></div>
                            <h3 class="service-card__title">Mobile App Solutions</h3>
                        </div>
                        <div class="service-card__rule"></div>
                        <div class="service-card__lists">
                            <ul class="service-card__list">
                                <li>Android App Development</li>
                                <li>iOS App Development</li>
                                <li>Cross-Platform App Development</li>
                                <li>App Localization</li>
                                <li>Mobile App Design</li>
                            </ul>
                            <div class="collapse" id="service-more-2">
                                <ul class="service-card__list service-card__list--more">
                                    <li>App Maintenance</li>
                                    <li>App Testing</li>
                                    <li>App Modernization</li>
                                </ul>
                            </div>
                        </div>
                        <button
                            class="service-card__more"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#service-more-2"
                            aria-expanded="false"
                            aria-controls="service-more-2">
                            <span class="when-closed">▼ +3 more</span>
                            <span class="when-open">▲ Show less</span>
                        </button>
                        <div class="service-card__foot">
                            <div>
                                <a class="pill-btn" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col">
                    <article class="service-card" style="--accent: 169 98 255">
                        <div class="service-card__glow" aria-hidden="true"></div>
                        <div class="service-card__head">
                            <div class="icon-tile"><span>🤖</span></div>
                            <h3 class="service-card__title">AI &amp; Machine Learning</h3>
                        </div>
                        <div class="service-card__rule"></div>
                        <div class="service-card__lists">
                            <ul class="service-card__list">
                                <li>AI Chatbot Development</li>
                                <li>AI Agent Development</li>
                                <li>AI Integration</li>
                                <li>Live Agent Development</li>
                                <li>Large Language Model Integration (ChatGPT, Claude, Gemini etc)</li>
                            </ul>
                            <div class="collapse" id="service-more-3">
                                <ul class="service-card__list service-card__list--more">
                                    <li>Machine Learning Model</li>
                                    <li>NLP</li>
                                    <li>AI Automation</li>
                                    <li>Data Pipeline</li>
                                    <li>Model Fine-tuning</li>
                                    <li>Prompt Testing</li>
                                </ul>
                            </div>
                        </div>
                        <button
                            class="service-card__more"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#service-more-3"
                            aria-expanded="false"
                            aria-controls="service-more-3">
                            <span class="when-closed">▼ +6 more</span>
                            <span class="when-open">▲ Show less</span>
                        </button>
                        <div class="service-card__foot">
                            <div>
                                <a class="pill-btn" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col">
                    <article class="service-card" style="--accent: 255 107 157">
                        <div class="service-card__glow" aria-hidden="true"></div>
                        <div class="service-card__head">
                            <div class="icon-tile"><span>🎨</span></div>
                            <h3 class="service-card__title">UI/UX &amp; Creative Design</h3>
                        </div>
                        <div class="service-card__rule"></div>
                        <div class="service-card__lists">
                            <ul class="service-card__list">
                                <li>UI/UX Design</li>
                                <li>Wireframing</li>
                                <li>Mockup Design</li>
                                <li>Dark Mode Design</li>
                            </ul>
                        </div>
                        <div class="service-card__foot">
                            <div>
                                <a class="pill-btn" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col">
                    <article class="service-card" style="--accent: 255 159 67">
                        <div class="service-card__glow" aria-hidden="true"></div>
                        <div class="service-card__head">
                            <div class="icon-tile"><span>🚀</span></div>
                            <h3 class="service-card__title">App Store &amp; Deployment</h3>
                        </div>
                        <div class="service-card__rule"></div>
                        <div class="service-card__lists">
                            <ul class="service-card__list">
                                <li>Google Play Store Publishing</li>
                                <li>Apple App Store Publishing</li>
                                <li>App Store Optimization (ASO)</li>
                                <li>Huawei AppGallery Publishing</li>
                                <li>Samsung Store Publishing</li>
                            </ul>
                            <div class="collapse" id="service-more-5">
                                <ul class="service-card__list service-card__list--more">
                                    <li>Beta Testing</li>
                                    <li>Website Deployment</li>
                                    <li>Cloud Deployment</li>
                                </ul>
                            </div>
                        </div>
                        <button
                            class="service-card__more"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#service-more-5"
                            aria-expanded="false"
                            aria-controls="service-more-5">
                            <span class="when-closed">▼ +4 more</span>
                            <span class="when-open">▲ Show less</span>
                        </button>
                        <div class="service-card__foot">
                            <div>
                                <a class="pill-btn" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col">
                    <article class="service-card" style="--accent: 31 207 241">
                        <div class="service-card__glow" aria-hidden="true"></div>
                        <div class="service-card__head">
                            <div class="icon-tile"><span>🛠️</span></div>
                            <h3 class="service-card__title">Maintenance &amp; Support</h3>
                        </div>
                        <div class="service-card__rule"></div>
                        <div class="service-card__lists">
                            <ul class="service-card__list">
                                <li>Website Maintenance</li>
                                <li>Mobile App Maintenance</li>
                                <li>Dependency &amp; Library Updates</li>
                                <li>Bug Fixes</li>
                                <li>Software Documentation</li>
                            </ul>
                            <div class="collapse" id="service-more-6">
                                <ul class="service-card__list service-card__list--more">
                                    <li>Performance Optimization</li>
                                    <li>Security Updates</li>
                                    <li>Backup</li>
                                    <li>Code Review</li>
                                    <li>Technical Support</li>
                                </ul>
                            </div>
                        </div>
                        <button
                            class="service-card__more"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#service-more-6"
                            aria-expanded="false"
                            aria-controls="service-more-6">
                            <span class="when-closed">▼ +6 more</span>
                            <span class="when-open">▲ Show less</span>
                        </button>
                        <div class="service-card__foot">
                            <div>
                                <a class="pill-btn" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col">
                    <article class="service-card" style="--accent: 255 213 18">
                        <div class="service-card__glow" aria-hidden="true"></div>
                        <div class="service-card__head">
                            <div class="icon-tile"><span>⚡</span></div>
                            <h3 class="service-card__title">Integrations &amp; Custom Development</h3>
                        </div>
                        <div class="service-card__rule"></div>
                        <div class="service-card__lists">
                            <ul class="service-card__list">
                                <li>Custom API Development</li>
                                <li>Third-Party API Integration</li>
                                <li>WhatsApp Business API Integration</li>
                                <li>Social Media API Integration</li>
                                <li>Custom Library Integration</li>
                            </ul>
                            <div class="collapse" id="service-more-7">
                                <ul class="service-card__list service-card__list--more">
                                    <li>SDK Integration</li>
                                    <li>Payment Gateway</li>
                                    <li>CRM/ERP</li>
                                    <li>Live Chat</li>
                                    <li>OAuth / SSO</li>
                                    <li>Maps</li>
                                    <li>Push Notifications</li>
                                    <li>Analytics</li>
                                    <li>Data Scraping</li>
                                    <li>Summarization Tool</li>
                                </ul>
                            </div>
                        </div>
                        <button
                            class="service-card__more"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#service-more-7"
                            aria-expanded="false"
                            aria-controls="service-more-7">
                            <span class="when-closed">▼ +10 more</span>
                            <span class="when-open">▲ Show less</span>
                        </button>
                        <div class="service-card__foot">
                            <div>
                                <a class="pill-btn" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col">
                    <article class="service-card" style="--accent: 56 189 248">
                        <div class="service-card__glow" aria-hidden="true"></div>
                        <div class="service-card__head">
                            <div class="icon-tile"><span>☁️</span></div>
                            <h3 class="service-card__title">Cloud &amp; Infrastructure</h3>
                        </div>
                        <div class="service-card__rule"></div>
                        <div class="service-card__lists">
                            <ul class="service-card__list">
                                <li>Web Hosting</li>
                                <li>Cloud Infrastructure</li>
                                <li>Server Configuration</li>
                                <li>Domain &amp; DNS Management</li>
                                <li>SSL Certificate Setup</li>
                            </ul>
                            <div class="collapse" id="service-more-8">
                                <ul class="service-card__list service-card__list--more">
                                    <li>Database</li>
                                    <li>Server Migration</li>
                                    <li>Speed Optimization</li>
                                    <li>Accessibility</li>
                                </ul>
                            </div>
                        </div>
                        <button
                            class="service-card__more"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#service-more-8"
                            aria-expanded="false"
                            aria-controls="service-more-8">
                            <span class="when-closed">▼ +5 more</span>
                            <span class="when-open">▲ Show less</span>
                        </button>
                        <div class="service-card__foot">
                            <div>
                                <a class="pill-btn" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col">
                    <article class="service-card" style="--accent: 52 211 153">
                        <div class="service-card__glow" aria-hidden="true"></div>
                        <div class="service-card__head">
                            <div class="icon-tile"><span>🧪</span></div>
                            <h3 class="service-card__title">QA Testing</h3>
                        </div>
                        <div class="service-card__rule"></div>
                        <div class="service-card__lists">
                            <ul class="service-card__list">
                                <li>Functional Testing</li>
                                <li>Cross Device Testing</li>
                                <li>Performance Testing</li>
                                <li>Mobile App Store Compliance Testing</li>
                                <li>Security Testing</li>
                            </ul>
                            <div class="collapse" id="service-more-9">
                                <ul class="service-card__list service-card__list--more">
                                    <li>Regression Testing</li>
                                    <li>Smoke Testing</li>
                                    <li>Automated Testing</li>
                                    <li>Manual Testing</li>
                                </ul>
                            </div>
                        </div>
                        <button
                            class="service-card__more"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#service-more-9"
                            aria-expanded="false"
                            aria-controls="service-more-9">
                            <span class="when-closed">▼ +3 more</span>
                            <span class="when-open">▲ Show less</span>
                        </button>
                        <div class="service-card__foot">
                            <div>
                                <a class="pill-btn" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col">
                    <article class="service-card" style="--accent: 192 132 252">
                        <div class="service-card__glow" aria-hidden="true"></div>
                        <div class="service-card__head">
                            <div class="icon-tile"><span>🏗️</span></div>
                            <h3 class="service-card__title">Architecture</h3>
                        </div>
                        <div class="service-card__rule"></div>
                        <div class="service-card__lists">
                            <ul class="service-card__list">
                                <li>Software Architecture</li>
                                <li>Database Design &amp; Architecture</li>
                                <li>API Architecture &amp; Design</li>
                                <li>Technical Documentation</li>
                            </ul>
                        </div>
                        <div class="service-card__foot">
                            <div>
                                <a class="pill-btn" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="services__cta">
                <a class="btn-3d" href="{{ route('quote') }}"><span>Get a Free Quote</span></a>
            </div>
        </div>
    </section>

    <!-- Stats + How it works -->
    <div class="aurora-band">
        <div class="aurora-band__bg" aria-hidden="true"><img src="{{ asset('frontend/assets/images/aurora.png') }}" alt="" /></div>

        <div class="aurora-band__body">
            <section class="container-fluid container-stats stats">
                <h2 class="stats__title">Trusted by leading<br />companies worldwide.</h2>
                <ul class="stats__list">
                    <li>
                        <p class="stats__value stats__value--pink text-gradient">500+</p>
                        <p class="stats__label">Enterprise clients</p>
                    </li>
                    <li>
                        <p class="stats__value stats__value--cyan text-gradient">99.9%</p>
                        <p class="stats__label">Uptime guaranteed</p>
                    </li>
                    <li>
                        <p class="stats__value stats__value--green text-gradient">50M+</p>
                        <p class="stats__label">Lines of code delivered</p>
                    </li>
                </ul>
            </section>

            <section id="how-it-works" class="container-fluid container-stats how">
                <div class="how__inner">
                    <header class="how__head">
                        <h2 class="how__title">How it works</h2>
                        <p class="how__lead">A simple 7-step process to go from inquiry to a dedicated team.</p>
                    </header>
                    <ol class="row row-cols-1 row-cols-md-2 how__grid">
                        <li class="col">
                            <div class="step-card step-card--cyan">
                                <div class="step-card__top">
                                    <span class="step-card__badge">1</span>
                                    <h3 class="step-card__title">Check Our Services</h3>
                                </div>
                                <p class="step-card__text">
                                    Browse our capabilities and choose the services that fit your project.
                                </p>
                                <div class="step-card__connector" aria-hidden="true"></div>
                            </div>
                        </li>
                        <li class="col">
                            <div class="step-card step-card--violet">
                                <div class="step-card__top">
                                    <span class="step-card__badge">2</span>
                                    <h3 class="step-card__title">Click to Get a Quote</h3>
                                </div>
                                <p class="step-card__text">
                                    Start the conversation with a quick request - no commitment required.
                                </p>
                                <div class="step-card__connector" aria-hidden="true"></div>
                            </div>
                        </li>
                        <li class="col">
                            <div class="step-card step-card--sun">
                                <div class="step-card__top">
                                    <span class="step-card__badge">3</span>
                                    <h3 class="step-card__title">Fill Up the Form</h3>
                                </div>
                                <p class="step-card__text">
                                    Share a few details about your project, timeline, and goals.
                                </p>
                                <div class="step-card__connector" aria-hidden="true"></div>
                            </div>
                        </li>
                        <li class="col">
                            <div class="step-card step-card--neon">
                                <div class="step-card__top">
                                    <span class="step-card__badge">4</span>
                                    <h3 class="step-card__title">Submit</h3>
                                </div>
                                <p class="step-card__text">Send your request and we'll review it right away.</p>
                                <div class="step-card__connector" aria-hidden="true"></div>
                            </div>
                        </li>
                        <li class="col">
                            <div class="step-card step-card--cyan">
                                <div class="step-card__top">
                                    <span class="step-card__badge">5</span>
                                    <h3 class="step-card__title">Our Analysis</h3>
                                </div>
                                <p class="step-card__text">
                                    We'll assess scope, complexity, and the best team fit for your needs.
                                </p>
                                <div class="step-card__connector" aria-hidden="true"></div>
                            </div>
                        </li>
                        <li class="col">
                            <div class="step-card step-card--violet">
                                <div class="step-card__top">
                                    <span class="step-card__badge">6</span>
                                    <h3 class="step-card__title">Our Team Will Get Back to You Within 24 Hours</h3>
                                </div>
                                <p class="step-card__text">
                                    Expect a response with next steps, timelines, and a clear proposal.
                                </p>
                                <div class="step-card__connector" aria-hidden="true"></div>
                            </div>
                        </li>
                        <li class="col">
                            <div class="step-card step-card--sun">
                                <div class="step-card__top">
                                    <span class="step-card__badge">7</span>
                                    <h3 class="step-card__title">Hire Our Team</h3>
                                </div>
                                <p class="step-card__text">
                                    Kick off your project with a dedicated team that's ready to deliver.
                                </p>
                                <div class="step-card__connector" aria-hidden="true"></div>
                            </div>
                        </li>
                    </ol>
                </div>
            </section>
        </div>
    </div>

    <!-- Our work -->
    <section id="our-work" class="work">
        <div class="container-fluid container-narrow work__inner">
            <div class="work__glow" aria-hidden="true"><img src="{{ asset('frontend/assets/images/work-glow.png') }}" alt="" /></div>

            <div class="work__head">
                <h2 class="work__title">Our Work</h2>
                <a class="work__more" href="#">Explore more our work<span class="pressed"></span></a>
            </div>

            <a class="work-feature" href="#">
                <img class="work-feature__image" src="{{ asset('frontend/assets/images/work-helium.png') }}" alt="" />
                <h3 class="work-feature__title">
                    <span>Helium brings real-world </span>
                    <span>5G networks on Techudio </span>
                </h3>
                <div class="pressed"></div>
            </a>

            <div class="row row-cols-1 row-cols-md-3 work__grid">
                <div class="col">
                    <a class="work-card" href="#">
                        <img class="work-card__image" src="{{ asset('frontend/assets/images/work-gainforest.png') }}" alt="" />
                        <div class="work-card__body">
                            <h3 class="work-card__title">
                                <span>GainForest brings </span>
                                <span>transparency to climate </span>
                                <span>preservation efforts </span>
                            </h3>
                            <span class="work-card__arrow"><img src="{{ asset('frontend/assets/icons/arrow-circle-right.svg') }}" alt="" /></span>
                        </div>
                        <div class="pressed"></div>
                    </a>
                </div>
                <div class="col">
                    <a class="work-card" href="#">
                        <img class="work-card__image" src="{{ asset('frontend/assets/images/work-hivemapper.png') }}" alt="" />
                        <div class="work-card__body">
                            <h3 class="work-card__title">
                                <span>Hivemapper </span>
                                <span>decentralizes mapping </span>
                                <span>with better real-time data </span>
                                <span>and community </span>
                                <span>incentives </span>
                            </h3>
                            <span class="work-card__arrow"><img src="{{ asset('frontend/assets/icons/arrow-circle-right.svg') }}" alt="" /></span>
                        </div>
                        <div class="pressed"></div>
                    </a>
                </div>
                <div class="col">
                    <a class="work-card work-card--offset" href="#">
                        <img class="work-card__image" src="{{ asset('frontend/assets/images/work-asics.png') }}" alt="" />
                        <div class="work-card__body">
                            <h3 class="work-card__title">
                                <span>ASICS builds loyalty </span>
                                <span>program with Techudio </span>
                                <span>Pay </span>
                            </h3>
                            <span class="work-card__arrow"><img src="{{ asset('frontend/assets/icons/arrow-circle-right.svg') }}" alt="" /></span>
                        </div>
                        <div class="pressed"></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="testimonials__decor" aria-hidden="true">
            <img
                class="testimonials__glow testimonials__glow--purple"
                src="{{ asset('frontend/assets/glows/testimonials-purple.svg') }}"
                alt="" />
            <img
                class="testimonials__glow testimonials__glow--green"
                src="{{ asset('frontend/assets/glows/testimonials-green.svg') }}"
                alt="" />
        </div>

        <div class="container-fluid container-testimonials testimonials__inner">
            <header class="testimonials__head">
                <p class="testimonials__eyebrow">Ecosystem Validation</p>
                <h2 class="testimonials__title">Trusted by builders pushing boundaries</h2>
                <p class="testimonials__lead">
                    Discover why the world's most innovative decentralized developers and product leads choose the
                    Techudio network to deploy at scale.
                </p>
            </header>

            <div class="row row-cols-1 row-cols-lg-3 testimonials__grid">
                <div class="col">
                    <figure class="testimonial-card">
                        <div class="testimonial-card__top">
                            <div class="testimonial-card__meta">
                                <span class="testimonial-card__tag">DEFI</span>
                                <span class="testimonial-card__mark">
                                    <img src="{{ asset('frontend/assets/icons/quote-purple.svg') }}" alt="" />
                                </span>
                            </div>
                            <blockquote class="testimonial-card__quote">
                                &quot;Building our decentralized order book on Techudio was the only way to achieve
                                sub-second finality. The developer tooling and execution speed are unmatched.&quot;
                            </blockquote>
                        </div>
                        <figcaption class="testimonial-card__author">
                            <img class="testimonial-card__avatar" src="{{ asset('frontend/assets/images/avatar-alex-thorne.png') }}" alt="" />
                            <div class="testimonial-card__who">
                                <span class="testimonial-card__name">Alex Thorne</span>
                                <span class="testimonial-card__role">Core Contributor, <strong>Phoenix Trade</strong></span>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <div class="col">
                    <figure class="testimonial-card testimonial-card--featured">
                        <div class="testimonial-card__top">
                            <div class="testimonial-card__meta">
                                <span class="testimonial-card__tag">INFRASTRUCTURE</span>
                                <span class="testimonial-card__mark">
                                    <img src="{{ asset('frontend/assets/icons/quote-green.svg') }}" alt="" />
                                </span>
                            </div>
                            <blockquote class="testimonial-card__quote">
                                &quot;We migrated our entire NFT infrastructure to Techudio. Minting cost dropped from
                                dollars to fractions of a cent, allowing us to onboard millions of mainstream users.&quot;
                            </blockquote>
                        </div>
                        <figcaption class="testimonial-card__author">
                            <img class="testimonial-card__avatar" src="{{ asset('frontend/assets/images/avatar-elena-rostova.png') }}" alt="" />
                            <div class="testimonial-card__who">
                                <span class="testimonial-card__name">Elena Rostova</span>
                                <span class="testimonial-card__role">VP of Product, <strong>Metaplex Studio</strong></span>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <div class="col">
                    <figure class="testimonial-card">
                        <div class="testimonial-card__top">
                            <div class="testimonial-card__meta">
                                <span class="testimonial-card__tag">HARDWARE / IOT</span>
                                <span class="testimonial-card__mark">
                                    <img src="{{ asset('frontend/assets/icons/quote-purple.svg') }}" alt="" />
                                </span>
                            </div>
                            <blockquote class="testimonial-card__quote">
                                &quot;The computational model of Sealevel allows us to run state transitions in parallel.
                                It completely redefines what is possible for high-throughput consumer dApps.&quot;
                            </blockquote>
                        </div>
                        <figcaption class="testimonial-card__author">
                            <img class="testimonial-card__avatar" src="{{ asset('frontend/assets/images/avatar-marcus-vance.png') }}" alt="" />
                            <div class="testimonial-card__who">
                                <span class="testimonial-card__name">Marcus Vance</span>
                                <span class="testimonial-card__role">Lead Systems Architect, <strong>Helium Network</strong></span>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>

            <p class="testimonials__trust">
                Ready to scale your application?
                <a href="#">Read the Sealevel documentation</a>
            </p>
        </div>
    </section>
</main>
@endsection