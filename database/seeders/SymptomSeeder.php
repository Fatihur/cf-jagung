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
                'code' => 'G001',
                'name' => 'Bercak coklat pada daun',
                'description' => 'Munculnya bercak-bercak berwarna coklat pada permukaan daun jagung'
            ],
            [
                'code' => 'G002',
                'name' => 'Daun menguning',
                'description' => 'Perubahan warna daun dari hijau menjadi kuning'
            ],
            [
                'code' => 'G003',
                'name' => 'Garis putih pada daun',
                'description' => 'Munculnya garis-garis putih sejajar dengan tulang daun'
            ],
            [
                'code' => 'G004',
                'name' => 'Pertumbuhan terhambat',
                'description' => 'Tanaman tumbuh lebih pendek dari normal'
            ],
            [
                'code' => 'G005',
                'name' => 'Bintik karat pada daun',
                'description' => 'Bintik-bintik kecil berwarna coklat kemerahan seperti karat'
            ],
            [
                'code' => 'G006',
                'name' => 'Batang lunak',
                'description' => 'Batang terasa lunak dan mudah ditekan'
            ],
            [
                'code' => 'G007',
                'name' => 'Tanaman mudah rebah',
                'description' => 'Tanaman mudah tumbang atau rebah'
            ],
            [
                'code' => 'G008',
                'name' => 'Daun mengering dari ujung',
                'description' => 'Daun mulai mengering dimulai dari ujung daun'
            ],
            [
                'code' => 'G009',
                'name' => 'Tongkol tidak terbentuk',
                'description' => 'Tongkol jagung tidak terbentuk atau abnormal'
            ],
            [
                'code' => 'G010',
                'name' => 'Spora mudah rontok',
                'description' => 'Spora pada daun mudah rontok jika disentuh'
            ],
            [
                'code' => 'G011',
                'name' => 'Batang berongga',
                'description' => 'Bagian dalam batang kosong atau berongga'
            ],
            [
                'code' => 'G012',
                'name' => 'Daun layu',
                'description' => 'Daun tampak layu dan tidak segar'
            ],
            [
                'code' => 'G013',
                'name' => 'Bercak memanjang abu-abu',
                'description' => 'Bercak memanjang berwarna abu-abu pada daun'
            ],
            [
                'code' => 'G014',
                'name' => 'Daun kering dan mati',
                'description' => 'Daun mengering dan mati secara bertahap'
            ],
            [
                'code' => 'G015',
                'name' => 'Pertumbuhan abnormal',
                'description' => 'Pertumbuhan tanaman tidak normal atau terdistorsi'
            ],
        ];

        foreach ($symptoms as $symptom) {
            Symptom::create($symptom);
        }
    }
}
