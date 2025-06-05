@props(['type' => 'info', 'title' => null, 'dismissible' => false])

@php
$alertClasses = [
    'info' => 'bg-blue-50 border-blue-200',
    'success' => 'bg-green-50 border-green-200',
    'warning' => 'bg-yellow-50 border-yellow-200',
    'error' => 'bg-red-50 border-red-200',
];

$textClasses = [
    'info' => 'text-blue-800',
    'success' => 'text-green-800',
    'warning' => 'text-yellow-800',
    'error' => 'text-red-800',
];

$iconClasses = [
    'info' => 'text-blue-500',
    'success' => 'text-green-500',
    'warning' => 'text-yellow-500',
    'error' => 'text-red-500',
];

$icons = [
    'info' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
    'success' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
    'warning' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z',
    'error' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
];
@endphp

<div class="border rounded-lg p-4 mb-6 shadow-sm {{ $alertClasses[$type] }}"
     @if($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif>
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 {{ $iconClasses[$type] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons[$type] }}" />
            </svg>
        </div>
        <div class="ml-3 flex-1">
            @if($title)
                <h3 class="text-sm font-semibold {{ $textClasses[$type] }} mb-1">
                    {{ $title }}
                </h3>
            @endif
            <div class="text-sm {{ $textClasses[$type] }}">
                {{ $slot }}
            </div>
        </div>
        @if($dismissible)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button @click="show = false"
                            class="inline-flex rounded-md p-1.5 {{ $textClasses[$type] }} hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-{{ $type }}-50 focus:ring-{{ $type }}-600">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
