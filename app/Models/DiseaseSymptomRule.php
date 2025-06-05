<?php

namespace App\Models;

use App\Helpers\CodeGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiseaseSymptomRule extends Model
{
    protected $fillable = [
        'code',
        'disease_id',
        'symptom_id',
        'cf_value',
    ];

    protected $casts = [
        'cf_value' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($rule) {
            if (empty($rule->code)) {
                $rule->code = CodeGenerator::generateRuleCode();
            }
        });
    }

    /**
     * Get the disease that owns this rule
     */
    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }

    /**
     * Get the symptom that owns this rule
     */
    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class);
    }
}
