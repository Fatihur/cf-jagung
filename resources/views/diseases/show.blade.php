@extends('layouts.app')

@section('title', $disease->name . ' - Detail Penyakit')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('diagnosis.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Diagnosis
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $disease->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Disease Info -->
        <div class="lg:col-span-2">
            <x-card class="mb-6">
                @if($disease->image_path)
                    <div class="h-64 bg-gradient-to-r from-green-100 to-blue-100 rounded-lg mb-6 overflow-hidden">
                        <img src="{{ Storage::url($disease->image_path) }}"
                             alt="{{ $disease->name }}"
                             class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="h-64 bg-gradient-to-r from-green-100 to-blue-100 rounded-lg mb-6 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="mx-auto h-16 w-16 text-green-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <p class="text-green-600 font-medium">{{ $disease->name }}</p>
                        </div>
                    </div>
                @endif

                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4 flex items-center">
                        <span class="bg-red-100 text-red-600 p-2 rounded-lg mr-3">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </span>
                        {{ $disease->name }}
                    </h1>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        {{ $disease->description }}
                    </p>
                </div>
            </x-card>

            <!-- Disease Details Grid -->
            <div class="grid grid-cols-1 gap-6">
                @if($disease->causes)
                    <x-card title="Penyebab Penyakit" class="border-l-4 border-red-500">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-red-100 p-2 rounded-lg">
                                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="text-gray-700 whitespace-pre-line leading-relaxed">
                                    {{ $disease->causes }}
                                </div>
                            </div>
                        </div>
                    </x-card>
                @endif

                @if($disease->symptoms_description)
                    <x-card title="Deskripsi Gejala" class="border-l-4 border-yellow-500">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-yellow-100 p-2 rounded-lg">
                                    <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="text-gray-700 whitespace-pre-line leading-relaxed">
                                    {{ $disease->symptoms_description }}
                                </div>
                            </div>
                        </div>
                    </x-card>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            @if($disease->control_methods)
                <x-card title="Metode Pengendalian" class="mb-6 border-l-4 border-green-500">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="bg-green-100 p-2 rounded-lg">
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="text-gray-700 whitespace-pre-line leading-relaxed text-sm">
                                {{ $disease->control_methods }}
                            </div>
                        </div>
                    </div>
                </x-card>
            @endif

            <!-- Related Symptoms -->
            @if($disease->symptoms->count() > 0)
                <x-card title="Gejala Terkait & Nilai CF" class="border-l-4 border-blue-500">
                    <div class="space-y-3">
                        @foreach($disease->symptoms as $symptom)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200 hover:bg-blue-50 transition-colors duration-200">
                                <div class="flex items-center flex-1">
                                    <div class="bg-blue-100 p-1 rounded mr-3">
                                        <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-800 text-sm font-medium">{{ $symptom->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">
                                        CF: {{ number_format($symptom->pivot->cf_value, 2) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-card>
            @endif

            <!-- Action Buttons -->
            <div class="mt-6 space-y-3">
                <x-button href="{{ route('diagnosis.index') }}" variant="secondary" class="w-full justify-center">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Diagnosis
                </x-button>

                <div class="text-center">
                    <p class="text-xs text-gray-500">
                        Terakhir diperbarui: {{ $disease->updated_at->format('d M Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
