@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

$variants = [
    'primary' => 'bg-green-600 hover:bg-green-700 text-white focus:ring-green-500',
    'secondary' => 'bg-gray-600 hover:bg-gray-700 text-white focus:ring-gray-500',
    'success' => 'bg-green-500 hover:bg-green-600 text-white focus:ring-green-400',
    'danger' => 'bg-red-600 hover:bg-red-700 text-white focus:ring-red-500',
    'outline' => 'border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 focus:ring-gray-500',
];

$sizes = [
    'sm' => 'px-3 py-2 text-sm',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-6 py-3 text-base',
    'xl' => 'px-8 py-4 text-lg',
];

$classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
