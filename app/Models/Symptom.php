<?php

namespace App\Models;

use App\Helpers\CodeGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Symptom extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($symptom) {
            if (empty($symptom->code)) {
                $symptom->code = CodeGenerator::generateSymptomCode();
            }
        });
    }

    /**
     * Get the diseases associated with this symptom through rules
     */
    public function diseases(): BelongsToMany
    {
        return $this->belongsToMany(Disease::class, 'disease_symptom_rules')
                    ->withPivot('cf_value')
                    ->withTimestamps();
    }

    /**
     * Get the disease symptom rules for this symptom
     */
    public function rules(): HasMany
    {
        return $this->hasMany(DiseaseSymptomRule::class);
    }
}
