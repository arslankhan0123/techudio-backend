<x-app-layout>
    <x-slot name="header">
        <p class="text-xs uppercase tracking-[0.25em] text-violet-300/80">Leads</p>
        <h1 class="font-display text-3xl font-bold mt-1">Quote <span class="ai-gradient-text">Requests</span></h1>
        <p class="text-slate-400 text-sm mt-1">{{ $quotes->total() }} total · submitted from the “Get a Free Quote” page.</p>
    </x-slot>

    <form method="GET" class="flex flex-wrap gap-3 mb-5">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email or company…" class="ai-input flex-1 min-w-[220px] text-sm">
        <select name="status" class="ai-input text-sm">
            <option value="">All</option>
            <option value="unread" @selected(request('status') === 'unread')>Unread only</option>
        </select>
        <button class="ai-btn">Filter</button>
        @if (request()->hasAny(['search', 'status']))
            <a href="{{ url()->current() }}" class="px-4 py-2 rounded-xl text-sm bg-white/5 border border-white/10 hover:bg-white/10">Reset</a>
        @endif
    </form>

    <div class="ai-card !p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-left text-xs uppercase tracking-wider text-slate-500 border-b border-white/5">
                    <tr><th class="px-6 py-4">Client</th><th class="px-6">Services</th><th class="px-6">Budget</th><th class="px-6">Timeline</th><th class="px-6">Received</th><th class="px-6 text-right">Actions</th></tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($quotes as $quote)
                        <tr class="hover:bg-white/5 transition {{ $quote->read_at ? '' : 'bg-violet-500/[0.06]' }}">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.quotes.show', $quote) }}" class="flex items-center gap-3">
                                    <span class="w-9 h-9 rounded-lg ai-gradient-bg grid place-items-center text-xs font-bold text-white shrink-0">{{ strtoupper(substr($quote->full_name, 0, 1)) }}</span>
                                    <span>
                                        <span class="font-medium flex items-center gap-2">{{ $quote->full_name }}
                                            @unless ($quote->read_at)<span class="w-2 h-2 rounded-full bg-indigo-400"></span>@endunless
                                        </span>
                                        <span class="block text-xs text-slate-400">{{ $quote->email }}{{ $quote->company ? ' · '.$quote->company : '' }}</span>
                                    </span>
                                </a>
                            </td>
                            <td class="px-6 text-slate-300 max-w-xs">
                                @php $labels = $quote->serviceLabels(); @endphp
                                {{ implode(', ', array_slice($labels, 0, 2)) ?: '—' }}
                                @if (count($labels) > 2)<span class="text-xs text-violet-300">+{{ count($labels) - 2 }} more</span>@endif
                            </td>
                            <td class="px-6 text-slate-300 whitespace-nowrap">{{ $quote->budget ?? '—' }}</td>
                            <td class="px-6 text-slate-300 whitespace-nowrap">{{ $quote->timeline ?? '—' }}</td>
                            <td class="px-6 text-slate-400 whitespace-nowrap">{{ $quote->created_at->diffForHumans() }}</td>
                            <td class="px-6 text-right whitespace-nowrap">
                                <a href="{{ route('admin.quotes.show', $quote) }}" class="text-violet-300 hover:underline">View</a>
                                <form method="POST" action="{{ route('admin.quotes.destroy', $quote) }}" class="inline" data-confirm="Delete this quote request?">
                                    @csrf @method('DELETE')
                                    <button class="ml-3 text-rose-300 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-16 text-center text-slate-400">No quote requests yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-5">{{ $quotes->links() }}</div>
</x-app-layout>
