<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('admin.contacts.index') }}" class="text-sm text-slate-400 hover:text-violet-300">← Back to messages</a>
        <div class="flex flex-wrap items-end justify-between gap-4 mt-2">
            <div>
                <h1 class="font-display text-3xl font-bold">{{ $message->full_name }}</h1>
                <p class="text-slate-400 text-sm mt-1">Received {{ $message->created_at->format('M d, Y · h:i A') }} ({{ $message->created_at->diffForHumans() }})</p>
            </div>
            <div class="flex gap-3">
                <a href="mailto:{{ $message->email }}" class="ai-btn">Reply by email</a>
                <form method="POST" action="{{ route('admin.contacts.destroy', $message) }}" data-confirm="Delete this message?">
                    @csrf @method('DELETE')
                    <button class="px-4 py-2 rounded-xl text-sm text-rose-300 border border-rose-500/30 hover:bg-rose-500/10">Delete</button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
        <div class="ai-card ai-card-glow h-fit">
            <h3 class="font-display font-semibold mb-4">Sender</h3>
            <dl class="space-y-3 text-sm">
                @foreach ([['Email', $message->email], ['Phone', $message->phone], ['Company', $message->company], ['IP address', $message->ip_address]] as [$label, $value])
                    <div class="flex justify-between gap-4"><dt class="text-slate-400">{{ $label }}</dt><dd class="text-right break-all">{{ $value ?: '—' }}</dd></div>
                @endforeach
            </dl>
        </div>
        <div class="ai-card xl:col-span-2">
            <h3 class="font-display font-semibold mb-3">Message</h3>
            <p class="text-sm text-slate-300 whitespace-pre-line leading-relaxed">{{ $message->message }}</p>
        </div>
    </div>
</x-app-layout>
