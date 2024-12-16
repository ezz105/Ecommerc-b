@props([
    'name',
    'label',
    'options' => [],
    'required' => false,
    'id' => null, // Accept custom ID
])

@php
    $defaultClasses = 'w-full border rounded-lg focus:outline-none focus:ring focus:ring-indigo-300';

    // Use the provided ID or default to the name attribute
    $defaults = [
        'id' => $id ?? $name, // Custom ID takes priority
        'name' => $name,
        'class' => $defaultClasses,
    ];

    if ($required) {
        $defaults['required'] = true;
    }
@endphp

<div class="space-y-2">
    <x-form.label :for="$id ?? $name">{{ $label }}</x-form.label> <!-- Use the custom ID or fallback to name -->
    <select {{ $attributes->merge($defaults) }}>
        {{ $slot }}
    </select>
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
