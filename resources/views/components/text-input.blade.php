@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'mt-1 p-2 w-full border rounded-md dark:bg-gray-300 dark:border-gray-700 ml-12']) !!}>
