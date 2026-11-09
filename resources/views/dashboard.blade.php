<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-violet-300/80">Command Center</p>
                <h1 class="font-display text-3xl font-bold mt-1">Welcome back, <span class="ai-gradient-text">{{ Auth::user()->name }}</span></h1>
                <p class="text-slate-400 text-sm mt-1">Here's what your AI workspace is doing today.</p>
            </div>
            <button class="ai-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                New AI Task
            </button>
        </div>
    </x-slot>

    @php
        $stats = [
            ['Total Users', number_format(\App\Models\User::count()), '+12.4%', 'from-violet-500 to-fuchsia-500'],
            ['AI Requests', '48.2K', '+28.1%', 'from-cyan-400 to-blue-500'],
            ['Tokens Used', '3.6M', '+9.7%', 'from-fuchsia-500 to-pink-500'],
            ['Avg. Latency', '182ms', '-14.2%', 'from-emerald-400 to-teal-500'],
        ];
        $bars = [38, 52, 45, 70, 62, 85, 74, 92, 68, 80, 96, 88];
    @endphp

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        @foreach ($stats as [$label, $value, $delta, $grad])
            <div class="ai-card group">
                <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full bg-gradient-to-br {{ $grad }} opacity-20 blur-2xl group-hover:opacity-40 transition"></div>
                <p class="text-sm text-slate-400">{{ $label }}</p>
                <p class="font-display text-3xl font-bold mt-2">{{ $value }}</p>
                <p class="text-xs mt-3 {{ str_starts_with($delta, '-') && $label !== 'Avg. Latency' ? 'text-rose-300' : 'text-emerald-300' }}">{{ $delta }} <span class="text-slate-500">vs last month</span></p>
                <div class="mt-4 h-1 rounded-full bg-gradient-to-r {{ $grad }}"></div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 mt-5">
        {{-- Chart --}}
        <div class="ai-card xl:col-span-2">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-display font-semibold">AI Usage Overview</h3>
                    <p class="text-xs text-slate-400">Requests per month</p>
                </div>
                <div class="flex gap-1 text-xs p-1 rounded-lg bg-white/5">
                    <span class="px-3 py-1 rounded-md ai-gradient-bg text-white">12M</span>
                    <span class="px-3 py-1 text-slate-400">30D</span>
                    <span class="px-3 py-1 text-slate-400">7D</span>
                </div>
            </div>
            <div class="mt-8 h-56 flex items-end gap-2 sm:gap-3">
                @foreach ($bars as $i => $h)
                    <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                        <div class="w-full rounded-t-lg ai-bar" style="height: {{ $h }}%"></div>
                        <span class="text-[10px] text-slate-500">{{ ['J','F','M','A','M','J','J','A','S','O','N','D'][$i] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Model health --}}
        <div class="ai-card">
            <h3 class="font-display font-semibold">Model Performance</h3>
            <p class="text-xs text-slate-400">Accuracy across active models</p>
            <div class="mt-6 space-y-5">
                @foreach ([['Text Generation', 94, 'from-violet-500 to-fuchsia-500'], ['Vision', 88, 'from-cyan-400 to-blue-500'], ['Speech-to-Text', 91, 'from-fuchsia-500 to-pink-500'], ['Embeddings', 97, 'from-emerald-400 to-teal-500']] as [$m, $p, $g])
                    <div>
                        <div class="flex justify-between text-sm"><span>{{ $m }}</span><span class="text-slate-400">{{ $p }}%</span></div>
                        <div class="mt-2 h-2 rounded-full bg-white/5 overflow-hidden"><div class="h-full rounded-full bg-gradient-to-r {{ $g }}" style="width: {{ $p }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 mt-5">
        {{-- Recent users --}}
        <div class="ai-card xl:col-span-2 overflow-hidden">
            <h3 class="font-display font-semibold">Recent Users</h3>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-left text-xs uppercase tracking-wider text-slate-500">
                        <tr><th class="py-2">Name</th><th>Email</th><th>Role</th><th>Joined</th></tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach (\App\Models\User::latest()->take(6)->get() as $u)
                            <tr>
                                <td class="py-3 flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-white/10 grid place-items-center text-xs font-bold">{{ strtoupper(substr($u->name, 0, 1)) }}</span>{{ $u->name }}
                                </td>
                                <td class="text-slate-400">{{ $u->email }}</td>
                                <td><span class="px-2 py-0.5 rounded-full text-xs capitalize {{ $u->isMasterAdmin() ? 'bg-violet-500/15 text-violet-300 border border-violet-500/30' : 'bg-white/5 text-slate-300 border border-white/10' }}">{{ $u->role }}</span></td>
                                <td class="text-slate-400">{{ $u->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- AI assistant --}}
        <div class="ai-card ai-card-glow flex flex-col">
            <div class="flex items-center gap-3">
                <div class="ai-logo"><svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 5.6L20 10l-5.6 2.4L12 18l-2.4-5.6L4 10l5.6-2.4z"/></svg></div>
                <div><h3 class="font-display font-semibold">AI Assistant</h3><p class="text-xs text-emerald-300">Online</p></div>
            </div>
            <div class="mt-5 space-y-3 text-sm flex-1">
                <div class="p-3 rounded-xl bg-white/5 border border-white/5">Usage is up 28% this month. Want me to forecast next month's token spend?</div>
                <div class="p-3 rounded-xl ai-gradient-bg text-white ml-8">Yes, and flag any unusual spikes.</div>
            </div>
            <div class="mt-4 flex gap-2">
                <input placeholder="Type a prompt…" class="flex-1 px-3 py-2 rounded-xl bg-white/5 border border-white/10 text-sm focus:border-violet-500 focus:ring-violet-500/30">
                <button class="ai-btn px-3">➤</button>
            </div>
        </div>
    </div>
</x-app-layout>
