@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-gray-90 dark:text-gray-100 font-medium ml-12']) }}>
    {{ $value ?? $slot }}
</label>
