<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('admin.quotes.index') }}" class="text-sm text-slate-400 hover:text-violet-300">← Back to quote requests</a>
        <div class="flex flex-wrap items-end justify-between gap-4 mt-2">
            <div>
                <h1 class="font-display text-3xl font-bold">{{ $quote->full_name }}</h1>
                <p class="text-slate-400 text-sm mt-1">Received {{ $quote->created_at->format('M d, Y · h:i A') }} ({{ $quote->created_at->diffForHumans() }})</p>
            </div>
            <div class="flex gap-3">
                <a href="mailto:{{ $quote->email }}" class="ai-btn">Reply by email</a>
                <form method="POST" action="{{ route('admin.quotes.destroy', $quote) }}" data-confirm="Delete this quote request?">
                    @csrf @method('DELETE')
                    <button class="px-4 py-2 rounded-xl text-sm text-rose-300 border border-rose-500/30 hover:bg-rose-500/10">Delete</button>
                </form>
            </div>
        </div>
    </x-slot>

    @php
        $row = fn ($label, $value) => ['label' => $label, 'value' => $value];
        $chips = fn ($items) => collect($items ?? [])->filter()->values();
    @endphp

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
        <div class="ai-card ai-card-glow h-fit">
            <h3 class="font-display font-semibold mb-4">Contact details</h3>
            <dl class="space-y-3 text-sm">
                @foreach ([['Email', $quote->email], ['Phone', $quote->phone], ['Company', $quote->company], ['Country', $quote->country], ['NDA required', $quote->nda], ['IP address', $quote->ip_address]] as [$label, $value])
                    <div class="flex justify-between gap-4"><dt class="text-slate-400">{{ $label }}</dt><dd class="text-right break-all">{{ $value ?: '—' }}</dd></div>
                @endforeach
            </dl>
            <div class="mt-5 pt-5 border-t border-white/10 space-y-2 text-sm">
                <p class="text-slate-400">Preferred communication</p>
                <div class="flex flex-wrap gap-2">
                    @forelse ($chips($quote->communication) as $c)<span class="px-2.5 py-1 rounded-full text-xs bg-white/5 border border-white/10">{{ $c }}</span>@empty<span>—</span>@endforelse
                </div>
            </div>
        </div>

        <div class="xl:col-span-2 space-y-5">
            <div class="ai-card">
                <h3 class="font-display font-semibold mb-4">Project overview</h3>
                <div class="grid sm:grid-cols-3 gap-4">
                    @foreach ([['Project type', $quote->project_type], ['Budget', $quote->budget], ['Timeline', $quote->timeline]] as [$label, $value])
                        <div class="p-4 rounded-xl bg-white/5 border border-white/5">
                            <p class="text-xs text-slate-400">{{ $label }}</p>
                            <p class="font-display font-semibold mt-1">{{ $value ?: '—' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="ai-card">
                <h3 class="font-display font-semibold mb-3">Services needed</h3>
                <div class="flex flex-wrap gap-2">
                    @forelse ($quote->serviceLabels() as $s)
                        <span class="px-3 py-1 rounded-full text-xs bg-violet-500/15 text-violet-300 border border-violet-500/30">{{ $s }}</span>
                    @empty <span class="text-slate-400 text-sm">None selected</span> @endforelse
                </div>
                @if ($quote->other_services)
                    <p class="text-sm text-slate-400 mt-4">Other services</p>
                    <p class="text-sm mt-1 whitespace-pre-line">{{ $quote->other_services }}</p>
                @endif
            </div>

            @foreach ([['Project description', $quote->description], ['Additional details', $quote->details]] as [$title, $text])
                @if ($text)
                    <div class="ai-card">
                        <h3 class="font-display font-semibold mb-3">{{ $title }}</h3>
                        <p class="text-sm text-slate-300 whitespace-pre-line leading-relaxed">{{ $text }}</p>
                    </div>
                @endif
            @endforeach

            <div class="ai-card">
                <h3 class="font-display font-semibold mb-3">Existing assets</h3>
                <div class="flex flex-wrap gap-2">
                    @forelse ($chips($quote->assets) as $a)<span class="px-2.5 py-1 rounded-full text-xs bg-white/5 border border-white/10">{{ $a }}</span>@empty<span class="text-slate-400 text-sm">None</span>@endforelse
                </div>
            </div>

            <div class="ai-card">
                <h3 class="font-display font-semibold mb-3">Attachments</h3>
                @forelse ($quote->attachments ?? [] as $i => $file)
                    <a href="{{ route('admin.quotes.download', [$quote, $i]) }}" class="flex items-center justify-between gap-3 p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 mb-2">
                        <span class="text-sm truncate">📎 {{ $file['name'] }}</span>
                        <span class="text-xs text-slate-400 shrink-0">{{ number_format(($file['size'] ?? 0) / 1024, 1) }} KB · Download</span>
                    </a>
                @empty
                    <p class="text-sm text-slate-400">No files uploaded.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
