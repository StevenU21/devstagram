@props(['variant' => 'default'])
@php
    $classes = [
        'default' => 'w-full text-sm text-neutral-600',
        'icon' => 'w-full rounded-lg flex items-center justify-between bg-neutral-100',
    ];
@endphp
<label {!! $attributes->merge(['class' => $classes[$variant]]) !!}>{{ $slot }}</label>
