@props(['method' => 'POST'])

<form {{ $attributes->merge([
    'class' => 'space-y-8 flex flex-col mx-auto w-full  px-4',
    'method' => $method === 'GET' ? 'GET' : 'POST',
    'enctype' => $attributes->has('enctype') ? $attributes->get('enctype') : 'application/x-www-form-urlencoded'
]) }}>
    @if ($method !== 'GET')
        @csrf
        @method($method)
    @endif
    {{ $slot }}
</form>
