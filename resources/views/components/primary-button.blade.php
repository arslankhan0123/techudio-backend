<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 ai-btn justify-center focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
