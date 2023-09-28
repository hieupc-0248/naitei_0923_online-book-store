<button {{ $attributes->merge(['type' => 'submit', 'class' => 'rounded-lg px-6 py-2 text-right font-semibold mt-4 mb-4 uppercase']) }}>
    {{ $slot }}
</button>
