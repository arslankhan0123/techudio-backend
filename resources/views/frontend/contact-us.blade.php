@extends('layouts.frontend.main')
@section('title', 'Contact Us — Techudio')
@section('content')
<main class="contact-page">
      <div class="contact-page__backdrop" aria-hidden="true">
        <div class="contact-page__ribbon"><img src="{{ asset('frontend/assets/images/ribbon.png') }}" alt="" /></div>
        <img class="contact-page__aurora" src="{{ asset('frontend/assets/images/aurora.png') }}" alt="" />
      </div>

      <!-- Hero -->
      <section class="contact-hero">
        <div class="contact-hero__glows" aria-hidden="true">
          <img src="{{ asset('frontend/assets/glows/contact-hero-purple.svg') }}" alt="" />
          <img src="{{ asset('frontend/assets/glows/contact-hero-cyan.svg') }}" alt="" />
        </div>

        <div class="eyebrow eyebrow--round">
          <span class="eyebrow__dot"><img src="{{ asset('frontend/assets/glows/eyebrow-dot.svg') }}" alt="" /></span>
          <span class="eyebrow__text">Get In Touch</span>
        </div>
        <h1 class="contact-hero__title">
          Let’s Build Something<br />
          <span class="text-gradient">Amazing Together</span>
        </h1>
        <p class="contact-hero__lead">
          Have an idea or a complex business problem? Drop us a message. Our team of software architects and
          engineers is ready to help you deploy production-ready digital solutions.
        </p>
        <div class="contact-hero__divider"></div>
      </section>

      <div class="container-fluid container-wide contact-page__body">
        <!-- Form + contact details -->
        <section class="contact-core">
          <form class="contact-card" id="contactForm" method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data" novalidate>
@csrf
            <h2 class="contact-card__title">Send us a Message</h2>

            <div class="contact-card__fields">
              <div class="row row-cols-1 row-cols-md-2 form-row">
                <div class="col">
                  <div class="field field--contact">
                    <label class="field__label" for="fullName"> Full Name </label>
                    <input
                      class="form-control"
                      id="fullName"
                      name="fullName"
                      type="text"
                      placeholder="John Doe"
                      required
                      data-error-required="Please enter your full name."
                    />
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="field field--contact">
                    <label class="field__label" for="email"> Email Address </label>
                    <input
                      class="form-control"
                      id="email"
                      name="email"
                      type="email"
                      placeholder="john@example.com"
                      required
                      data-error-required="Please enter your email address."
                      data-error-invalid="Please enter a valid email address."
                    />
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
              </div>
              <div class="row row-cols-1 row-cols-md-2 form-row">
                <div class="col">
                  <div class="field field--contact">
                    <label class="field__label" for="phone"> Phone Number </label>
                    <input
                      class="form-control"
                      id="phone"
                      name="phone"
                      type="tel"
                      placeholder="+1 (555) 000-0000"
                      required
                      data-error-required="Please enter your phone number."
                    />
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="field field--contact">
                    <label class="field__label" for="company"> Company Name (Optional) </label>
                    <input
                      class="form-control"
                      id="company"
                      name="company"
                      type="text"
                      placeholder="Acme Corp"
                    />
                  </div>
                </div>
              </div>
              <div class="field field--contact">
                <label class="field__label" for="message">Your Message</label>
                <textarea
                  class="form-control"
                  id="message"
                  name="message"
                  placeholder="Tell us about your project, timeline, and goals..."
                  required
                  data-error-required="Please tell us about your project."
                ></textarea>
                <div class="invalid-feedback"></div>
              </div>
            </div>

            <button class="btn btn-solid w-100" type="submit">Send Message</button>
          </form>

          <aside class="contact-info">
            <div class="info-card">
              <img class="info-card__glow" src="{{ asset('frontend/assets/glows/info-purple.svg') }}" alt="" />
              <div class="info-card__icon" style="--info-color: var(--tq-violet)">
                <img src="{{ asset('frontend/assets/icons/map-pin.svg') }}" alt="" />
              </div>
              <div class="info-card__body">
                <h3 class="info-card__title">Office Location</h3>
                <div class="info-card__values">
                  <p>Remote Working</p>
                </div>
              </div>
            </div>
            <div class="info-card">
              <img class="info-card__glow" src="{{ asset('frontend/assets/glows/info-cyan.svg') }}" alt="" />
              <div class="info-card__icon" style="--info-color: var(--tq-cyan)">
                <img src="{{ asset('frontend/assets/icons/mail.svg') }}" alt="" />
              </div>
              <div class="info-card__body">
                <h3 class="info-card__title">General &amp; Support Email</h3>
                <div class="info-card__values">
                  <p>hello@techudio.com</p>
                  <p>support@techudio.com</p>
                </div>
              </div>
            </div>
            <div class="info-card">
              <img class="info-card__glow" src="{{ asset('frontend/assets/glows/info-green.svg') }}" alt="" />
              <div class="info-card__icon" style="--info-color: var(--tq-mint)">
                <img src="{{ asset('frontend/assets/icons/phone.svg') }}" alt="" />
              </div>
              <div class="info-card__body">
                <h3 class="info-card__title">Contact Phone</h3>
                <div class="info-card__values">
                  <p>+1 (555) 123-4567</p>
                  <p>Available 24/7 for Enterprise Support</p>
                </div>
              </div>
            </div>
          </aside>
        </section>

        <!-- FAQs -->
        <section class="faqs">
          <header class="faqs__head">
            <h2 class="faqs__title">Frequently Asked Questions</h2>
            <p class="faqs__lead">Quick answers to help you navigate our development process.</p>
          </header>

          <div class="faqs__list">
            <div class="faq-card">
              <button
                class="faq-card__toggle"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#faq-1"
                aria-expanded="true"
                aria-controls="faq-1"
              >
                <span class="faq-card__question">What services do you offer?</span>
                <img src="{{ asset('frontend/assets/icons/chevron-down.svg') }}" alt="" />
              </button>
              <div class="collapse show" id="faq-1">
                <p class="faq-card__answer">
                  We offer end-to-end digital solutions including custom web development, native iOS and
                  Android mobile app development, custom API architecture, AI integrations, continuous
                  maintenance, QA testing, and cloud infrastructure management.
                </p>
              </div>
            </div>
            <div class="faq-card">
              <button
                class="faq-card__toggle"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#faq-2"
                aria-expanded="true"
                aria-controls="faq-2"
              >
                <span class="faq-card__question">What is your typical project timeline?</span>
                <img src="{{ asset('frontend/assets/icons/chevron-down.svg') }}" alt="" />
              </button>
              <div class="collapse show" id="faq-2">
                <p class="faq-card__answer">
                  Timelines depend heavily on the project complexity. A standard Minimum Viable Product (MVP)
                  typically takes 6 to 10 weeks, while robust enterprise-grade architectures may span several
                  months with iterative agile sprint deliverables.
                </p>
              </div>
            </div>
            <div class="faq-card">
              <button
                class="faq-card__toggle"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#faq-3"
                aria-expanded="true"
                aria-controls="faq-3"
              >
                <span class="faq-card__question">Do you offer ongoing maintenance?</span>
                <img src="{{ asset('frontend/assets/icons/chevron-down.svg') }}" alt="" />
              </button>
              <div class="collapse show" id="faq-3">
                <p class="faq-card__answer">
                  Yes, we provide scalable post-launch maintenance, regular framework updates, security
                  audits, and continuous performance optimization packages customized for your project's SLAs.
                </p>
              </div>
            </div>
            <div class="faq-card">
              <button
                class="faq-card__toggle"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#faq-4"
                aria-expanded="true"
                aria-controls="faq-4"
              >
                <span class="faq-card__question">How do you handle communication during projects?</span>
                <img src="{{ asset('frontend/assets/icons/chevron-down.svg') }}" alt="" />
              </button>
              <div class="collapse show" id="faq-4">
                <p class="faq-card__answer">
                  We follow structured agile methodologies. You get a dedicated technical product manager,
                  direct Slack channel access, and routine sprint demo videos ensuring absolute transparency
                  from roadmap to deployment.
                </p>
              </div>
            </div>
            <button class="btn btn-solid" type="button">See more</button>
          </div>
        </section>
      </div>

      <!-- Call to action -->
      <section class="cta-banner">
        <div class="cta-banner__text">
          <h2 class="cta-banner__title">Ready to Transform Your Ideas?</h2>
          <p class="cta-banner__lead">
            Get a high-performance team on your roadmap. Join thousands of creators, scaling startups, and
            enterprise brands building on Techudio.
          </p>
        </div>
        <a class="btn btn-solid btn-solid--pill" href="{{ route('quote') }}">Start Building</a>
      </section>
    </main>


    <!-- Thank-you overlay, opened by js/main.js after a successful submit -->
    <div
      class="modal fade thankyou"
      id="thankYouModal"
      tabindex="-1"
      aria-labelledby="thankYouTitle"
      aria-hidden="true"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
    >
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="thankyou__backdrop"><img src="{{ asset('frontend/assets/images/aurora.png') }}" alt="" /></div>

          <div class="thankyou__card">
            <div class="thankyou__icon bg-brand"><img src="{{ asset('frontend/assets/icons/check.svg') }}" alt="" /></div>
            <div class="thankyou__text">
              <h2 class="thankyou__title" id="thankYouTitle">Thank You for Contacting Techudio!</h2>
              <p class="thankyou__subtitle bg-brand text-gradient">We've received your inquiry.</p>
              <div class="thankyou__body">
                <p>
                  Our experts are now reviewing your requirements and will contact you shortly with a
                  personalized proposal.
                </p>
                <p>We appreciate the opportunity to work with you.</p>
              </div>
            </div>
            <div class="thankyou__action">
              <a class="bg-brand" href="{{ route('home') }}">
                <span>Back to Home</span>
                <img src="{{ asset('frontend/assets/icons/rocket.svg') }}" alt="" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
