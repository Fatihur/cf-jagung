@extends('layouts.app')

@section('title', 'Riwayat Diagnosis - Sistem Pakar Jagung')

@push('styles')
<style>
    /* Responsive Grid System */
    .responsive-grid {
        display: grid;
        gap: 1rem;
        grid-template-columns: 1fr;
    }

    @media (min-width: 640px) {
        .responsive-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .responsive-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Card Responsive */
    .diagnosis-card {
        transition: all 0.3s ease;
    }

    .diagnosis-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Button Responsive */
    .btn-responsive {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1rem;
        font-weight: 500;
        border-radius: 0.5rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.875rem;
        min-width: 120px;
    }

    @media (max-width: 640px) {
        .btn-responsive {
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem !important;
        }

        .hero-description {
            font-size: 1rem !important;
        }

        .card-grid {
            grid-template-columns: 1fr !important;
        }

        .action-buttons {
            flex-direction: column !important;
            gap: 0.5rem !important;
        }

        .stats-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush

@section('content')
<div style="min-height: 100vh; background: #f9fafb; padding: 1rem;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Hero Section -->
        <div style="background: linear-gradient(135deg, #ecfdf5 0%, #dbeafe 50%, #faf5ff 100%); border-radius: 1.5rem; padding: 2rem 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 2rem;">
                <div style="flex: 1; min-width: 300px;">
                    <h1 class="hero-title" style="font-size: 2.5rem; font-weight: 700; color: #1f2937; margin: 0 0 1rem 0; display: flex; align-items: center; gap: 0.75rem;">
                        <i class="fas fa-history" style="color: #059669;"></i>
                        Riwayat Diagnosis
                    </h1>
                    <p class="hero-description" style="font-size: 1.125rem; color: #6b7280; margin: 0 0 2rem 0;">
                        Lihat semua diagnosis yang pernah Anda lakukan dan pantau perkembangan tanaman jagung Anda
                    </p>
                    
                    <!-- Quick Stats -->
                    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: rgba(255, 255, 255, 0.7); border-radius: 0.75rem; backdrop-filter: blur(10px);">
                            <div style="width: 2.5rem; height: 2.5rem; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white;">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div>
                                <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">{{ $totalDiagnoses ?? 0 }}</h3>
                                <p style="font-size: 0.875rem; color: #6b7280; margin: 0;">Total Diagnosis</p>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: rgba(255, 255, 255, 0.7); border-radius: 0.75rem; backdrop-filter: blur(10px);">
                            <div style="width: 2.5rem; height: 2.5rem; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #10b981, #059669); color: white;">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">{{ $monthlyDiagnoses ?? 0 }}</h3>
                                <p style="font-size: 0.875rem; color: #6b7280; margin: 0;">Bulan Ini</p>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: rgba(255, 255, 255, 0.7); border-radius: 0.75rem; backdrop-filter: blur(10px);">
                            <div style="width: 2.5rem; height: 2.5rem; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h3 style="font-size: 1rem; font-weight: 500; color: #1f2937; margin: 0;">
                                    @if(isset($lastDiagnosis) && $lastDiagnosis)
                                        {{ $lastDiagnosis->created_at->diffForHumans() }}
                                    @else
                                        Belum ada
                                    @endif
                                </h3>
                                <p style="font-size: 0.875rem; color: #6b7280; margin: 0;">Aktivitas Terakhir</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="min-width: 200px;">
                    <a href="{{ route('diagnosis.index') }}"
                       class="btn-responsive"
                       style="background: linear-gradient(to right, #059669, #047857); color: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                       onmouseover="this.style.background='linear-gradient(to right, #047857, #065f46)'; this.style.transform='translateY(-1px)'"
                       onmouseout="this.style.background='linear-gradient(to right, #059669, #047857)'; this.style.transform='translateY(0)'">
                        <i class="fas fa-plus" style="margin-right: 0.5rem;"></i>
                        Diagnosis Baru
                    </a>
                </div>
            </div>
        </div>

        @if(isset($diagnoses) && $diagnoses->count() > 0)
            <!-- Filter Section -->
            <div style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0;">
                        <i class="fas fa-filter" style="color: #059669; margin-right: 0.5rem;"></i>
                        Filter & Pencarian
                    </h3>
                    @if(request()->hasAny(['date_from', 'date_to', 'disease']))
                        <a href="{{ route('user.history') }}" 
                           style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: white; color: #4b5563; font-weight: 500; border-radius: 0.5rem; text-decoration: none; border: 1px solid #d1d5db; font-size: 0.875rem;"
                           onmouseover="this.style.background='#f9fafb'"
                           onmouseout="this.style.background='white'">
                            <i class="fas fa-times" style="margin-right: 0.5rem;"></i>
                            Reset
                        </a>
                    @endif
                </div>
                
                <form method="GET" action="{{ route('user.history') }}">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
                        <div>
                            <label style="display: block; font-weight: 500; color: #374151; font-size: 0.875rem; margin-bottom: 0.5rem;">Dari Tanggal</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" 
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                        </div>
                        
                        <div>
                            <label style="display: block; font-weight: 500; color: #374151; font-size: 0.875rem; margin-bottom: 0.5rem;">Sampai Tanggal</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" 
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                        </div>
                        
                        <div>
                            <label style="display: block; font-weight: 500; color: #374151; font-size: 0.875rem; margin-bottom: 0.5rem;">Penyakit</label>
                            <select name="disease" 
                                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                                <option value="">Semua Penyakit</option>
                                @if(isset($diseases))
                                    @foreach($diseases as $disease)
                                        <option value="{{ $disease->id }}" {{ request('disease') == $disease->id ? 'selected' : '' }}>
                                            {{ $disease->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: flex-end;">
                        <button type="submit" 
                                style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background: linear-gradient(to right, #059669, #047857); color: white; font-weight: 500; border-radius: 0.75rem; border: none; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); font-size: 0.875rem;"
                                onmouseover="this.style.background='linear-gradient(to right, #047857, #065f46)'; this.style.transform='translateY(-1px)'"
                                onmouseout="this.style.background='linear-gradient(to right, #059669, #047857)'; this.style.transform='translateY(0)'">
                            <i class="fas fa-search" style="margin-right: 0.5rem;"></i>
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Statistics Summary -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <!-- Total Diagnosis Card -->
                <div style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #93c5fd;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 2rem; font-weight: 700; color: #1e40af; margin: 0;">{{ $diagnoses->total() ?? 0 }}</h3>
                            <p style="color: #3730a3; font-weight: 500; margin: 0;">Total Diagnosis</p>
                            <p style="color: #6366f1; font-size: 0.875rem; margin: 0;">Semua waktu</p>
                        </div>
                    </div>
                </div>

                <!-- Monthly Diagnosis Card -->
                <div style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #86efac;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 2rem; font-weight: 700; color: #065f46; margin: 0;">{{ $monthlyDiagnoses ?? 0 }}</h3>
                            <p style="color: #047857; font-weight: 500; margin: 0;">Diagnosis Bulan Ini</p>
                            <p style="color: #059669; font-size: 0.875rem; margin: 0;">{{ now()->format('F Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Last Activity Card -->
                <div style="background: linear-gradient(135deg, #fae8ff, #e9d5ff); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #c4b5fd;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 600; color: #6b21a8; margin: 0;">
                                @if(isset($lastDiagnosis) && $lastDiagnosis)
                                    {{ $lastDiagnosis->created_at->format('d M Y') }}
                                @else
                                    Belum ada
                                @endif
                            </h3>
                            <p style="color: #7c2d92; font-weight: 500; margin: 0;">Aktivitas Terakhir</p>
                            <p style="color: #8b5cf6; font-size: 0.875rem; margin: 0;">
                                @if(isset($lastDiagnosis) && $lastDiagnosis)
                                    {{ $lastDiagnosis->created_at->diffForHumans() }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagnosis List -->
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                @foreach($diagnoses as $diagnosis)
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; overflow: hidden; transition: all 0.3s ease;"
                         onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 25px rgba(0, 0, 0, 0.1)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1)'">
                        
                        <!-- Card Header -->
                        <div style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
                            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                                <div>
                                    <h4 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 0.5rem 0;">
                                        Diagnosis #{{ $diagnosis->id }}
                                    </h4>
                                    <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; color: #6b7280; font-size: 0.875rem;">
                                            <i class="fas fa-calendar" style="margin-right: 0.25rem;"></i>
                                            {{ $diagnosis->created_at->format('d M Y, H:i') }}
                                        </span>
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; color: #6b7280; font-size: 0.875rem;">
                                            <i class="fas fa-clock" style="margin-right: 0.25rem;"></i>
                                            {{ $diagnosis->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                                
                                <span style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: linear-gradient(135deg, #10b981, #059669); color: white; border-radius: 9999px; font-size: 0.875rem; font-weight: 500;">
                                    <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                                    Selesai
                                </span>
                            </div>
                        </div>
                        
                        <!-- Card Body -->
                        <div style="padding: 1.5rem;">
                            <div class="card-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                                <!-- Symptoms -->
                                <div>
                                    <h5 style="font-size: 1rem; font-weight: 600; color: #374151; margin: 0 0 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="fas fa-search" style="color: #059669;"></i>
                                        Gejala Terpilih
                                    </h5>
                                    @php
                                        $symptoms = $diagnosis->getSymptoms();
                                    @endphp
                                    @if($symptoms && $symptoms->count() > 0)
                                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                            @foreach($symptoms->take(3) as $symptom)
                                                <div style="display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem; background: linear-gradient(135deg, #f0fdf4, #ecfdf5); border: 1px solid #bbf7d0; border-radius: 0.5rem; font-size: 0.875rem;">
                                                    <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.5rem; background: #059669; color: white; border-radius: 0.25rem; font-weight: 600; font-size: 0.75rem;">
                                                        {{ $symptom->code ?? 'N/A' }}
                                                    </span>
                                                    <span style="color: #374151; font-weight: 500;">{{ $symptom->name ?? 'Tidak diketahui' }}</span>
                                                </div>
                                            @endforeach
                                            @if($symptoms->count() > 3)
                                                <div style="text-align: center; padding: 0.5rem; color: #6b7280; font-size: 0.875rem; font-style: italic;">
                                                    <i class="fas fa-plus" style="margin-right: 0.25rem;"></i>
                                                    {{ $symptoms->count() - 3 }} gejala lainnya
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div style="text-align: center; padding: 2rem; color: #9ca3af; font-style: italic;">
                                            <div style="font-size: 2rem; margin-bottom: 0.5rem;">
                                                <i class="fas fa-search"></i>
                                            </div>
                                            <p style="margin: 0;">Tidak ada gejala tercatat</p>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Results -->
                                <div>
                                    <h5 style="font-size: 1rem; font-weight: 600; color: #374151; margin: 0 0 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="fas fa-bullseye" style="color: #f59e0b;"></i>
                                        Hasil Diagnosis
                                    </h5>
                                    @php
                                        $results = null;
                                        if (is_string($diagnosis->results)) {
                                            $results = json_decode($diagnosis->results, true);
                                        } elseif (is_array($diagnosis->results)) {
                                            $results = $diagnosis->results;
                                        }

                                        $topResult = null;
                                        if ($results && is_array($results)) {
                                            $topResult = collect($results)->sortByDesc('cf_value')->first();
                                        }
                                    @endphp
                                    
                                    @if($topResult && isset($topResult['disease']))
                                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                            <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: linear-gradient(135deg, #fef3c7, #fde68a); border: 1px solid #f59e0b; border-radius: 0.5rem;">
                                                <span style="display: inline-flex; align-items: center; padding: 0.5rem; background: #f59e0b; color: white; border-radius: 0.5rem; font-weight: 600; font-size: 0.875rem;">
                                                    {{ $topResult['disease']['code'] ?? 'N/A' }}
                                                </span>
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 600; color: #92400e; font-size: 1rem;">
                                                        {{ $topResult['disease']['name'] ?? 'Tidak diketahui' }}
                                                    </div>
                                                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.25rem;">
                                                        <span style="color: #78716c; font-size: 0.875rem;">Tingkat Kepercayaan:</span>
                                                        <span style="font-weight: 700; color: #dc2626; font-size: 1rem;">
                                                            {{ number_format(($topResult['cf_value'] ?? 0) * 100, 1) }}%
                                                        </span>
                                                        @php
                                                            $percentage = ($topResult['cf_value'] ?? 0) * 100;
                                                            $confidenceColor = $percentage >= 70 ? '#059669' : ($percentage >= 50 ? '#f59e0b' : '#dc2626');
                                                            $confidenceText = $percentage >= 70 ? 'Tinggi' : ($percentage >= 50 ? 'Sedang' : 'Rendah');
                                                        @endphp
                                                        <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.5rem; background: {{ $confidenceColor }}; color: white; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">
                                                            {{ $confidenceText }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div style="text-align: center; padding: 2rem; color: #9ca3af; font-style: italic;">
                                            <div style="font-size: 2rem; margin-bottom: 0.5rem;">
                                                <i class="fas fa-bullseye"></i>
                                            </div>
                                            <p style="margin: 0;">Tidak ada hasil diagnosis</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card Footer -->
                        <div style="background: #f9fafb; padding: 1rem 1.5rem; border-top: 1px solid #e5e7eb;">
                            <div class="action-buttons" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                                <div class="button-group" style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                                    <!-- Lihat Detail Button -->
                                    <a href="{{ route('user.diagnosis.show', $diagnosis->id) }}"
                                       class="btn-responsive"
                                       style="background: #2563eb; color: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); text-decoration: none;"
                                       onmouseover="this.style.background='#1d4ed8'; this.style.transform='translateY(-1px)'"
                                       onmouseout="this.style.background='#2563eb'; this.style.transform='translateY(0)'">
                                        <i class="fas fa-eye" style="margin-right: 0.5rem;"></i>
                                        Lihat Detail
                                    </a>

                                    <!-- Download PDF Button -->
                                    <a href="{{ route('diagnosis.export.pdf', $diagnosis->id) }}"
                                       class="btn-responsive"
                                       style="background: #dc2626; color: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); text-decoration: none;"
                                       onmouseover="this.style.background='#b91c1c'; this.style.transform='translateY(-1px)'"
                                       onmouseout="this.style.background='#dc2626'; this.style.transform='translateY(0)'">
                                        <i class="fas fa-file-pdf" style="margin-right: 0.5rem;"></i>
                                        Download PDF
                                    </a>
                                </div>

                                <!-- Delete Button -->
                                <form action="{{ route('user.diagnosis.destroy', $diagnosis->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat diagnosis ini?')"
                                            class="btn-responsive"
                                            style="background: white; color: #374151; border: 1px solid #d1d5db; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);"
                                            onmouseover="this.style.background='#f9fafb'; this.style.borderColor='#9ca3af'"
                                            onmouseout="this.style.background='white'; this.style.borderColor='#d1d5db'">
                                        <i class="fas fa-trash" style="margin-right: 0.5rem;"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if(method_exists($diagnoses, 'links'))
                <div style="margin-top: 3rem; display: flex; justify-content: center;">
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1rem;">
                        {{ $diagnoses->links() }}
                    </div>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div style="text-align: center; padding: 4rem 2rem;">
                <div style="background: white; border-radius: 1.5rem; padding: 3rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; max-width: 600px; margin: 0 auto;">
                    <div style="font-size: 4rem; margin-bottom: 1.5rem; color: #059669;">
                        <i class="fas fa-seedling"></i>
                    </div>
                    
                    <h3 style="font-size: 1.5rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">
                        Belum Ada Riwayat Diagnosis
                    </h3>
                    
                    <p style="color: #6b7280; margin: 0 0 2rem 0; line-height: 1.6;">
                        Anda belum melakukan diagnosis apapun. Mulai diagnosis pertama Anda untuk mendeteksi penyakit pada tanaman jagung dan dapatkan rekomendasi penanganan yang tepat.
                    </p>

                    <!-- Call to Action -->
                    <a href="{{ route('diagnosis.index') }}"
                       style="display: inline-flex; align-items: center; padding: 1rem 2rem; background: linear-gradient(to right, #059669, #047857); color: white; font-weight: 500; border-radius: 1rem; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); font-size: 1rem;"
                       onmouseover="this.style.background='linear-gradient(to right, #047857, #065f46)'; this.style.transform='translateY(-1px)'"
                       onmouseout="this.style.background='linear-gradient(to right, #059669, #047857)'; this.style.transform='translateY(0)'">
                        <i class="fas fa-search" style="margin-right: 0.5rem;"></i>
                        Mulai Diagnosis Sekarang
                    </a>
                    
                    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e7eb;">
                        <p style="color: #9ca3af; font-size: 0.875rem; margin: 0;">
                            <i class="fas fa-lightbulb" style="color: #f59e0b; margin-right: 0.5rem;"></i>
                            <strong>Tips:</strong> Siapkan foto tanaman jagung yang menunjukkan gejala penyakit untuk diagnosis yang lebih akurat
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    /* Additional responsive styles */
    .card-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

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

        .card-grid {
            grid-template-columns: 1fr !important;
            gap: 1rem !important;
        }

        .action-buttons {
            flex-direction: column !important;
            align-items: stretch !important;
        }

        .button-group {
            justify-content: center !important;
            flex-direction: column !important;
            width: 100% !important;
        }

        .btn-responsive {
            width: 100% !important;
            margin-bottom: 0.5rem !important;
        }

        /* Mobile specific adjustments */
        .diagnosis-card {
            margin-bottom: 1rem;
        }

        .diagnosis-card .card-body {
            padding: 1rem !important;
        }

        .diagnosis-card .card-footer {
            padding: 0.75rem 1rem !important;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 1.75rem !important;
        }

        .hero-description {
            font-size: 0.875rem !important;
        }

        .stats-grid > div {
            padding: 1rem !important;
        }

        .filter-section {
            padding: 1rem !important;
        }
    }
</style>
@endsection
