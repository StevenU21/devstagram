@props(['variant' => 'default'])

@php
    $classes = App\Utils\ButtonsClasses::getClasses($variant);
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
