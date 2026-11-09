<x-app-layout>
    <x-slot name="header">
        <p class="text-xs uppercase tracking-[0.25em] text-violet-300/80">Inbox</p>
        <h1 class="font-display text-3xl font-bold mt-1">Contact <span class="ai-gradient-text">Messages</span></h1>
        <p class="text-slate-400 text-sm mt-1">{{ $messages->total() }} total · submitted from the “Contact us” page.</p>
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
                    <tr><th class="px-6 py-4">Sender</th><th class="px-6">Message</th><th class="px-6">Phone</th><th class="px-6">Received</th><th class="px-6 text-right">Actions</th></tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($messages as $message)
                        <tr class="hover:bg-white/5 transition {{ $message->read_at ? '' : 'bg-violet-500/[0.06]' }}">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.contacts.show', $message) }}" class="flex items-center gap-3">
                                    <span class="w-9 h-9 rounded-lg ai-gradient-bg grid place-items-center text-xs font-bold text-white shrink-0">{{ strtoupper(substr($message->full_name, 0, 1)) }}</span>
                                    <span>
                                        <span class="font-medium flex items-center gap-2">{{ $message->full_name }}
                                            @unless ($message->read_at)<span class="w-2 h-2 rounded-full bg-indigo-400"></span>@endunless
                                        </span>
                                        <span class="block text-xs text-slate-400">{{ $message->email }}{{ $message->company ? ' · '.$message->company : '' }}</span>
                                    </span>
                                </a>
                            </td>
                            <td class="px-6 text-slate-300 max-w-sm truncate">{{ \Illuminate\Support\Str::limit($message->message, 80) }}</td>
                            <td class="px-6 text-slate-300 whitespace-nowrap">{{ $message->phone ?? '—' }}</td>
                            <td class="px-6 text-slate-400 whitespace-nowrap">{{ $message->created_at->diffForHumans() }}</td>
                            <td class="px-6 text-right whitespace-nowrap">
                                <a href="{{ route('admin.contacts.show', $message) }}" class="text-violet-300 hover:underline">View</a>
                                <form method="POST" action="{{ route('admin.contacts.destroy', $message) }}" class="inline" data-confirm="Delete this message?">
                                    @csrf @method('DELETE')
                                    <button class="ml-3 text-rose-300 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-16 text-center text-slate-400">No messages yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-5">{{ $messages->links() }}</div>
</x-app-layout>
