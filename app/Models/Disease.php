<?php

namespace App\Models;

use App\Helpers\CodeGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disease extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'causes',
        'symptoms_description',
        'control_methods',
        'image_path',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($disease) {
            if (empty($disease->code)) {
                $disease->code = CodeGenerator::generateDiseaseCode();
            }
        });
    }

    /**
     * Get the symptoms associated with this disease through rules
     */
    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, 'disease_symptom_rules')
                    ->withPivot('cf_value')
                    ->withTimestamps();
    }

    /**
     * Get the disease symptom rules for this disease
     */
    public function rules(): HasMany
    {
        return $this->hasMany(DiseaseSymptomRule::class);
    }

    /**
     * Alias for rules() method for backward compatibility
     */
    public function diseaseSymptomRules(): HasMany
    {
        return $this->rules();
    }

    /**
     * Get diagnoses that resulted in this disease
     */
    public function diagnoses()
    {
        // This would require a more complex query to get diagnoses where this disease was the result
        // For now, we'll return an empty collection
        return collect();
    }
}
