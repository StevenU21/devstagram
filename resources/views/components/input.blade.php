@props(['variant' => 'default'])
@php
    $classes = [
        'default' => 'w-full rounded-lg p-2 text-sm bg-gray-100 border border-transparent appearance-none rounded-tg placeholder-gray-400 outline-none focus:ring-transparent',
        'dark' => 'flex items-center py-2 px-4 rounded-lg text-sm bg-blue-600 text-white shadow-lg justify-center',
        'check' => '',
        'outline' => '',
        'icon' => ''
    ];
@endphp
<input {!! $attributes->merge(['class' => $classes[$variant]]) !!}>{{ $slot }}/>
