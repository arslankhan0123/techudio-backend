<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Techudio') }} · Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700|inter:400,500,600&display=swap" rel="stylesheet" />
    <script>try{if(localStorage.getItem('theme')==='light')document.documentElement.classList.add('light')}catch(e){}</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="ai-body font-sans antialiased text-slate-200" x-data="{ sidebar: false }">
    <div class="ai-bg" aria-hidden="true">
        <div class="ai-orb ai-orb-1"></div>
        <div class="ai-orb ai-orb-2"></div>
        <div class="ai-orb ai-orb-3"></div>
        <div class="ai-grid"></div>
    </div>

    <div class="relative flex min-h-screen">
        {{-- Sidebar --}}
        <aside :class="sidebar ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-40 w-64 transform transition-transform duration-300 lg:translate-x-0 lg:static ai-glass border-r border-white/5 flex flex-col">
            <div class="flex items-center gap-3 px-6 h-16 border-b border-white/5">
                <div class="ai-logo">
                    <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 5.6L20 10l-5.6 2.4L12 18l-2.4-5.6L4 10l5.6-2.4z"/></svg>
                </div>
                <span class="font-display text-lg font-bold tracking-tight">Tech<span class="ai-gradient-text">udio</span></span>
            </div>

            @php
                $nav = [
                    ['Dashboard', 'dashboard', 'M3 12l9-9 9 9M5 10v10h14V10'],
                    ['AI Models', null, 'M12 2a4 4 0 014 4v1a4 4 0 01-8 0V6a4 4 0 014-4zM4 21v-1a6 6 0 0112 0v1'],
                    ['Users', null, 'M17 20h5v-2a3 3 0 00-5.4-1.8M9 20H2v-2a3 3 0 015.4-1.8M16 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ['Analytics', null, 'M3 3v18h18M7 15l4-4 3 3 5-6'],
                    ['Automations', null, 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['Settings', 'profile.edit', 'M12 15a3 3 0 100-6 3 3 0 000 6zM19.4 15a1.7 1.7 0 00.3 1.8l.1.1a2 2 0 11-2.8 2.8l-.1-.1a1.7 1.7 0 00-1.8-.3 1.7 1.7 0 00-1 1.5V21a2 2 0 11-4 0v-.1a1.7 1.7 0 00-1.1-1.5 1.7 1.7 0 00-1.8.3l-.1.1a2 2 0 11-2.8-2.8l.1-.1a1.7 1.7 0 00.3-1.8 1.7 1.7 0 00-1.5-1H3a2 2 0 110-4h.1a1.7 1.7 0 001.5-1.1 1.7 1.7 0 00-.3-1.8l-.1-.1a2 2 0 112.8-2.8l.1.1a1.7 1.7 0 001.8.3H9a1.7 1.7 0 001-1.5V3a2 2 0 114 0v.1a1.7 1.7 0 001 1.5 1.7 1.7 0 001.8-.3l.1-.1a2 2 0 112.8 2.8l-.1.1a1.7 1.7 0 00-.3 1.8V9a1.7 1.7 0 001.5 1H21a2 2 0 110 4h-.1a1.7 1.7 0 00-1.5 1z'],
                ];
            @endphp
            <nav class="flex-1 px-3 py-6 space-y-1">
                <p class="px-3 mb-2 text-[10px] uppercase tracking-[0.2em] text-slate-500">Main</p>
                @foreach ($nav as [$label, $route, $icon])
                    @php $active = $route && request()->routeIs($route); @endphp
                    <a href="{{ $route ? route($route) : '#' }}"
                       class="ai-nav-link {{ $active ? 'ai-nav-active' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="{{ $icon }}"/></svg>
                        <span>{{ $label }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="m-3 p-4 rounded-2xl ai-card-glow">
                <p class="text-sm font-semibold">AI Credits</p>
                <p class="text-xs text-slate-400 mt-1">72% of monthly quota used</p>
                <div class="mt-3 h-1.5 rounded-full bg-white/10 overflow-hidden"><div class="h-full w-[72%] ai-gradient-bg"></div></div>
            </div>
        </aside>
        <div x-show="sidebar" @click="sidebar=false" x-cloak class="fixed inset-0 z-30 bg-black/60 lg:hidden"></div>

        {{-- Main --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="sticky top-0 z-20 h-16 ai-glass border-b border-white/5 flex items-center gap-4 px-4 sm:px-8">
                <button @click="sidebar=!sidebar" class="lg:hidden p-2 rounded-lg hover:bg-white/5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="relative flex-1 max-w-md hidden sm:block">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
                    <input type="text" placeholder="Ask AI or search anything…" class="w-full pl-10 pr-4 py-2 rounded-xl bg-white/5 border border-white/10 text-sm placeholder-slate-500 focus:border-violet-500 focus:ring-violet-500/30">
                </div>
                <div class="ml-auto flex items-center gap-3">
                    <button type="button" x-data="{ light: document.documentElement.classList.contains('light') }"
                            @click="light=!light; document.documentElement.classList.toggle('light', light); try{localStorage.setItem('theme', light?'light':'dark')}catch(e){}"
                            class="p-2 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10" :title="light ? 'Dark mode' : 'Light mode'">
                        <svg x-show="!light" class="w-5 h-5 text-amber-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
                        <svg x-show="light" x-cloak class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 12.8A9 9 0 1111.2 3a7 7 0 009.8 9.8z"/></svg>
                    </button>
                    <span class="hidden md:inline-flex items-center gap-2 text-xs px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-300 border border-emerald-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> All systems online
                    </span>
                    <div x-data="{ open:false }" class="relative">
                        <button @click="open=!open" class="flex items-center gap-3 pl-2 pr-3 py-1.5 rounded-xl hover:bg-white/5">
                            <span class="w-8 h-8 rounded-lg ai-gradient-bg grid place-items-center text-sm font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <span class="hidden sm:block text-left leading-tight">
                                <span class="block text-sm font-medium">{{ Auth::user()->name }}</span>
                                <span class="block text-[11px] text-violet-300 capitalize">{{ Auth::user()->role }}</span>
                            </span>
                        </button>
                        <div x-show="open" @click.outside="open=false" x-cloak x-transition class="absolute right-0 mt-2 w-48 rounded-xl ai-glass border border-white/10 py-1 shadow-2xl">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-white/5">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-2 text-sm text-rose-300 hover:bg-white/5">Log out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            @isset($header)
                <div class="px-4 sm:px-8 pt-8">{{ $header }}</div>
            @endisset

            <main class="flex-1 px-4 sm:px-8 py-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
