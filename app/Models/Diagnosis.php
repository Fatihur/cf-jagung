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
}
