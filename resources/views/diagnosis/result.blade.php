@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                Hasil Diagnosis Penyakit Jagung
            </h1>
            <p class="text-lg text-gray-600">
                Berdasarkan gejala yang Anda pilih, berikut adalah hasil diagnosis menggunakan metode Certainty Factor
            </p>
        </div>

        @if(empty($results))
            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">
                            Tidak Ada Hasil Diagnosis
                        </h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>Berdasarkan gejala yang dipilih, sistem tidak dapat menentukan penyakit yang sesuai. Silakan coba lagi dengan memilih gejala yang berbeda atau konsultasikan dengan ahli pertanian.</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                @foreach($results as $index => $result)
                    <div class="bg-gradient-to-br {{ $index === 0 ? 'from-green-50 to-green-100 border-green-300' : 'from-gray-50 to-gray-100 border-gray-300' }} border-2 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                @if($index === 0)
                                    <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                        #1 TERATAS
                                    </span>
                                @else
                                    <span class="bg-gray-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                        #{{ $index + 1 }}
                                    </span>
                                @endif
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold {{ $index === 0 ? 'text-green-600' : 'text-gray-600' }}">
                                    {{ $result['percentage'] }}%
                                </div>
                                <div class="text-sm {{ $index === 0 ? 'text-green-500' : 'text-gray-500' }}">
                                    {{ $result['confidence_level'] }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2 mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $result['disease']['code'] }}
                            </span>
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $result['disease']['name'] }}
                            </h3>
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-4">
                            {{ Str::limit($result['disease']['description'], 100) }}
                        </p>
                        
                        <a href="{{ route('disease.show', $result['disease']['id']) }}" 
                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md {{ $index === 0 ? 'text-green-700 bg-green-100 hover:bg-green-200' : 'text-gray-700 bg-gray-100 hover:bg-gray-200' }} transition duration-150 ease-in-out">
                            Lihat Detail
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="border-t pt-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">
                        Gejala yang Dipilih:
                    </h3>
                    <div class="space-y-2">
                        @php
                            $selectedSymptoms = \App\Models\Symptom::whereIn('id', $selectedSymptomIds)->get();
                        @endphp
                        @foreach($selectedSymptoms as $symptom)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        {{ $symptom->code }}
                                    </span>
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ $symptom->name }}
                                    </span>
                                </div>
                                @if(isset($userConfidenceLevels[$symptom->id]))
                                    @php
                                        $confidenceLevel = \App\Enums\ConfidenceLevel::from($userConfidenceLevels[$symptom->id]);
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-{{ $confidenceLevel->color() }}-100 text-{{ $confidenceLevel->color() }}-800">
                                        {{ $confidenceLevel->label() }} ({{ $confidenceLevel->cfValue() * 100 }}%)
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">
                        Informasi Diagnosis:
                    </h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Gejala terpilih: {{ count($selectedSymptomIds) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span>Hasil diagnosis: {{ count($results) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                            <span>Metode: Certainty Factor (CF)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-gray-50 rounded-lg p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    Langkah Selanjutnya
                </h3>

                @if(!empty($results))
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-6 max-w-md mx-auto">
                        <!-- Download PDF Button -->
                        <a href="{{ route('diagnosis.export.session.pdf') }}"
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download PDF
                        </a>

                        <!-- Diagnosis Ulang Button -->
                        <a href="{{ route('diagnosis.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Diagnosis Ulang
                        </a>
                    </div>

                    <!-- Helper Text -->
                    <div class="text-sm text-gray-600 space-y-2">
                        <p class="flex items-center justify-center">
                            <svg class="h-4 w-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <strong>Download PDF</strong> untuk menyimpan hasil diagnosis sebagai dokumentasi
                        </p>
                        <p class="flex items-center justify-center">
                            <svg class="h-4 w-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <strong>Diagnosis Ulang</strong> untuk melakukan diagnosis dengan gejala yang berbeda
                        </p>
                    </div>
                @else
                    <!-- Only Diagnosis Ulang for empty results -->
                    <div class="mb-4">
                        <a href="{{ route('diagnosis.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Coba Diagnosis Lagi
                        </a>
                    </div>
                    <p class="text-sm text-gray-600">
                        Silakan coba lagi dengan memilih gejala yang berbeda atau lebih spesifik
                    </p>
                @endif

                <!-- User Authentication Section -->
                @guest
                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-blue-900">
                                    Ingin menyimpan riwayat diagnosis?
                                </h4>
                                <p class="text-sm text-blue-700 mt-1">
                                    Daftar atau masuk untuk menyimpan dan mengakses riwayat diagnosis Anda kapan saja.
                                </p>
                            </div>
                            <div class="ml-4 flex gap-2">
                                <a href="{{ route('login') }}"
                                   class="inline-flex items-center px-3 py-2 border border-blue-300 text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 transition duration-150">
                                    Masuk
                                </a>
                                <a href="{{ route('register') }}"
                                   class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150">
                                    Daftar
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-green-900">
                                    Diagnosis tersimpan!
                                </h4>
                                <p class="text-sm text-green-700 mt-1">
                                    Hasil diagnosis ini telah disimpan dalam riwayat Anda. Anda dapat mengaksesnya kapan saja.
                                </p>
                            </div>
                            <div class="ml-4">
                                <a href="{{ route('user.history') }}"
                                   class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition duration-150">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Lihat Riwayat
                                </a>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>

        @if(!empty($results))
            <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-900 mb-2">
                    Tentang Metode Certainty Factor:
                </h3>
                <p class="text-sm text-blue-800">
                    Sistem ini menggunakan metode Certainty Factor (CF) untuk menghitung tingkat keyakinan diagnosis. 
                    Nilai CF berkisar antara 0-100%, dimana semakin tinggi persentase menunjukkan semakin tinggi tingkat keyakinan 
                    terhadap diagnosis penyakit tersebut berdasarkan gejala yang dipilih.
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
