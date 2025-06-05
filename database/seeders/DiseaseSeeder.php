<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Disease;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diseases = [
            [
                'code' => 'P001',
                'name' => 'Bercak Daun (Leaf Blight)',
                'description' => 'Penyakit yang disebabkan oleh jamur yang menyerang daun jagung, menyebabkan bercak-bercak coklat pada permukaan daun.',
                'causes' => 'Disebabkan oleh jamur Helminthosporium turcicum. Kondisi lembab dan suhu hangat mendukung perkembangan penyakit ini.',
                'symptoms_description' => 'Bercak coklat memanjang pada daun, dimulai dari ujung daun dan menyebar ke pangkal. Daun menjadi kering dan mati.',
                'control_methods' => '1. Gunakan varietas tahan penyakit
2. Rotasi tanaman dengan tanaman non-graminae
3. Aplikasi fungisida berbahan aktif mankozeb atau propikonazol
4. Sanitasi lahan dengan membersihkan sisa tanaman
5. Pengaturan jarak tanam yang baik untuk sirkulasi udara',
            ],
            [
                'code' => 'P002',
                'name' => 'Bulai (Downy Mildew)',
                'description' => 'Penyakit sistemik yang disebabkan oleh jamur yang menyerang seluruh bagian tanaman jagung dari akar hingga tongkol.',
                'causes' => 'Disebabkan oleh jamur Peronosclerospora maydis. Kelembaban tinggi dan suhu 20-30°C sangat mendukung perkembangan penyakit.',
                'symptoms_description' => 'Daun menguning dengan garis-garis putih sejajar tulang daun. Pertumbuhan tanaman terhambat, tongkol tidak terbentuk atau abnormal.',
                'control_methods' => '1. Gunakan benih bersertifikat dan varietas tahan
2. Perlakuan benih dengan fungisida metalaksil
3. Aplikasi fungisida sistemik saat gejala awal
4. Pengaturan drainase yang baik
5. Eradikasi tanaman terserang
6. Rotasi tanaman',
            ],
            [
                'code' => 'P003',
                'name' => 'Karat Daun (Rust)',
                'description' => 'Penyakit yang menyebabkan bintik-bintik karat berwarna coklat kemerahan pada permukaan daun jagung.',
                'causes' => 'Disebabkan oleh jamur Puccinia sorghi. Kondisi lembab dengan embun pagi dan suhu sedang mendukung infeksi.',
                'symptoms_description' => 'Bintik-bintik kecil berwarna coklat kemerahan pada kedua permukaan daun. Spora mudah rontok jika disentuh.',
                'control_methods' => '1. Aplikasi fungisida berbahan aktif triazol
2. Penanaman varietas tahan karat
3. Pengaturan jarak tanam untuk sirkulasi udara
4. Pemupukan berimbang untuk meningkatkan ketahanan
5. Monitoring rutin dan aplikasi dini',
            ],
            [
                'code' => 'P004',
                'name' => 'Busuk Batang (Stalk Rot)',
                'description' => 'Penyakit yang menyerang batang jagung menyebabkan pembusukan dan rebahnya tanaman.',
                'causes' => 'Disebabkan oleh kompleks jamur Fusarium, Diplodia, dan Macrophomina. Stress tanaman dan kondisi kering mendukung infeksi.',
                'symptoms_description' => 'Batang menjadi lunak dan mudah patah. Bagian dalam batang berwarna coklat dan berongga. Tanaman mudah rebah.',
                'control_methods' => '1. Pemupukan berimbang terutama kalium
2. Pengairan yang cukup saat fase kritis
3. Hindari kerusakan mekanis pada batang
4. Panen tepat waktu
5. Rotasi tanaman
6. Gunakan varietas tahan',
            ],
            [
                'code' => 'P005',
                'name' => 'Hawar Daun (Leaf Blight)',
                'description' => 'Penyakit yang menyebabkan layu dan matinya daun jagung secara bertahap dari bawah ke atas.',
                'causes' => 'Disebabkan oleh jamur Exserohilum turcicum. Kelembaban tinggi dan suhu 18-27°C mendukung perkembangan.',
                'symptoms_description' => 'Bercak memanjang berwarna abu-abu hingga coklat pada daun. Daun mengering dari ujung dan tepi.',
                'control_methods' => '1. Aplikasi fungisida preventif
2. Penggunaan varietas toleran
3. Sanitasi kebun
4. Pengaturan populasi tanaman
5. Pemupukan berimbang',
            ],
        ];

        foreach ($diseases as $disease) {
            Disease::create($disease);
        }
    }
}
