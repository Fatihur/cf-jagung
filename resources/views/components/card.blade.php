@props([
    'title' => null,
    'subtitle' => null,
    'padding' => 'p-6',
    'shadow' => 'shadow-lg',
    'border' => true,
    'hover' => false
])

@php
$cardClasses = 'bg-white rounded-lg overflow-hidden transition-all duration-200';
$cardClasses .= ' ' . $shadow;
if ($border) $cardClasses .= ' border border-gray-200';
if ($hover) $cardClasses .= ' hover:shadow-xl hover:-translate-y-1';
@endphp

<div class="{{ $cardClasses }}">
    @if($title || $subtitle)
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            @if($title)
                <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $title }}</h2>
            @endif
            @if($subtitle)
                <p class="text-gray-600 text-sm">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <div class="{{ $padding }}">
        {{ $slot }}
    </div>
</div>
