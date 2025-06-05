<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DiseaseSymptomRule;
use App\Models\Disease;
use App\Models\Symptom;

class DiseaseSymptomRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get diseases and symptoms
        $diseases = Disease::all()->keyBy('name');
        $symptoms = Symptom::all()->keyBy('name');

        // CF Rules for Bercak Daun (Leaf Blight)
        $leafBlightRules = [
            'Bercak coklat pada daun' => ['cf' => 0.9, 'code' => 'R001'],
            'Daun mengering dari ujung' => ['cf' => 0.8, 'code' => 'R002'],
            'Daun kering dan mati' => ['cf' => 0.7, 'code' => 'R003'],
            'Bercak memanjang abu-abu' => ['cf' => 0.6, 'code' => 'R004'],
        ];

        foreach ($leafBlightRules as $symptomName => $ruleData) {
            if (isset($diseases['Bercak Daun (Leaf Blight)']) && isset($symptoms[$symptomName])) {
                DiseaseSymptomRule::create([
                    'code' => $ruleData['code'],
                    'disease_id' => $diseases['Bercak Daun (Leaf Blight)']->id,
                    'symptom_id' => $symptoms[$symptomName]->id,
                    'cf_value' => $ruleData['cf'],
                ]);
            }
        }

        // CF Rules for Bulai (Downy Mildew)
        $bulaiRules = [
            'Daun menguning' => ['cf' => 0.9, 'code' => 'R005'],
            'Garis putih pada daun' => ['cf' => 0.95, 'code' => 'R006'],
            'Pertumbuhan terhambat' => ['cf' => 0.8, 'code' => 'R007'],
            'Tongkol tidak terbentuk' => ['cf' => 0.85, 'code' => 'R008'],
            'Pertumbuhan abnormal' => ['cf' => 0.7, 'code' => 'R009'],
        ];

        foreach ($bulaiRules as $symptomName => $ruleData) {
            if (isset($diseases['Bulai (Downy Mildew)']) && isset($symptoms[$symptomName])) {
                DiseaseSymptomRule::create([
                    'code' => $ruleData['code'],
                    'disease_id' => $diseases['Bulai (Downy Mildew)']->id,
                    'symptom_id' => $symptoms[$symptomName]->id,
                    'cf_value' => $ruleData['cf'],
                ]);
            }
        }

        // CF Rules for Karat Daun (Rust)
        $rustRules = [
            'Bintik karat pada daun' => ['cf' => 0.95, 'code' => 'R010'],
            'Spora mudah rontok' => ['cf' => 0.9, 'code' => 'R011'],
            'Daun menguning' => ['cf' => 0.6, 'code' => 'R012'],
        ];

        foreach ($rustRules as $symptomName => $ruleData) {
            if (isset($diseases['Karat Daun (Rust)']) && isset($symptoms[$symptomName])) {
                DiseaseSymptomRule::create([
                    'code' => $ruleData['code'],
                    'disease_id' => $diseases['Karat Daun (Rust)']->id,
                    'symptom_id' => $symptoms[$symptomName]->id,
                    'cf_value' => $ruleData['cf'],
                ]);
            }
        }

        // CF Rules for Busuk Batang (Stalk Rot)
        $stalkRotRules = [
            'Batang lunak' => ['cf' => 0.9, 'code' => 'R013'],
            'Tanaman mudah rebah' => ['cf' => 0.85, 'code' => 'R014'],
            'Batang berongga' => ['cf' => 0.8, 'code' => 'R015'],
            'Daun layu' => ['cf' => 0.6, 'code' => 'R016'],
        ];

        foreach ($stalkRotRules as $symptomName => $ruleData) {
            if (isset($diseases['Busuk Batang (Stalk Rot)']) && isset($symptoms[$symptomName])) {
                DiseaseSymptomRule::create([
                    'code' => $ruleData['code'],
                    'disease_id' => $diseases['Busuk Batang (Stalk Rot)']->id,
                    'symptom_id' => $symptoms[$symptomName]->id,
                    'cf_value' => $ruleData['cf'],
                ]);
            }
        }

        // CF Rules for Hawar Daun (Leaf Blight)
        $leafBlightRules2 = [
            'Bercak memanjang abu-abu' => ['cf' => 0.9, 'code' => 'R017'],
            'Daun mengering dari ujung' => ['cf' => 0.8, 'code' => 'R018'],
            'Daun layu' => ['cf' => 0.7, 'code' => 'R019'],
            'Daun kering dan mati' => ['cf' => 0.75, 'code' => 'R020'],
        ];

        foreach ($leafBlightRules2 as $symptomName => $ruleData) {
            if (isset($diseases['Hawar Daun (Leaf Blight)']) && isset($symptoms[$symptomName])) {
                DiseaseSymptomRule::create([
                    'code' => $ruleData['code'],
                    'disease_id' => $diseases['Hawar Daun (Leaf Blight)']->id,
                    'symptom_id' => $symptoms[$symptomName]->id,
                    'cf_value' => $ruleData['cf'],
                ]);
            }
        }
    }
}
