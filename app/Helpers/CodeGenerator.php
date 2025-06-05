<?php

namespace App\Helpers;

use App\Models\Disease;
use App\Models\Symptom;
use App\Models\DiseaseSymptomRule;

class CodeGenerator
{
    /**
     * Generate next disease code
     */
    public static function generateDiseaseCode(): string
    {
        $lastDisease = Disease::orderBy('code', 'desc')->first();
        
        if (!$lastDisease) {
            return 'P001';
        }
        
        $lastNumber = (int) substr($lastDisease->code, 1);
        $nextNumber = $lastNumber + 1;
        
        return 'P' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Generate next symptom code
     */
    public static function generateSymptomCode(): string
    {
        $lastSymptom = Symptom::orderBy('code', 'desc')->first();
        
        if (!$lastSymptom) {
            return 'G001';
        }
        
        $lastNumber = (int) substr($lastSymptom->code, 1);
        $nextNumber = $lastNumber + 1;
        
        return 'G' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Generate next rule code
     */
    public static function generateRuleCode(): string
    {
        $lastRule = DiseaseSymptomRule::orderBy('code', 'desc')->first();
        
        if (!$lastRule) {
            return 'R001';
        }
        
        $lastNumber = (int) substr($lastRule->code, 1);
        $nextNumber = $lastNumber + 1;
        
        return 'R' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Generate rule code based on disease and symptom
     */
    public static function generateRuleCodeFromRelation(Disease $disease, Symptom $symptom): string
    {
        // Format: R{disease_number}{symptom_number}
        $diseaseNumber = substr($disease->code, 1);
        $symptomNumber = substr($symptom->code, 1);
        
        return "R{$diseaseNumber}{$symptomNumber}";
    }

    /**
     * Validate code format
     */
    public static function validateDiseaseCode(string $code): bool
    {
        return preg_match('/^P\d{3}$/', $code);
    }

    public static function validateSymptomCode(string $code): bool
    {
        return preg_match('/^G\d{3}$/', $code);
    }

    public static function validateRuleCode(string $code): bool
    {
        return preg_match('/^R\d{3,6}$/', $code);
    }
}
