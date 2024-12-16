@props([
    'name',
    'label',
    'rows' => 4,
    'placeholder' => '',
    'required' => false
])

@php
    $defaultClasses = 'w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300';
    $defaults = [
        'id' => $name,
        'name' => $name,
        'rows' => $rows,
        'placeholder' => $placeholder,
        'class' => $defaultClasses
    ];

    if ($required) {
        $defaults['required'] = true;
    }
@endphp

<div class="space-y-2">
    <x-form.label :for="$name">{{ $label }}</x-form.label>
    <textarea {{ $attributes->merge($defaults) }}>{{ old($name) }}</textarea>
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
