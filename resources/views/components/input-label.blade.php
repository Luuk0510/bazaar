@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-gray-700 dark:text-white']) }}> <!--text-sm-->
    {{ $value ?? $slot }}
</label>
