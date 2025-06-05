@extends('layouts.app')

@section('title', 'Riwayat Diagnosis - Sistem Pakar Jagung')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            Riwayat Diagnosis
        </h1>
        <p class="text-gray-600">
            Lihat semua diagnosis yang pernah Anda lakukan
        </p>
    </div>

    @if($diagnoses->count() > 0)
        <!-- Diagnosis History Cards -->
        <div class="space-y-6">
            @foreach($diagnoses as $diagnosis)
                <x-card class="hover:shadow-lg transition-shadow duration-200">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-green-100 p-2 rounded-lg">
                                    <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Diagnosis #{{ $diagnosis->id }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $diagnosis->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Gejala Terpilih:</h4>
                                    <p class="text-sm text-gray-600">
                                        {{ count($diagnosis->selected_symptoms) }} gejala
                                    </p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Hasil Teratas:</h4>
                                    @if(!empty($diagnosis->results))
                                        @php $topResult = $diagnosis->results[0] ?? null; @endphp
                                        @if($topResult)
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $topResult['disease']['code'] ?? 'N/A' }}
                                                </span>
                                                <span class="text-sm text-gray-900">
                                                    {{ $topResult['disease']['name'] ?? 'Tidak diketahui' }}
                                                </span>
                                                <span class="text-sm font-medium text-green-600">
                                                    ({{ $topResult['percentage'] ?? 0 }}%)
                                                </span>
                                            </div>
                                        @endif
                                    @else
                                        <span class="text-sm text-gray-500">Tidak ada hasil</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 mt-4 lg:mt-0">
                            <a href="{{ route('user.diagnosis.show', $diagnosis->id) }}" 
                               class="inline-flex items-center px-3 py-2 border border-green-300 text-sm leading-4 font-medium rounded-md text-green-700 bg-green-50 hover:bg-green-100 transition duration-150 ease-in-out">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat Detail
                            </a>
                            
                            <form action="{{ route('user.diagnosis.destroy', $diagnosis->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat diagnosis ini?')"
                                        class="inline-flex items-center px-3 py-2 border border-red-300 text-sm leading-4 font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 transition duration-150 ease-in-out">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $diagnoses->links() }}
        </div>
    @else
        <!-- Empty State -->
        <x-card class="text-center py-12">
            <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">
                Belum Ada Riwayat Diagnosis
            </h3>
            <p class="text-gray-600 mb-6">
                Anda belum pernah melakukan diagnosis. Mulai diagnosis pertama Anda sekarang!
            </p>
            <a href="{{ route('diagnosis.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition duration-200">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Mulai Diagnosis
            </a>
        </x-card>
    @endif
</div>
@endsection
