@extends('layouts.app')

@section('title', 'Detail Diagnosis #' . $diagnosis->id . ' - Sistem Pakar Jagung')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('user.history') }}" 
               class="inline-flex items-center text-green-600 hover:text-green-800 transition duration-200">
                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Riwayat
            </a>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            Detail Diagnosis #{{ $diagnosis->id }}
        </h1>
        <p class="text-gray-600">
            Diagnosis dilakukan pada {{ $diagnosis->created_at->format('d M Y, H:i') }}
        </p>
    </div>

    <!-- Diagnosis Info -->
    <x-card class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="bg-blue-100 p-3 rounded-lg inline-block mb-2">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">ID Diagnosis</h3>
                <p class="text-2xl font-bold text-blue-600">#{{ $diagnosis->id }}</p>
            </div>
            
            <div class="text-center">
                <div class="bg-green-100 p-3 rounded-lg inline-block mb-2">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Gejala Terpilih</h3>
                <p class="text-2xl font-bold text-green-600">{{ count($diagnosis->selected_symptoms) }}</p>
            </div>
            
            <div class="text-center">
                <div class="bg-purple-100 p-3 rounded-lg inline-block mb-2">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Hasil Diagnosis</h3>
                <p class="text-2xl font-bold text-purple-600">{{ count($diagnosis->results) }}</p>
            </div>
        </div>
    </x-card>

    <!-- Results -->
    @if(!empty($diagnosis->results))
        <x-card title="Hasil Diagnosis" class="mb-8">
            <div class="space-y-4">
                @foreach($diagnosis->results as $index => $result)
                    <div class="border-l-4 {{ $index === 0 ? 'border-green-500 bg-green-50' : 'border-gray-300 bg-gray-50' }} p-4 rounded-r-lg">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $index === 0 ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }} text-sm font-bold">
                                    {{ $index + 1 }}
                                </span>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $result['disease']['code'] ?? 'N/A' }}
                                        </span>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $result['disease']['name'] ?? 'Tidak diketahui' }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <div class="text-2xl font-bold {{ $index === 0 ? 'text-green-600' : 'text-gray-600' }}">
                                    {{ $result['percentage'] ?? 0 }}%
                                </div>
                                <div class="text-sm {{ $index === 0 ? 'text-green-500' : 'text-gray-500' }}">
                                    {{ $result['confidence_level'] ?? 'Tidak diketahui' }}
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-4">
                            {{ Str::limit($result['disease']['description'] ?? 'Tidak ada deskripsi', 150) }}
                        </p>
                        
                        <a href="{{ route('disease.show', $result['disease']['id']) }}" 
                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md {{ $index === 0 ? 'text-green-700 bg-green-100 hover:bg-green-200' : 'text-gray-700 bg-gray-100 hover:bg-gray-200' }} transition duration-150 ease-in-out">
                            Lihat Detail Penyakit
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </x-card>
    @endif

    <!-- Selected Symptoms -->
    <x-card title="Gejala yang Dipilih" class="mb-8">
        <div class="flex flex-wrap gap-2">
            @php
                $selectedSymptoms = \App\Models\Symptom::whereIn('id', $diagnosis->selected_symptoms)->get();
            @endphp
            @foreach($selectedSymptoms as $symptom)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    {{ $symptom->code }} - {{ $symptom->name }}
                </span>
            @endforeach
        </div>
    </x-card>

    <!-- Actions -->
    <div class="flex flex-col sm:flex-row gap-4">
        <a href="{{ route('diagnosis.index') }}" 
           class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition duration-200">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Diagnosis Baru
        </a>
        
        <form action="{{ route('user.diagnosis.destroy', $diagnosis->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat diagnosis ini?')"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 transition duration-200">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus Diagnosis
            </button>
        </form>
    </div>
</div>
@endsection
