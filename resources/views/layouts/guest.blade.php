<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Techudio') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700|inter:400,500,600&display=swap" rel="stylesheet" />
    <script>try{if(localStorage.getItem('theme')==='light')document.documentElement.classList.add('light')}catch(e){}</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="ai-body font-sans antialiased text-slate-200">
    <div class="ai-bg" aria-hidden="true">
        <div class="ai-orb ai-orb-1"></div>
        <div class="ai-orb ai-orb-2"></div>
        <div class="ai-orb ai-orb-3"></div>
        <div class="ai-grid"></div>
    </div>

    <div class="relative min-h-screen grid lg:grid-cols-2">
        {{-- Brand panel --}}
        <div class="hidden lg:flex flex-col justify-between p-12 border-r border-white/5">
            <a href="/" class="flex items-center gap-3">
                <div class="ai-logo"><svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 5.6L20 10l-5.6 2.4L12 18l-2.4-5.6L4 10l5.6-2.4z"/></svg></div>
                <span class="font-display text-xl font-bold">Tech<span class="ai-gradient-text">udio</span></span>
            </a>
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-violet-300/80">AI-powered workspace</p>
                <h1 class="font-display text-5xl font-bold leading-tight mt-4">Build smarter.<br><span class="ai-gradient-text">Ship faster.</span></h1>
                <p class="text-slate-400 mt-4 max-w-md">One command center for your models, users, automations and analytics.</p>
                <div class="mt-10 grid grid-cols-3 gap-4 max-w-md">
                    @foreach ([['48K+', 'AI requests'], ['99.9%', 'Uptime'], ['182ms', 'Latency']] as [$v, $l])
                        <div class="ai-card !p-4"><p class="font-display text-xl font-bold ai-gradient-text">{{ $v }}</p><p class="text-xs text-slate-400 mt-1">{{ $l }}</p></div>
                    @endforeach
                </div>
            </div>
            <p class="text-xs text-slate-500">© {{ date('Y') }} Techudio. All rights reserved.</p>
        </div>

        {{-- Form panel --}}
        <div class="flex flex-col items-center justify-center p-6 sm:p-12">
            <a href="/" class="lg:hidden flex items-center gap-3 mb-8">
                <div class="ai-logo"><svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 5.6L20 10l-5.6 2.4L12 18l-2.4-5.6L4 10l5.6-2.4z"/></svg></div>
                <span class="font-display text-xl font-bold">Tech<span class="ai-gradient-text">udio</span></span>
            </a>
            <div class="w-full max-w-md ai-card ai-card-glow !p-8">
                @if (request()->routeIs('login'))
                    <h2 class="font-display text-2xl font-bold">Welcome back</h2>
                    <p class="text-sm text-slate-400 mt-1 mb-6">Sign in to your AI command center.</p>
                @elseif (request()->routeIs('register'))
                    <h2 class="font-display text-2xl font-bold">Create your account</h2>
                    <p class="text-sm text-slate-400 mt-1 mb-6">Start building with Techudio in seconds.</p>
                @endif
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
