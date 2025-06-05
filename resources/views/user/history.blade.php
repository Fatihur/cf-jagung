@extends('layouts.app')

@section('title', 'Riwayat Diagnosis - Sistem Pakar Jagung')

@push('styles')
<style>
    /* Reset and Base Styles */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.6;
        color: #1f2937;
        background-color: #f9fafb;
    }

    /* Container Styles */
    .main-container {
        max-width: 1200px !important;
        margin: 0 auto !important;
        padding: 1rem !important;
        background: #f9fafb !important;
        min-height: 100vh !important;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #ecfdf5 0%, #dbeafe 50%, #faf5ff 100%) !important;
        border-radius: 1.5rem !important;
        padding: 3rem 2rem !important;
        margin-bottom: 2rem !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .hero-content {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 2rem !important;
    }

    .hero-text h1 {
        font-size: 2.5rem !important;
        font-weight: 700 !important;
        color: #1f2937 !important;
        margin: 0 0 0.5rem 0 !important;
    }

    .hero-text p {
        font-size: 1.125rem !important;
        color: #6b7280 !important;
        margin: 0 !important;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) !important;
        gap: 1rem !important;
        margin-top: 1.5rem !important;
    }

    .stat-item {
        display: flex !important;
        align-items: center !important;
        gap: 0.75rem !important;
        padding: 1rem !important;
        background: rgba(255, 255, 255, 0.7) !important;
        border-radius: 0.75rem !important;
        backdrop-filter: blur(10px) !important;
    }

    .stat-icon {
        width: 2.5rem !important;
        height: 2.5rem !important;
        border-radius: 0.5rem !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: linear-gradient(135deg, #10b981, #059669) !important;
        color: white !important;
    }

    .stat-text h3 {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        color: #1f2937 !important;
        margin: 0 !important;
    }

    .stat-text p {
        font-size: 0.875rem !important;
        color: #6b7280 !important;
        margin: 0 !important;
    }

    /* Button Styles */
    .btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 0.75rem 1.5rem !important;
        font-weight: 500 !important;
        border-radius: 0.75rem !important;
        text-decoration: none !important;
        border: none !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        font-size: 0.875rem !important;
        line-height: 1.25rem !important;
        white-space: nowrap !important;
    }

    .btn-primary {
        background: linear-gradient(to right, #059669, #047857) !important;
        color: white !important;
    }

    .btn-primary:hover {
        background: linear-gradient(to right, #047857, #065f46) !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
    }

    .btn-blue {
        background: linear-gradient(to right, #2563eb, #1d4ed8) !important;
        color: white !important;
    }

    .btn-blue:hover {
        background: linear-gradient(to right, #1d4ed8, #1e40af) !important;
        transform: translateY(-1px) !important;
    }

    .btn-red {
        background: linear-gradient(to right, #dc2626, #b91c1c) !important;
        color: white !important;
    }

    .btn-red:hover {
        background: linear-gradient(to right, #b91c1c, #991b1b) !important;
        transform: translateY(-1px) !important;
    }

    .btn-secondary {
        background: white !important;
        color: #374151 !important;
        border: 1px solid #d1d5db !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
    }

    .btn-secondary:hover {
        background: #f9fafb !important;
        border-color: #9ca3af !important;
    }

    /* Card Styles */
    .card {
        background: white !important;
        border-radius: 1rem !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        border: 1px solid #e5e7eb !important;
        overflow: hidden !important;
        margin-bottom: 1.5rem !important;
    }

    .card-header {
        padding: 1.5rem !important;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
        border-bottom: 1px solid #e5e7eb !important;
    }

    .card-body {
        padding: 1.5rem !important;
    }

    .card-footer {
        padding: 1rem 1.5rem !important;
        background: #f9fafb !important;
        border-top: 1px solid #e5e7eb !important;
    }

    /* Filter Section */
    .filter-section {
        background: white !important;
        border-radius: 1rem !important;
        padding: 1.5rem !important;
        margin-bottom: 2rem !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        border: 1px solid #e5e7eb !important;
    }

    .filter-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
        gap: 1rem !important;
        margin-bottom: 1.5rem !important;
    }

    .form-group {
        display: flex !important;
        flex-direction: column !important;
        gap: 0.5rem !important;
    }

    .form-label {
        font-weight: 500 !important;
        color: #374151 !important;
        font-size: 0.875rem !important;
    }

    .form-input {
        padding: 0.75rem !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.5rem !important;
        font-size: 0.875rem !important;
        transition: all 0.2s ease !important;
        background: white !important;
    }

    .form-input:focus {
        outline: none !important;
        border-color: #059669 !important;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1) !important;
    }

    /* Statistics Cards */
    .stats-section {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
        gap: 1.5rem !important;
        margin-bottom: 2rem !important;
    }

    .stat-card {
        background: white !important;
        border-radius: 1rem !important;
        padding: 1.5rem !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        border: 1px solid #e5e7eb !important;
        transition: all 0.3s ease !important;
    }

    .stat-card:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    /* Diagnosis Cards */
    .diagnosis-list {
        display: flex !important;
        flex-direction: column !important;
        gap: 1.5rem !important;
    }

    .diagnosis-card {
        background: white !important;
        border-radius: 1rem !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        border: 1px solid #e5e7eb !important;
        overflow: hidden !important;
        transition: all 0.3s ease !important;
    }

    .diagnosis-card:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        flex-wrap: wrap !important;
        gap: 0.75rem !important;
    }

    .button-group {
        display: flex !important;
        align-items: center !important;
        gap: 0.75rem !important;
        flex-wrap: wrap !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-content {
            flex-direction: column !important;
            text-align: center !important;
        }

        .hero-text h1 {
            font-size: 2rem !important;
        }

        .stats-grid {
            grid-template-columns: 1fr !important;
        }

        .filter-grid {
            grid-template-columns: 1fr !important;
        }

        .stats-section {
            grid-template-columns: 1fr !important;
        }

        .action-buttons {
            flex-direction: column !important;
            align-items: stretch !important;
        }

        .button-group {
            justify-content: center !important;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="hero-bg border-b border-gray-200 relative">
    <div class="container mx-auto px-4 py-12 relative z-10">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between animate-fade-in">
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-green-100 p-3 rounded-xl shadow-sm">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">
                            Riwayat Diagnosis
                        </h1>
                        <p class="text-lg text-gray-600">
                            Kelola dan pantau semua diagnosis yang pernah Anda lakukan
                        </p>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="flex flex-wrap gap-4 mt-6">
                    <div class="bg-white/70 backdrop-blur-sm rounded-lg px-4 py-2 border border-white/50 shadow-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Total: {{ $diagnoses->total() ?? 0 }}</span>
                        </div>
                    </div>
                    @php
                        $thisMonth = \App\Models\Diagnosis::where('user_id', auth()->id())
                            ->whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();
                    @endphp
                    <div class="bg-white/70 backdrop-blur-sm rounded-lg px-4 py-2 border border-white/50 shadow-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Bulan ini: {{ $thisMonth }}</span>
                        </div>
                    </div>
                    @if($diagnoses->count() > 0)
                        <div class="bg-white/70 backdrop-blur-sm rounded-lg px-4 py-2 border border-white/50 shadow-sm">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                <span class="text-sm font-medium text-gray-700">Terakhir: {{ $diagnoses->first()->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 lg:mt-0 lg:ml-8">
                <a href="{{ route('diagnosis.index') }}"
                   style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background: linear-gradient(to right, #059669, #047857); color: white; font-weight: 500; border-radius: 0.75rem; text-decoration: none; border: none; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); font-size: 1rem;"
                   onmouseover="this.style.background='linear-gradient(to right, #047857, #065f46)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)'"
                   onmouseout="this.style.background='linear-gradient(to right, #059669, #047857)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1)'">
                    <svg style="height: 1.25rem; width: 1.25rem; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Diagnosis Baru
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">

    @if($diagnoses->count() > 0)
        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Filter & Pencarian</h3>
                    </div>
                    @if(request()->hasAny(['date_from', 'date_to', 'disease']))
                        <a href="{{ route('user.history') }}"
                           style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; background: white; color: #4b5563; font-weight: 500; border-radius: 0.5rem; text-decoration: none; border: 1px solid #d1d5db; cursor: pointer; transition: all 0.2s ease; font-size: 0.875rem;"
                           onmouseover="this.style.background='#f9fafb'; this.style.borderColor='#9ca3af'"
                           onmouseout="this.style.background='white'; this.style.borderColor='#d1d5db'">
                            <svg style="height: 1rem; width: 1rem; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>
            </div>

            <form method="GET" action="{{ route('user.history') }}" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label for="date_from" class="block text-sm font-medium text-gray-700">
                            <span class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Dari Tanggal
                            </span>
                        </label>
                        <input type="date"
                               id="date_from"
                               name="date_from"
                               value="{{ request('date_from') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                    </div>

                    <div class="space-y-2">
                        <label for="date_to" class="block text-sm font-medium text-gray-700">
                            <span class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Sampai Tanggal
                            </span>
                        </label>
                        <input type="date"
                               id="date_to"
                               name="date_to"
                               value="{{ request('date_to') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                    </div>

                    <div class="space-y-2">
                        <label for="disease" class="block text-sm font-medium text-gray-700">
                            <span class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari Penyakit
                            </span>
                        </label>
                        <input type="text"
                               id="disease"
                               name="disease"
                               value="{{ request('disease') }}"
                               placeholder="Masukkan nama penyakit..."
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                            style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background: linear-gradient(to right, #059669, #047857); color: white; font-weight: 500; border-radius: 0.75rem; border: none; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); font-size: 0.875rem;"
                            onmouseover="this.style.background='linear-gradient(to right, #047857, #065f46)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)'"
                            onmouseout="this.style.background='linear-gradient(to right, #059669, #047857)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1)'">
                        <svg style="height: 1rem; width: 1rem; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Statistics Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-fade-in">
            <!-- Total Diagnosis Card -->
            <div class="stat-card bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 shadow-sm hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="bg-blue-500 p-3 rounded-xl shadow-lg mb-4">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-blue-700 mb-1">Total Diagnosis</h3>
                        <p class="text-3xl font-bold text-blue-900">{{ $diagnoses->total() }}</p>
                        <p class="text-xs text-blue-600 mt-1">Semua waktu</p>
                    </div>
                </div>
            </div>

            <!-- Monthly Diagnosis Card -->
            <div class="stat-card bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200 shadow-sm hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="bg-green-500 p-3 rounded-xl shadow-lg mb-4">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-green-700 mb-1">Bulan Ini</h3>
                        @php
                            $thisMonth = \App\Models\Diagnosis::where('user_id', auth()->id())
                                ->whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->count();
                        @endphp
                        <p class="text-3xl font-bold text-green-900">{{ $thisMonth }}</p>
                        <p class="text-xs text-green-600 mt-1">{{ now()->format('F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Last Activity Card -->
            <div class="stat-card bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200 shadow-sm hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="bg-purple-500 p-3 rounded-xl shadow-lg mb-4">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-purple-700 mb-1">Aktivitas Terakhir</h3>
                        @if($diagnoses->first())
                            <p class="text-lg font-bold text-purple-900">{{ $diagnoses->first()->created_at->diffForHumans() }}</p>
                            <p class="text-xs text-purple-600 mt-1">{{ $diagnoses->first()->created_at->format('d M Y, H:i') }}</p>
                        @else
                            <p class="text-lg font-bold text-purple-900">Belum ada</p>
                            <p class="text-xs text-purple-600 mt-1">Mulai diagnosis pertama</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Diagnosis History Cards -->
        <div class="space-y-6 animate-slide-up">
            @foreach($diagnoses as $diagnosis)
                <div class="diagnosis-card bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-gray-200 overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="bg-gradient-to-br from-green-500 to-green-600 p-3 rounded-xl shadow-lg">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">
                                        Diagnosis #{{ $diagnosis->id }}
                                    </h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-sm text-gray-600">
                                            {{ $diagnosis->created_at->format('d M Y, H:i') }}
                                        </p>
                                        <span class="text-gray-400">•</span>
                                        <p class="text-sm text-gray-500">
                                            {{ $diagnosis->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">
                                Selesai
                            </div>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6">

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Symptoms Section -->
                            <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="bg-blue-500 p-1.5 rounded-lg">
                                        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h2m0 0h2a2 2 0 002-2V7a2 2 0 00-2-2h-2m0 0V5m0 0V3a2 2 0 00-2-2H9a2 2 0 00-2 2v2m0 0v2"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-blue-900">Gejala Terpilih</h4>
                                </div>
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
                                <div class="flex items-center gap-2">
                                    <span class="text-2xl font-bold text-blue-700">{{ $count }}</span>
                                    <span class="text-sm text-blue-600">gejala dipilih</span>
                                </div>
                            </div>

                            <!-- Results Section -->
                            <div class="bg-green-50 rounded-xl p-4 border border-green-100">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="bg-green-500 p-1.5 rounded-lg">
                                        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-green-900">Hasil Diagnosis</h4>
                                </div>
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
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-white text-green-700 border border-green-200">
                                                {{ $topResult['disease']['code'] ?? 'N/A' }}
                                            </span>
                                            <span class="text-sm font-medium text-green-900">
                                                {{ $topResult['disease']['name'] ?? 'Tidak diketahui' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg font-bold text-green-700">{{ $topResult['percentage'] ?? 0 }}%</span>
                                            <span class="text-xs text-green-600">tingkat kepercayaan</span>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">Tidak ada hasil</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">

                        <div class="flex items-center justify-between flex-wrap gap-3">
                            <div class="flex items-center gap-3 flex-wrap">
                                <!-- Lihat Detail Button -->
                                <a href="{{ route('user.diagnosis.show', $diagnosis->id) }}"
                                   style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: #2563eb; color: white; font-weight: 500; border-radius: 0.75rem; text-decoration: none; border: none; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                                   onmouseover="this.style.background='#1d4ed8'; this.style.transform='translateY(-1px)'"
                                   onmouseout="this.style.background='#2563eb'; this.style.transform='translateY(0)'">
                                    <svg style="height: 1rem; width: 1rem; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail
                                </a>

                                <!-- Download PDF Button -->
                                <a href="{{ route('diagnosis.export.pdf', $diagnosis->id) }}"
                                   style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: #dc2626; color: white; font-weight: 500; border-radius: 0.75rem; text-decoration: none; border: none; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                                   onmouseover="this.style.background='#b91c1c'; this.style.transform='translateY(-1px)'"
                                   onmouseout="this.style.background='#dc2626'; this.style.transform='translateY(0)'">
                                    <svg style="height: 1rem; width: 1rem; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download PDF
                                </a>
                            </div>

                            <!-- Delete Button -->
                            <form action="{{ route('user.diagnosis.destroy', $diagnosis->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat diagnosis ini?')"
                                        style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: white; color: #374151; font-weight: 500; border-radius: 0.75rem; border: 1px solid #d1d5db; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);"
                                        onmouseover="this.style.background='#f9fafb'; this.style.borderColor='#9ca3af'"
                                        onmouseout="this.style.background='white'; this.style.borderColor='#d1d5db'">
                                    <svg style="height: 1rem; width: 1rem; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                {{ $diagnoses->links() }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <!-- Empty State Illustration -->
                <div class="mx-auto h-24 w-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6 shadow-inner">
                    <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>

                <!-- Empty State Content -->
                <h3 class="text-2xl font-bold text-gray-900 mb-3">
                    Belum Ada Riwayat Diagnosis
                </h3>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Anda belum pernah melakukan diagnosis penyakit jagung.
                    <br>Mulai diagnosis pertama Anda untuk mendapatkan hasil yang akurat!
                </p>

                <!-- Call to Action -->
                <div class="space-y-4">
                    <a href="{{ route('diagnosis.index') }}"
                       style="display: inline-flex; align-items: center; padding: 1rem 2rem; background: linear-gradient(to right, #059669, #047857); color: white; font-weight: 500; border-radius: 1rem; text-decoration: none; border: none; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); font-size: 1rem;"
                       onmouseover="this.style.background='linear-gradient(to right, #047857, #065f46)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)'"
                       onmouseout="this.style.background='linear-gradient(to right, #059669, #047857)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1)'">
                        <svg style="height: 1.25rem; width: 1.25rem; margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Mulai Diagnosis Sekarang
                    </a>

                    <div class="text-sm text-gray-500">
                        <p>Proses diagnosis hanya membutuhkan beberapa menit</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
