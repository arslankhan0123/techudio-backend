<x-app-layout>
    <x-slot name="header">
        <p class="text-xs uppercase tracking-[0.25em] text-violet-300/80">Account</p>
        <h1 class="font-display text-3xl font-bold mt-1">Profile <span class="ai-gradient-text">Settings</span></h1>
        <p class="text-slate-400 text-sm mt-1">Manage your identity, security and account.</p>
    </x-slot>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
        {{-- Identity card --}}
        <div class="ai-card ai-card-glow h-fit">
            <div class="flex flex-col items-center text-center">
                <div class="relative">
                    <div class="absolute inset-0 rounded-2xl ai-gradient-bg blur-xl opacity-60"></div>
                    <div class="relative w-24 h-24 rounded-2xl ai-gradient-bg grid place-items-center font-display text-4xl font-bold text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
                <h2 class="font-display text-xl font-semibold mt-5">{{ Auth::user()->name }}</h2>
                <p class="text-sm text-slate-400">{{ Auth::user()->email }}</p>
                <span class="mt-3 px-3 py-1 rounded-full text-xs capitalize bg-violet-500/15 text-violet-300 border border-violet-500/30">{{ Auth::user()->role }}</span>
            </div>
            <div class="mt-6 pt-6 border-t border-white/10 space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-slate-400">Member since</span><span>{{ Auth::user()->created_at->format('M d, Y') }}</span></div>
                <div class="flex justify-between"><span class="text-slate-400">Email status</span>
                    <span class="{{ Auth::user()->email_verified_at ? 'text-emerald-300' : 'text-amber-300' }}">{{ Auth::user()->email_verified_at ? 'Verified' : 'Unverified' }}</span></div>
                <div class="flex justify-between"><span class="text-slate-400">Last updated</span><span>{{ Auth::user()->updated_at->diffForHumans() }}</span></div>
            </div>
        </div>

        <div class="xl:col-span-2 space-y-5">
            <div class="ai-card"><div class="max-w-xl">@include('profile.partials.update-profile-information-form')</div></div>
            <div class="ai-card"><div class="max-w-xl">@include('profile.partials.update-password-form')</div></div>
        </div>
    </div>
</x-app-layout>
