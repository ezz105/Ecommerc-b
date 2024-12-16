@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'required' => false
])

@php
    $defaultClasses = 'w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300';
    $defaults = [
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'placeholder' => $placeholder,
        'class' => $defaultClasses,
        'value' => old($name)
    ];

    if ($required) {
        $defaults['required'] = true;
    }
@endphp

<div class="space-y-2">
    <x-form.label :for="$name">{{ $label }}</x-form.label>
    <input {{ $attributes->merge($defaults) }}>
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
