<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-violet-300/80">Command Center</p>
                <h1 class="font-display text-3xl font-bold mt-1">Welcome back, <span class="ai-gradient-text">{{ Auth::user()->name }}</span></h1>
                <p class="text-slate-400 text-sm mt-1">Here's what's coming in from your website.</p>
            </div>
            <a href="{{ route('admin.quotes.index') }}" class="ai-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12h6M9 16h6M5 3h10l4 4v14H5z"/></svg>
                View Quote Requests
            </a>
        </div>
    </x-slot>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        @foreach ($stats as $s)
            <a @if ($s['route']) href="{{ $s['route'] }}" @endif class="ai-card group block">
                <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full bg-gradient-to-br {{ $s['grad'] }} opacity-20 blur-2xl group-hover:opacity-40 transition"></div>
                <p class="text-sm text-slate-400">{{ $s['label'] }}</p>
                <p class="font-display text-3xl font-bold mt-2">{{ number_format($s['value']) }}</p>
                <p class="text-xs mt-3">
                    @if (! is_null($s['trend']))
                        <span class="{{ $s['trend'] >= 0 ? 'text-emerald-300' : 'text-rose-300' }}">{{ $s['trend'] >= 0 ? '+' : '' }}{{ $s['trend'] }}%</span>
                        <span class="text-slate-500">vs last month ·</span>
                    @endif
                    <span class="text-slate-500">{{ $s['note'] }}</span>
                </p>
                <div class="mt-4 h-1 rounded-full ai-progress bg-gradient-to-r {{ $s['grad'] }}"></div>
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 mt-5">
        {{-- Leads chart --}}
        <div class="ai-card xl:col-span-2">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h3 class="font-display font-semibold">Leads Overview</h3>
                    <p class="text-xs text-slate-400">Quote requests & contact messages · last 12 months</p>
                </div>
                <div class="flex gap-4 text-xs text-slate-400">
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-sm bg-violet-500"></span>Quotes</span>
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-sm bg-cyan-400"></span>Messages</span>
                </div>
            </div>
            <div class="mt-8 h-56 flex items-end gap-2 sm:gap-3">
                @foreach ($chart as $c)
                    @php $total = $c['quotes'] + $c['contacts']; @endphp
                    <div class="group/bar flex-1 flex flex-col items-center gap-2 h-full justify-end relative">
                        <span class="absolute -top-1 -translate-y-full opacity-0 group-hover/bar:opacity-100 transition text-[11px] whitespace-nowrap px-2 py-1 rounded-lg bg-slate-900 text-white shadow-lg z-10 pointer-events-none">
                            {{ $c['full'] }}: {{ $c['quotes'] }} quotes · {{ $c['contacts'] }} msgs
                        </span>
                        <span class="text-[10px] text-slate-400">{{ $total ?: '' }}</span>
                        <div class="w-full flex flex-col justify-end rounded-t-lg overflow-hidden ai-bar" style="height: {{ max($total ? 4 : 2, $total / $chartMax * 100) }}%">
                            @if ($total)
                                <div class="w-full bg-cyan-400/80" style="height: {{ $c['contacts'] / $total * 100 }}%"></div>
                                <div class="w-full bg-gradient-to-t from-violet-600 to-indigo-400" style="height: {{ $c['quotes'] / $total * 100 }}%"></div>
                            @else
                                <div class="w-full h-full bg-white/10"></div>
                            @endif
                        </div>
                        <span class="text-[10px] text-slate-500">{{ $c['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Top services --}}
        <div class="ai-card">
            <h3 class="font-display font-semibold">Most Requested Services</h3>
            <p class="text-xs text-slate-400">Share of quote requests asking for each service</p>
            <div class="mt-6 space-y-5">
                @php $grads = ['from-violet-500 to-indigo-500', 'from-cyan-400 to-blue-500', 'from-indigo-500 to-blue-500', 'from-emerald-400 to-teal-500', 'from-sky-400 to-cyan-500']; @endphp
                @forelse ($topServices as $service => $count)
                    @php $pct = round($count / $quotesWithServices * 100); @endphp
                    <div>
                        <div class="flex justify-between gap-3 text-sm"><span class="truncate">{{ $service }}</span><span class="text-slate-400 shrink-0">{{ $count }} · {{ $pct }}%</span></div>
                        <div class="mt-2 h-2 rounded-full bg-white/5 overflow-hidden"><div class="h-full rounded-full ai-progress bg-gradient-to-r {{ $grads[$loop->index % 5] }}" style="width: {{ $pct }}%"></div></div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 py-10 text-center">No quote requests yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 mt-5">
        {{-- Latest leads --}}
        <div class="ai-card xl:col-span-2 overflow-hidden">
            <div class="flex items-center justify-between">
                <h3 class="font-display font-semibold">Latest Leads</h3>
                <span class="text-xs text-slate-400">{{ $totalUsers }} registered {{ \Illuminate\Support\Str::plural('user', $totalUsers) }}</span>
            </div>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-left text-xs uppercase tracking-wider text-slate-500">
                        <tr><th class="py-2">Name</th><th>Type</th><th>Details</th><th>Received</th></tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($recent as $lead)
                            <tr class="cursor-pointer" onclick="window.location='{{ $lead['url'] }}'">
                                <td class="py-3">
                                    <div class="flex items-center gap-3">
                                        <span class="w-8 h-8 rounded-lg ai-gradient-bg grid place-items-center text-xs font-bold text-white shrink-0">{{ strtoupper(substr($lead['name'], 0, 1)) }}</span>
                                        <span>
                                            <span class="font-medium flex items-center gap-2">{{ $lead['name'] }} @if ($lead['unread'])<span class="w-2 h-2 rounded-full bg-violet-400"></span>@endif</span>
                                            <span class="block text-xs text-slate-400">{{ $lead['email'] }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span class="px-2 py-0.5 rounded-full text-xs border {{ $lead['type'] === 'Quote' ? 'bg-violet-500/15 text-violet-300 border-violet-500/30' : 'bg-cyan-500/10 text-cyan-300 border-cyan-500/30' }}">{{ $lead['type'] }}</span>
                                </td>
                                <td class="text-slate-400 max-w-[220px] truncate">{{ $lead['detail'] }}</td>
                                <td class="text-slate-400 whitespace-nowrap">{{ $lead['at']->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-10 text-center text-slate-400">No leads yet — they'll appear here as soon as someone submits a form.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Budget breakdown --}}
        <div class="ai-card ai-card-glow">
            <h3 class="font-display font-semibold">Budget Breakdown</h3>
            <p class="text-xs text-slate-400">What clients plan to spend</p>
            @php $budgetTotal = max(1, $budgets->sum()); @endphp
            <div class="mt-5 space-y-3">
                @forelse ($budgets as $budget => $count)
                    <div class="flex items-center gap-3">
                        <span class="text-sm w-32 shrink-0 truncate">{{ $budget }}</span>
                        <div class="flex-1 h-2 rounded-full bg-white/5 overflow-hidden"><div class="h-full rounded-full ai-progress ai-gradient-bg" style="width: {{ $count / $budgetTotal * 100 }}%"></div></div>
                        <span class="text-xs text-slate-400 w-6 text-right">{{ $count }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 py-10 text-center">No budget data yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
