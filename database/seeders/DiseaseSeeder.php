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
                'code' => 'P01',
                'name' => 'Hawar Daun',
                'description' => 'Penyakit hawar daun adalah salah satu penyakit utama pada tanaman jagung yang disebabkan oleh jamur. Penyakit ini dapat menyebabkan penurunan hasil yang signifikan jika tidak ditangani dengan baik.',
                'causes' => 'Disebabkan oleh jamur Exserohilum turcicum (Helminthosporium turcicum). Kondisi lembab dengan kelembaban tinggi (>80%) dan suhu 18-27°C sangat mendukung perkembangan penyakit ini.',
                'symptoms_description' => 'Bercak lonjong keabu-abuan pada daun, daun mengering dimulai dari ujung daun, biji pada tongkol tidak terisi penuh akibat gangguan fotosintesis.',
                'control_methods' => '1. Gunakan varietas jagung yang tahan terhadap hawar daun
2. Rotasi tanaman dengan tanaman non-graminae (kacang-kacangan, umbi-umbian)
3. Aplikasi fungisida berbahan aktif mankozeb atau klorotalonil setiap 7-10 hari
4. Sanitasi lahan dengan membersihkan sisa-sisa tanaman setelah panen
5. Pengaturan jarak tanam yang tepat (75x25 cm) untuk sirkulasi udara yang baik
6. Pemupukan berimbang untuk meningkatkan ketahanan tanaman',
            ],
            [
                'code' => 'P02',
                'name' => 'Karat Daun',
                'description' => 'Penyakit karat daun disebabkan oleh jamur Puccinia sorghi yang menyerang daun jagung. Penyakit ini ditandai dengan munculnya serbuk berwarna karat pada permukaan daun yang dapat mengurangi kemampuan fotosintesis tanaman.',
                'causes' => 'Disebabkan oleh jamur Puccinia sorghi. Kondisi lembab dengan embun pagi, kelembaban tinggi (85-95%), dan suhu sedang (20-25°C) sangat mendukung perkembangan dan penyebaran spora jamur.',
                'symptoms_description' => 'Terdapat serbuk berwarna karat (orange-coklat) pada permukaan daun, bercak kecil basah seperti embun tepung di daun, spora mudah rontok jika daun disentuh.',
                'control_methods' => '1. Aplikasi fungisida sistemik berbahan aktif propikonazol atau tebukonazol
2. Penanaman varietas jagung yang tahan terhadap karat daun
3. Pengaturan jarak tanam untuk sirkulasi udara yang baik
4. Hindari penyiraman dari atas (overhead irrigation) yang dapat menyebarkan spora
5. Pemupukan berimbang terutama kalium untuk meningkatkan ketahanan tanaman
6. Monitoring rutin dan aplikasi fungisida pada gejala awal',
            ],
            [
                'code' => 'P03',
                'name' => 'Busuk Pangkal Batang',
                'description' => 'Penyakit busuk pangkal batang disebabkan oleh jamur tanah yang menyerang sistem perakaran dan pangkal batang. Penyakit ini sangat berbahaya karena dapat menyebabkan kematian tanaman secara keseluruhan.',
                'causes' => 'Disebabkan oleh kompleks jamur tanah seperti Fusarium spp., Pythium spp., dan Rhizoctonia solani. Kondisi tanah yang tergenang air, drainase buruk, dan kelembaban tanah yang tinggi mendukung perkembangan penyakit.',
                'symptoms_description' => 'Pangkal batang membusuk dan berwarna gelap (coklat kehitaman), tanaman layu secara keseluruhan meskipun kondisi air cukup, akar menjadi coklat dan mudah putus.',
                'control_methods' => '1. Perbaiki sistem drainase lahan untuk mencegah genangan air
2. Buang dan musnahkan tanaman yang terinfeksi dengan cara dibakar
3. Aplikasi fungisida berbahan aktif metalaksil atau fosetil-aluminium pada tanah
4. Gunakan benih bersertifikat dan sehat
5. Lakukan pengolahan tanah yang baik dengan penambahan bahan organik
6. Aplikasi pupuk organik untuk meningkatkan kesehatan dan struktur tanah
7. Rotasi tanaman dengan tanaman yang tidak rentan terhadap jamur tanah',
            ],
        ];

        foreach ($diseases as $disease) {
            Disease::create($disease);
        }
    }
}
