<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CertaintyFactorEngine;
use App\Models\Diagnosis;
use App\Models\Disease;
use App\Models\Symptom;
use Illuminate\Support\Facades\Auth;

class DiagnosisController extends Controller
{
    protected $cfEngine;

    public function __construct(CertaintyFactorEngine $cfEngine)
    {
        $this->cfEngine = $cfEngine;
    }

    /**
     * Show the diagnosis form
     */
    public function index()
    {
        $symptoms = $this->cfEngine->getAvailableSymptoms();
        return view('diagnosis.index', compact('symptoms'));
    }

    /**
     * Process the diagnosis
     */
    public function diagnose(Request $request)
    {
        $request->validate([
            'symptoms' => 'required|array|min:1',
            'symptoms.*' => 'exists:symptoms,id',
            'confidence_levels' => 'required|array',
            'confidence_levels.*' => 'required|string|in:tidak_yakin,kurang_yakin,cukup_yakin,yakin,sangat_yakin',
        ]);

        $selectedSymptomIds = $request->input('symptoms', []);
        $userConfidenceLevels = $request->input('confidence_levels', []);

        // Calculate diagnosis using CF engine with user confidence levels
        $results = $this->cfEngine->calculateDiagnosis($selectedSymptomIds, $userConfidenceLevels);

        // Store diagnosis in database
        $diagnosis = Diagnosis::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'user_session' => session()->getId(),
            'selected_symptoms' => $selectedSymptomIds,
            'user_confidence_levels' => $userConfidenceLevels,
            'results' => $results,
            'user_ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return view('diagnosis.result', compact('results', 'selectedSymptomIds', 'userConfidenceLevels'));
    }

    /**
     * Show disease details
     */
    public function showDisease($id)
    {
        $disease = Disease::findOrFail($id);
        return view('diseases.show', compact('disease'));
    }
}
