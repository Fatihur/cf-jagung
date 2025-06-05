@extends('layouts.app')

@section('title', 'Diagnosis Penyakit Jagung')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-6">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
        </div>
        <h1 class="text-4xl font-bold text-gray-900 mb-4">
            Diagnosis Penyakit Jagung
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Sistem pakar untuk mendiagnosis penyakit jagung menggunakan metode Certainty Factor.
            Pilih gejala yang dialami tanaman untuk mendapatkan diagnosis yang akurat.
        </p>
    </div>

    @if ($errors->any())
        <x-alert type="error" title="Terdapat kesalahan:" class="mb-8">
            <ul class="list-disc list-inside space-y-1 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    <!-- Main Form Card -->
    <x-card title="Pilih Gejala yang Dialami" subtitle="Centang semua gejala yang sesuai dengan kondisi tanaman jagung Anda" class="mb-8">
        <form action="{{ route('diagnosis.diagnose') }}" method="POST" id="diagnosis-form">
            @csrf

            <div class="mb-8">
                <div class="space-y-4">
                    @foreach($symptoms as $symptom)
                        <div class="symptom-item border-2 border-gray-200 rounded-xl transition-all duration-200" data-symptom-id="{{ $symptom->id }}">
                            <div class="p-4">
                                <label class="flex items-start cursor-pointer">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="{{ $symptom->id }}"
                                           class="symptom-checkbox mt-1 h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded transition-colors duration-200"
                                           data-symptom-id="{{ $symptom->id }}"
                                           {{ in_array($symptom->id, old('symptoms', [])) ? 'checked' : '' }}>
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                {{ $symptom->code }}
                                            </span>
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $symptom->name }}
                                            </div>
                                        </div>
                                        @if($symptom->description)
                                            <div class="text-xs text-gray-600 leading-relaxed">
                                                {{ $symptom->description }}
                                            </div>
                                        @endif
                                    </div>
                                </label>

                                <!-- Confidence Level Selection -->
                                <div class="confidence-level-section hidden mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200" id="confidence_{{ $symptom->id }}">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Seberapa yakin Anda dengan gejala ini?
                                    </label>
                                    <div class="space-y-3">
                                        <div class="flex items-center">
                                            <input type="radio"
                                                   id="confidence_{{ $symptom->id }}_tidak_yakin"
                                                   name="confidence_levels[{{ $symptom->id }}]"
                                                   value="tidak_yakin"
                                                   class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                            <label for="confidence_{{ $symptom->id }}_tidak_yakin" class="ml-3 text-sm font-medium text-gray-900 cursor-pointer">
                                                Tidak Yakin <span class="text-red-600">(20%)</span>
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input type="radio"
                                                   id="confidence_{{ $symptom->id }}_kurang_yakin"
                                                   name="confidence_levels[{{ $symptom->id }}]"
                                                   value="kurang_yakin"
                                                   class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300">
                                            <label for="confidence_{{ $symptom->id }}_kurang_yakin" class="ml-3 text-sm font-medium text-gray-900 cursor-pointer">
                                                Kurang Yakin <span class="text-orange-600">(40%)</span>
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input type="radio"
                                                   id="confidence_{{ $symptom->id }}_cukup_yakin"
                                                   name="confidence_levels[{{ $symptom->id }}]"
                                                   value="cukup_yakin"
                                                   class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300">
                                            <label for="confidence_{{ $symptom->id }}_cukup_yakin" class="ml-3 text-sm font-medium text-gray-900 cursor-pointer">
                                                Cukup Yakin <span class="text-yellow-600">(60%)</span>
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input type="radio"
                                                   id="confidence_{{ $symptom->id }}_yakin"
                                                   name="confidence_levels[{{ $symptom->id }}]"
                                                   value="yakin"
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                                   checked>
                                            <label for="confidence_{{ $symptom->id }}_yakin" class="ml-3 text-sm font-medium text-gray-900 cursor-pointer">
                                                Yakin <span class="text-blue-600">(80%)</span>
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input type="radio"
                                                   id="confidence_{{ $symptom->id }}_sangat_yakin"
                                                   name="confidence_levels[{{ $symptom->id }}]"
                                                   value="sangat_yakin"
                                                   class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                            <label for="confidence_{{ $symptom->id }}_sangat_yakin" class="ml-3 text-sm font-medium text-gray-900 cursor-pointer">
                                                Sangat Yakin <span class="text-green-600">(100%)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Selected Count Display -->
            <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-blue-800">
                            Gejala terpilih: <span id="selected-count">0</span>
                        </span>
                    </div>
                    <button type="button" id="clear-all" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                        Hapus Semua
                    </button>
                </div>
            </div>

            <div class="text-center">
                <x-button type="submit" variant="primary" size="lg" class="min-w-48" id="submit-btn">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Mulai Diagnosis
                </x-button>
                <p class="text-sm text-gray-600 mt-2">
                    Pilih minimal satu gejala untuk memulai diagnosis
                </p>
            </div>
        </form>
    </x-card>

    <!-- Information Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <x-card title="Petunjuk Penggunaan" class="bg-gradient-to-br from-blue-50 to-indigo-50 border-blue-200">
            <ul class="space-y-3 text-sm text-gray-700">
                <li class="flex items-start">
                    <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Pilih minimal satu gejala yang dialami tanaman jagung
                </li>
                <li class="flex items-start">
                    <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Semakin banyak gejala yang sesuai, semakin akurat hasil diagnosis
                </li>
                <li class="flex items-start">
                    <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    Sistem menggunakan metode Certainty Factor untuk menghitung tingkat keyakinan
                </li>
            </ul>
        </x-card>

        <x-card title="Tentang Metode CF" class="bg-gradient-to-br from-green-50 to-emerald-50 border-green-200">
            <div class="text-sm text-gray-700 space-y-3">
                <p>
                    <strong>Certainty Factor (CF)</strong> adalah metode untuk menangani ketidakpastian dalam sistem pakar.
                </p>
                <p>
                    Nilai CF berkisar antara <span class="font-semibold text-green-600">0-100%</span>, dimana:
                </p>
                <ul class="space-y-1 ml-4">
                    <li>• <span class="font-medium">80-100%:</span> Sangat Yakin</li>
                    <li>• <span class="font-medium">60-79%:</span> Yakin</li>
                    <li>• <span class="font-medium">40-59%:</span> Cukup Yakin</li>
                    <li>• <span class="font-medium">20-39%:</span> Kurang Yakin</li>
                </ul>
            </div>
        </x-card>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectedCount = document.getElementById('selected-count');
    const submitBtn = document.getElementById('submit-btn');
    const clearAllBtn = document.getElementById('clear-all');

    function updateSelectedCount() {
        const checked = document.querySelectorAll('input[name="symptoms[]"]:checked');
        console.log('Update count called, checked:', checked.length);

        if (selectedCount) {
            selectedCount.textContent = checked.length;
        }

        if (submitBtn) {
            if (checked.length > 0) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }
    }

    function toggleConfidenceLevel(symptomId) {
        const checkbox = document.querySelector(`input[name="symptoms[]"][value="${symptomId}"]`);
        const confidenceSection = document.getElementById(`confidence_${symptomId}`);
        const symptomItem = document.querySelector(`[data-symptom-id="${symptomId}"]`);

        console.log('Toggle called for:', symptomId, 'checked:', checkbox?.checked);

        if (checkbox && checkbox.checked) {
            if (confidenceSection) confidenceSection.classList.remove('hidden');
            if (symptomItem) {
                symptomItem.classList.add('border-green-300', 'bg-green-50');
                symptomItem.classList.remove('border-gray-200');
            }
        } else {
            if (confidenceSection) confidenceSection.classList.add('hidden');
            if (symptomItem) {
                symptomItem.classList.remove('border-green-300', 'bg-green-50');
                symptomItem.classList.add('border-gray-200');
            }

            // Reset confidence level to default
            const defaultRadio = confidenceSection?.querySelector('input[value="yakin"]');
            if (defaultRadio) {
                defaultRadio.checked = true;
            }
        }
    }

    // Add event listeners to checkboxes
    const checkboxes = document.querySelectorAll('input[name="symptoms[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            console.log('Checkbox change event:', this.value, this.checked);
            toggleConfidenceLevel(this.value);
            updateSelectedCount();
        });
    });

    // Clear all button
    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
                toggleConfidenceLevel(checkbox.value);
            });
            updateSelectedCount();
        });
    }

    // Initialize
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            toggleConfidenceLevel(checkbox.value);
        }
    });

    updateSelectedCount();
});
</script>
@endpush

@endsection
