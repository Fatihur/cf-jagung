@extends('layouts.app')

@section('title', 'Riwayat Diagnosis - Sistem Pakar Jagung')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    Riwayat Diagnosis
                </h1>
                <p class="text-gray-600">
                    Lihat semua diagnosis yang pernah Anda lakukan
                </p>
            </div>

            @if($diagnoses->count() > 0)
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('diagnosis.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200 shadow-lg hover:shadow-xl">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Diagnosis Baru
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if($diagnoses->count() > 0)
        <!-- Filter Section -->
        <x-card class="mb-6">
            <form method="GET" action="{{ route('user.history') }}" class="space-y-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Filter Riwayat</h3>
                    @if(request()->hasAny(['date_from', 'date_to', 'disease']))
                        <a href="{{ route('user.history') }}"
                           class="text-sm text-gray-500 hover:text-gray-700 underline">
                            Reset Filter
                        </a>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">
                            Dari Tanggal
                        </label>
                        <input type="date"
                               id="date_from"
                               name="date_from"
                               value="{{ request('date_from') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div>
                        <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">
                            Sampai Tanggal
                        </label>
                        <input type="date"
                               id="date_to"
                               name="date_to"
                               value="{{ request('date_to') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div>
                        <label for="disease" class="block text-sm font-medium text-gray-700 mb-1">
                            Cari Penyakit
                        </label>
                        <input type="text"
                               id="disease"
                               name="disease"
                               value="{{ request('disease') }}"
                               placeholder="Nama penyakit..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Filter
                    </button>
                </div>
            </form>
        </x-card>

        <!-- Statistics Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <x-card class="text-center">
                <div class="bg-blue-100 p-3 rounded-lg inline-block mb-3">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Total Diagnosis</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $diagnoses->total() }}</p>
            </x-card>

            <x-card class="text-center">
                <div class="bg-green-100 p-3 rounded-lg inline-block mb-3">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Bulan Ini</h3>
                @php
                    $thisMonth = \App\Models\Diagnosis::where('user_id', auth()->id())
                        ->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->count();
                @endphp
                <p class="text-3xl font-bold text-green-600">{{ $thisMonth }}</p>
            </x-card>

            <x-card class="text-center">
                <div class="bg-purple-100 p-3 rounded-lg inline-block mb-3">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Diagnosis Terakhir</h3>
                <p class="text-sm text-purple-600 font-medium">
                    {{ $diagnoses->first() ? $diagnoses->first()->created_at->diffForHumans() : 'Belum ada' }}
                </p>
            </x-card>
        </div>

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
                                    @php
                                        $symptoms = $diagnosis->selected_symptoms;
                                        $count = 0;

                                        if (is_array($symptoms)) {
                                            $count = count($symptoms);
                                        } elseif (is_string($symptoms)) {
                                            $decoded = json_decode($symptoms, true);
                                            $count = is_array($decoded) ? count($decoded) : 0;
                                        }
                                    @endphp
                                    <p class="text-sm text-gray-600">
                                        {{ $count }} gejala
                                    </p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Hasil Teratas:</h4>
                                    @php
                                        $results = $diagnosis->results;
                                        $topResult = null;

                                        // Handle both array and JSON string format
                                        if (is_array($results) && !empty($results)) {
                                            $topResult = $results[0] ?? null;
                                        } elseif (is_string($results)) {
                                            $decoded = json_decode($results, true);
                                            if (is_array($decoded) && !empty($decoded)) {
                                                $topResult = $decoded[0] ?? null;
                                            }
                                        }
                                    @endphp

                                    @if($topResult && isset($topResult['disease']))
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
                                    @else
                                        <span class="text-sm text-gray-500">Tidak ada hasil</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mt-4 lg:mt-0 flex-wrap">
                            <a href="{{ route('user.diagnosis.show', $diagnosis->id) }}"
                               class="inline-flex items-center px-3 py-2 border border-green-300 text-sm leading-4 font-medium rounded-lg text-green-700 bg-green-50 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-150 ease-in-out shadow-sm hover:shadow-md">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat Detail
                            </a>

                            <a href="{{ route('diagnosis.export.pdf', $diagnosis->id) }}"
                               class="inline-flex items-center px-3 py-2 border border-red-300 text-sm leading-4 font-medium rounded-lg text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150 ease-in-out shadow-sm hover:shadow-md">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Download PDF
                            </a>

                            <form action="{{ route('user.diagnosis.destroy', $diagnosis->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat diagnosis ini?')"
                                        class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-lg text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-150 ease-in-out shadow-sm hover:shadow-md">
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
