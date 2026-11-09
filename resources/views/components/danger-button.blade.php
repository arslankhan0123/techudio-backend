<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 rounded-xl bg-gradient-to-r from-rose-600 to-red-600 text-sm font-medium text-white shadow-lg shadow-rose-900/40 hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-rose-500/50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
