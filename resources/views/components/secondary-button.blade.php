<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-sm font-medium text-slate-200 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-violet-500/50 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
