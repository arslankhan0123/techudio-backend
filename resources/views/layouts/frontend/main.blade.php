<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Techudio')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('frontend/assets/favicon.svg') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Geist:wght@400;600;700&family=Inter:wght@400;500;600;700&family=Manrope:wght@400&family=Outfit:wght@600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}" />
</head>

<body>
    <!-- Navbar -->
    @unless (View::hasSection('bare'))
        @include('layouts.frontend.header')
    @endunless

    @yield('content')

    <!-- Footer -->
    @unless (View::hasSection('bare'))
        @include('layouts.frontend.footer')
    @endunless

    <script src="{{ asset('frontend/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>