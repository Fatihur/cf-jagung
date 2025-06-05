<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosisExportController extends Controller
{
    /**
     * Export diagnosis result to PDF
     */
    public function exportPdf($id)
    {
        $diagnosis = Diagnosis::with('user')->findOrFail($id);

        // Check if user can access this diagnosis (for authenticated users)
        if (Auth::check() && $diagnosis->user_id && $diagnosis->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to diagnosis record.');
        }

        // Prepare data for PDF
        $data = [
            'diagnosis' => $diagnosis,
            'user_name' => $diagnosis->user->name ?? 'Guest',
            'diagnosis_date' => $diagnosis->created_at->format('d F Y, H:i'),
            'selected_symptoms' => $this->formatSymptoms($diagnosis->selected_symptoms),
            'results' => $this->formatResults($diagnosis->results),
            'top_result' => $this->getTopResult($diagnosis->results),
        ];

        // Generate PDF
        $pdf = Pdf::loadView('diagnosis.export-pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        // Generate filename
        $filename = 'diagnosis-' . $diagnosis->id . '-' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export diagnosis result for user session
     */
    public function exportSessionPdf(Request $request)
    {
        $sessionId = $request->session()->getId();
        $diagnosis = Diagnosis::where('user_session', $sessionId)
                             ->latest()
                             ->first();

        if (!$diagnosis) {
            return redirect()->back()->with('error', 'Tidak ada hasil diagnosis yang ditemukan.');
        }

        return $this->exportPdf($diagnosis->id);
    }

    /**
     * Format symptoms for display
     */
    private function formatSymptoms($symptoms)
    {
        if (!is_array($symptoms)) {
            return [];
        }

        $symptomModels = \App\Models\Symptom::whereIn('id', $symptoms)->get();
        return $symptomModels->map(function ($symptom) {
            return [
                'code' => $symptom->code,
                'name' => $symptom->name,
                'description' => $symptom->description,
            ];
        })->toArray();
    }

    /**
     * Format results for display
     */
    private function formatResults($results)
    {
        if (!is_array($results)) {
            return [];
        }

        return collect($results)->map(function ($result, $index) {
            return [
                'rank' => $index + 1,
                'disease_name' => $result['disease']['name'] ?? 'Unknown',
                'disease_code' => $result['disease']['code'] ?? 'Unknown',
                'percentage' => $result['percentage'] ?? 0,
                'cf_value' => $result['cf_value'] ?? 0,
                'confidence_level' => $this->getConfidenceLevel($result['percentage'] ?? 0),
            ];
        })->toArray();
    }

    /**
     * Get top result
     */
    private function getTopResult($results)
    {
        if (!is_array($results) || empty($results)) {
            return null;
        }

        $top = $results[0];
        return [
            'disease_name' => $top['disease']['name'] ?? 'Unknown',
            'disease_code' => $top['disease']['code'] ?? 'Unknown',
            'percentage' => $top['percentage'] ?? 0,
            'cf_value' => $top['cf_value'] ?? 0,
            'confidence_level' => $this->getConfidenceLevel($top['percentage'] ?? 0),
            'recommendation' => $this->getRecommendation($top['percentage'] ?? 0),
        ];
    }

    /**
     * Get confidence level based on percentage
     */
    private function getConfidenceLevel($percentage)
    {
        if ($percentage >= 80) {
            return 'Sangat Tinggi';
        } elseif ($percentage >= 60) {
            return 'Tinggi';
        } elseif ($percentage >= 40) {
            return 'Sedang';
        } elseif ($percentage >= 20) {
            return 'Rendah';
        } else {
            return 'Sangat Rendah';
        }
    }

    /**
     * Get recommendation based on percentage
     */
    private function getRecommendation($percentage)
    {
        if ($percentage >= 70) {
            return 'Segera lakukan tindakan pengendalian sesuai dengan penyakit yang terdiagnosis.';
        } elseif ($percentage >= 50) {
            return 'Disarankan untuk melakukan observasi lebih lanjut dan konsultasi dengan ahli pertanian.';
        } else {
            return 'Lakukan monitoring rutin dan pertimbangkan diagnosis ulang dengan gejala yang lebih lengkap.';
        }
    }
}
