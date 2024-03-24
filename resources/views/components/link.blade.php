@props(['variant' => 'default'])

@php
    $classes = App\Utils\ButtonsClasses::getClasses($variant);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
