<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DiseaseSymptomRule;
use App\Models\Disease;
use App\Models\Symptom;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get diseases and symptoms by code
        $diseases = Disease::all()->keyBy('code');
        $symptoms = Symptom::all()->keyBy('code');

        $rules = [
            [
                'code' => 'R01',
                'disease_id' => $diseases['P01']->id,
                'symptom_id' => $symptoms['G01']->id,
                'cf_value' => 0.7,
            ],
            [
                'code' => 'R02',
                'disease_id' => $diseases['P01']->id,
                'symptom_id' => $symptoms['G02']->id,
                'cf_value' => 0.6,
            ],
            [
                'code' => 'R03',
                'disease_id' => $diseases['P02']->id,
                'symptom_id' => $symptoms['G03']->id,
                'cf_value' => 0.8,
            ],
            [
                'code' => 'R04',
                'disease_id' => $diseases['P02']->id,
                'symptom_id' => $symptoms['G04']->id,
                'cf_value' => 0.4,
            ],
            [
                'code' => 'R05',
                'disease_id' => $diseases['P03']->id,
                'symptom_id' => $symptoms['G05']->id,
                'cf_value' => 0.85,
            ],
            [
                'code' => 'R06',
                'disease_id' => $diseases['P03']->id,
                'symptom_id' => $symptoms['G06']->id,
                'cf_value' => 0.7,
            ],
            [
                'code' => 'R07',
                'disease_id' => $diseases['P01']->id,
                'symptom_id' => $symptoms['G07']->id,
                'cf_value' => 0.3,
            ],
        ];

        foreach ($rules as $rule) {
            DiseaseSymptomRule::create($rule);
        }
    }
}
