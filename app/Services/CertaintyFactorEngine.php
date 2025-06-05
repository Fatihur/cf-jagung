<?php

namespace App\Services;

use App\Models\Disease;
use App\Models\Symptom;
use App\Models\DiseaseSymptomRule;
use App\Enums\ConfidenceLevel;

class CertaintyFactorEngine
{
    /**
     * Calculate diagnosis based on selected symptoms using Certainty Factor method
     *
     * @param array $selectedSymptomIds Array of symptom IDs
     * @param array $userConfidenceLevels Array of user confidence levels for each symptom
     * @return array Array of diseases with their CF values
     */
    public function calculateDiagnosis(array $selectedSymptomIds, array $userConfidenceLevels = []): array
    {
        if (empty($selectedSymptomIds)) {
            return [];
        }

        // Get all diseases that have rules for the selected symptoms
        $diseases = Disease::whereHas('rules', function ($query) use ($selectedSymptomIds) {
            $query->whereIn('symptom_id', $selectedSymptomIds);
        })->with(['rules' => function ($query) use ($selectedSymptomIds) {
            $query->whereIn('symptom_id', $selectedSymptomIds);
        }])->get();

        $results = [];

        foreach ($diseases as $disease) {
            $cfValues = [];
            
            // Collect CF values for this disease based on selected symptoms
            foreach ($disease->rules as $rule) {
                if (in_array($rule->symptom_id, $selectedSymptomIds)) {
                    $expertCF = (float) $rule->cf_value;

                    // Get user confidence level for this symptom
                    $userCF = 1.0; // Default if no user confidence provided
                    if (!empty($userConfidenceLevels) && isset($userConfidenceLevels[$rule->symptom_id])) {
                        $confidenceLevel = ConfidenceLevel::from($userConfidenceLevels[$rule->symptom_id]);
                        $userCF = $confidenceLevel->cfValue();
                    }

                    // Combine expert CF with user CF: CF_combined = CF_expert * CF_user
                    $combinedCF = $expertCF * $userCF;
                    $cfValues[] = $combinedCF;
                }
            }

            // Calculate combined CF for this disease
            $combinedCF = $this->combineCertaintyFactors($cfValues);
            
            if ($combinedCF > 0) {
                $results[] = [
                    'disease' => $disease,
                    'cf_value' => $combinedCF,
                    'percentage' => round($combinedCF * 100, 2),
                    'confidence_level' => $this->getConfidenceLevel($combinedCF)
                ];
            }
        }

        // Sort by CF value in descending order
        usort($results, function ($a, $b) {
            return $b['cf_value'] <=> $a['cf_value'];
        });

        return $results;
    }

    /**
     * Combine multiple certainty factors using the standard CF combination formula
     *
     * @param array $cfValues Array of CF values
     * @return float Combined CF value
     */
    private function combineCertaintyFactors(array $cfValues): float
    {
        if (empty($cfValues)) {
            return 0.0;
        }

        if (count($cfValues) === 1) {
            return $cfValues[0];
        }

        $combined = $cfValues[0];

        for ($i = 1; $i < count($cfValues); $i++) {
            $cf1 = $combined;
            $cf2 = $cfValues[$i];

            if ($cf1 >= 0 && $cf2 >= 0) {
                // Both positive: CF(A,B) = CF(A) + CF(B) - CF(A) * CF(B)
                $combined = $cf1 + $cf2 - ($cf1 * $cf2);
            } elseif ($cf1 < 0 && $cf2 < 0) {
                // Both negative: CF(A,B) = CF(A) + CF(B) + CF(A) * CF(B)
                $combined = $cf1 + $cf2 + ($cf1 * $cf2);
            } else {
                // One positive, one negative: CF(A,B) = (CF(A) + CF(B)) / (1 - min(|CF(A)|, |CF(B)|))
                $denominator = 1 - min(abs($cf1), abs($cf2));
                $combined = $denominator != 0 ? ($cf1 + $cf2) / $denominator : 0;
            }
        }

        return round($combined, 4);
    }

    /**
     * Get confidence level description based on CF value
     *
     * @param float $cfValue
     * @return string
     */
    private function getConfidenceLevel(float $cfValue): string
    {
        return ConfidenceLevel::fromCfValue($cfValue)->label();
    }

    /**
     * Get symptoms for diagnosis form
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAvailableSymptoms()
    {
        return Symptom::orderBy('name')->get();
    }

    /**
     * Validate selected symptoms
     *
     * @param array $selectedSymptomIds
     * @return bool
     */
    public function validateSymptoms(array $selectedSymptomIds): bool
    {
        if (empty($selectedSymptomIds)) {
            return false;
        }

        $existingSymptoms = Symptom::whereIn('id', $selectedSymptomIds)->count();
        return $existingSymptoms === count($selectedSymptomIds);
    }
}
