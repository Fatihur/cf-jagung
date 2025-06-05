<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosis Penyakit Jagung</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .header h1 {
            color: #2563eb;
            font-size: 24px;
            margin: 0 0 10px 0;
            font-weight: bold;
        }
        
        .header h2 {
            color: #64748b;
            font-size: 16px;
            margin: 0;
            font-weight: normal;
        }
        
        .info-section {
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #2563eb;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 8px;
        }
        
        .info-label {
            font-weight: bold;
            width: 150px;
            color: #374151;
        }
        
        .info-value {
            color: #6b7280;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .symptoms-list {
            background-color: #fef3c7;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #f59e0b;
        }
        
        .symptom-item {
            margin-bottom: 10px;
            padding: 8px;
            background-color: white;
            border-radius: 4px;
        }
        
        .symptom-code {
            font-weight: bold;
            color: #92400e;
        }
        
        .symptom-name {
            font-weight: bold;
            color: #374151;
            margin-left: 10px;
        }
        
        .symptom-desc {
            color: #6b7280;
            font-size: 11px;
            margin-top: 3px;
        }
        
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        .results-table th,
        .results-table td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }
        
        .results-table th {
            background-color: #f3f4f6;
            font-weight: bold;
            color: #374151;
        }
        
        .rank-1 {
            background-color: #dcfce7;
            font-weight: bold;
        }
        
        .rank-2 {
            background-color: #fef3c7;
        }
        
        .rank-3 {
            background-color: #fee2e2;
        }
        
        .top-result {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        
        .top-result h3 {
            margin: 0 0 15px 0;
            font-size: 18px;
        }
        
        .top-result-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .disease-info h4 {
            margin: 0 0 5px 0;
            font-size: 16px;
        }
        
        .disease-code {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .confidence-badge {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 20px;
            text-align: center;
        }
        
        .percentage {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        
        .confidence-level {
            font-size: 12px;
            margin: 5px 0 0 0;
        }
        
        .recommendation {
            background-color: #eff6ff;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
            margin-top: 20px;
        }
        
        .recommendation h4 {
            color: #1e40af;
            margin: 0 0 10px 0;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 11px;
        }
        
        .disclaimer {
            background-color: #fef2f2;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #ef4444;
            margin-top: 20px;
        }
        
        .disclaimer h4 {
            color: #dc2626;
            margin: 0 0 10px 0;
        }
        
        .disclaimer p {
            margin: 0;
            color: #7f1d1d;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>SISTEM PAKAR DIAGNOSIS PENYAKIT JAGUNG</h1>
        <h2>Hasil Diagnosis Menggunakan Metode Certainty Factor</h2>
    </div>

    <!-- Informasi Diagnosis -->
    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Nama Pengguna:</span>
            <span class="info-value">{{ $user_name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Tanggal Diagnosis:</span>
            <span class="info-value">{{ $diagnosis_date }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">ID Diagnosis:</span>
            <span class="info-value">#{{ $diagnosis->id }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Jumlah Gejala:</span>
            <span class="info-value">{{ count($selected_symptoms) }} gejala</span>
        </div>
    </div>

    <!-- Hasil Diagnosis Utama -->
    @if($top_result)
    <div class="top-result">
        <h3>🎯 HASIL DIAGNOSIS UTAMA</h3>
        <div class="top-result-content">
            <div class="disease-info">
                <h4>{{ $top_result['disease_name'] }}</h4>
                <div class="disease-code">Kode: {{ $top_result['disease_code'] }}</div>
            </div>
            <div class="confidence-badge">
                <div class="percentage">{{ number_format($top_result['percentage'], 1) }}%</div>
                <div class="confidence-level">{{ $top_result['confidence_level'] }}</div>
            </div>
        </div>
    </div>
    @endif

    <!-- Gejala yang Dipilih -->
    <div class="section">
        <div class="section-title">🔍 GEJALA YANG DIAMATI</div>
        <div class="symptoms-list">
            @forelse($selected_symptoms as $symptom)
            <div class="symptom-item">
                <span class="symptom-code">{{ $symptom['code'] }}</span>
                <span class="symptom-name">{{ $symptom['name'] }}</span>
                @if($symptom['description'])
                <div class="symptom-desc">{{ $symptom['description'] }}</div>
                @endif
            </div>
            @empty
            <p>Tidak ada gejala yang tercatat.</p>
            @endforelse
        </div>
    </div>

    <!-- Hasil Lengkap -->
    <div class="section">
        <div class="section-title">📊 HASIL DIAGNOSIS LENGKAP</div>
        <table class="results-table">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Kode</th>
                    <th>Nama Penyakit</th>
                    <th>Persentase</th>
                    <th>CF Value</th>
                    <th>Tingkat Keyakinan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($results as $result)
                <tr class="{{ $result['rank'] <= 3 ? 'rank-' . $result['rank'] : '' }}">
                    <td>{{ $result['rank'] }}</td>
                    <td>{{ $result['disease_code'] }}</td>
                    <td>{{ $result['disease_name'] }}</td>
                    <td>{{ number_format($result['percentage'], 1) }}%</td>
                    <td>{{ number_format($result['cf_value'], 3) }}</td>
                    <td>{{ $result['confidence_level'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada hasil diagnosis.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Rekomendasi -->
    @if($top_result)
    <div class="recommendation">
        <h4>💡 REKOMENDASI</h4>
        <p>{{ $top_result['recommendation'] }}</p>
    </div>
    @endif

    <!-- Disclaimer -->
    <div class="disclaimer">
        <h4>⚠️ DISCLAIMER</h4>
        <p>
            Hasil diagnosis ini merupakan prediksi berdasarkan sistem pakar dengan metode Certainty Factor. 
            Untuk kepastian diagnosis dan penanganan yang tepat, disarankan untuk berkonsultasi dengan ahli pertanian atau pakar penyakit tanaman.
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis oleh Sistem Pakar Diagnosis Penyakit Jagung</p>
        <p>Dicetak pada: {{ now()->format('d F Y, H:i:s') }}</p>
    </div>
</body>
</html>
