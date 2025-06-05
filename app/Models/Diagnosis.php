<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $fillable = [
        'user_id',
        'user_session',
        'selected_symptoms',
        'user_confidence_levels',
        'results',
        'user_ip',
        'user_agent',
    ];

    protected $casts = [
        'selected_symptoms' => 'array',
        'user_confidence_levels' => 'array',
        'results' => 'array',
    ];

    /**
     * Get the user that owns the diagnosis
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get symptoms count for display
     */
    public function getSymptomsCountAttribute()
    {
        if (is_array($this->selected_symptoms)) {
            return count($this->selected_symptoms);
        }
        return 0;
    }

    /**
     * Get the actual symptom objects based on selected_symptoms IDs
     */
    public function getSymptoms()
    {
        if (!is_array($this->selected_symptoms) || empty($this->selected_symptoms)) {
            return collect();
        }

        return \App\Models\Symptom::whereIn('id', $this->selected_symptoms)->get();
    }

    /**
     * Get symptoms attribute (for compatibility)
     */
    public function getSymptomsAttribute()
    {
        return $this->getSymptoms();
    }

    /**
     * Get top result for display
     */
    public function getTopResultAttribute()
    {
        if (is_array($this->results) && !empty($this->results)) {
            $top = $this->results[0];
            if (isset($top['disease']['name']) && isset($top['percentage'])) {
                return $top['disease']['name'] . ' (' . $top['percentage'] . '%)';
            }
        }
        return '-';
    }
}
