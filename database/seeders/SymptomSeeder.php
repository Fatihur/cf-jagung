<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Symptom;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $symptoms = [
            [
                'code' => 'G01',
                'name' => 'Bercak lonjong keabu-abuan pada daun',
                'description' => 'Munculnya bercak-bercak berbentuk lonjong dengan warna keabu-abuan pada permukaan daun jagung. Bercak ini biasanya dimulai sebagai titik kecil kemudian berkembang menjadi bercak memanjang yang mengikuti arah tulang daun.'
            ],
            [
                'code' => 'G02',
                'name' => 'Daun mengering, dimulai dari ujung daun',
                'description' => 'Daun jagung mengalami pengeringan yang dimulai dari bagian ujung daun dan secara bertahap menyebar ke arah pangkal daun. Proses pengeringan ini menyebabkan daun menjadi coklat dan rapuh.'
            ],
            [
                'code' => 'G03',
                'name' => 'Terdapat serbuk berwarna karat pada daun',
                'description' => 'Munculnya serbuk halus berwarna karat (orange-coklat) pada permukaan daun, terutama pada bagian bawah daun. Serbuk ini merupakan spora jamur yang mudah rontok jika daun disentuh atau tertiup angin.'
            ],
            [
                'code' => 'G04',
                'name' => 'Bercak kecil basah (embun tepung) di daun',
                'description' => 'Terdapat bercak-bercak kecil yang tampak basah seperti embun tepung pada permukaan daun. Bercak ini biasanya berwarna putih keabu-abuan dan terasa lembab saat disentuh.'
            ],
            [
                'code' => 'G05',
                'name' => 'Pangkal batang membusuk dan berwarna gelap',
                'description' => 'Bagian pangkal batang mengalami pembusukan dengan perubahan warna menjadi gelap (coklat kehitaman). Area yang membusuk terasa lunak dan mudah hancur jika ditekan.'
            ],
            [
                'code' => 'G06',
                'name' => 'Tanaman layu secara keseluruhan',
                'description' => 'Seluruh bagian tanaman menunjukkan gejala layu meskipun kondisi air dan kelembaban tanah cukup. Daun terlihat lemas, menggantung, dan kehilangan turgiditas.'
            ],
            [
                'code' => 'G07',
                'name' => 'Biji pada tongkol tidak terisi penuh',
                'description' => 'Tongkol jagung menunjukkan biji-biji yang tidak terisi penuh atau kosong. Hal ini disebabkan oleh gangguan proses fotosintesis dan translokasi nutrisi akibat kerusakan pada daun.'
            ],
        ];

        foreach ($symptoms as $symptom) {
            Symptom::create($symptom);
        }
    }
}
