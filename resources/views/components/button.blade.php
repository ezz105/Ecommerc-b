@props([
    'type' => 'primary', // Default type if none is provided
    'href' => '#', // Default href
    'class' => '', // Custom class to override the default type styles
    'icon' => '', // Icon name (Material Icons)
])

@php
    // Default button styles for different types
    $buttonTypes = [
        'primary' => 'bg-blue-500 text-white hover:bg-blue-600',
        'secondary' => 'bg-gray-500 text-white hover:bg-gray-600',
        'danger' => 'bg-red-500 text-white hover:bg-red-600',
        'success' => 'bg-green-500 text-white hover:bg-green-600',
        'outline' => 'border border-blue-500 text-blue-500 hover:bg-blue-100'
    ];

    // Ensure $type is a valid string
    $type = is_string($type) ? $type : 'primary';

    // Get the appropriate type class or fallback to primary
    $buttonClass = $buttonTypes[$type] ?? $buttonTypes['primary'];

    // Combine with any custom class provided by user
    $finalClass = $class ? $class : $buttonClass;
@endphp

<a href="{{ $href !== '#' ? route($href) : '#' }}" class="inline-flex items-center px-4 py-2 rounded {{ $finalClass }}">
    @if ($icon)
        <span class="material-icons">{{ $icon }}</span>
    @endif
    {{ $slot }}
</a>