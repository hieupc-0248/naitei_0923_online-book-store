<button {{ $attributes->merge(['type' => 'submit', 'class' => 'rounded-lg px-6 py-2 text-right font-semibold dark:bg-gray-500 ml-12 mt-4 mb-4 uppercase']) }}>
    {{ $slot }}
</button>
