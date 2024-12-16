@props(['for'])

<label {{ $attributes->merge(['class' => 'text-sm font-medium text-gray-800']) }} for="{{ $for }}">
    {{ $slot }}
</label>
