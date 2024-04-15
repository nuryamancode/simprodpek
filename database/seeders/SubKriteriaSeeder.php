<?php

namespace Database\Seeders;

use App\Models\MSubKriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // kriteria 1
        MSubKriteria::create([
            'kriteria_id' => 1,
            'nama_subkriteria'=> 'Reliabilitas',
            'pertanyaan'=> 'Bekerja konsisten, bahkan semakin baik',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 1,
            'nama_subkriteria'=> 'Reliabilitas',
            'pertanyaan'=> 'Bekerja sesuai dengan Standar Prosedur Operasional (SPO)',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 1,
            'nama_subkriteria'=> 'Kemampuan berkomunikasi',
            'pertanyaan'=> '"Pengucapan kata-kata yang jelas, suara cukup kerjas
            didengar"',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 1,
            'nama_subkriteria'=> 'Kemampuan berkomunikasi',
            'pertanyaan'=> 'Pengungkapan maksud dengan runtut dan mudah dipahami',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 1,
            'nama_subkriteria'=> 'Kemampuan berkomunikasi',
            'pertanyaan'=> 'Mampu menangkap dengan mudah isi pesan lawan bicara',
        ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 1,
        //     'nama_subkriteria'=> 'Profesionalitas',
        //     'pertanyaan'=> 'Belajar dengan lebih mendalam pada profesinya',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 1,
        //     'nama_subkriteria'=> 'Profesionalitas',
        //     'pertanyaan'=> 'Memiliki kebanggaan terhadap profesinya',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 1,
        //     'nama_subkriteria'=> 'Profesionalitas',
        //     'pertanyaan'=> 'Menguasai Softskill dan Hardskill sesuai bidang yang ditekuni',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 1,
        //     'nama_subkriteria'=> 'Profesionalitas',
        //     'pertanyaan'=> 'Memiliki basis pengetahuan yang luas. Berusaha untuk mengikuti tren dan perkembangan yang ada.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 1,
        //     'nama_subkriteria'=> 'Profesionalitas',
        //     'pertanyaan'=> 'Mampu untuk memecahkan masalah yang sulit dengan menggunakan pendekatan terbaru dan dapat mengembangkan strategi baru untuk memecahkan masalah.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 1,
        //     'nama_subkriteria'=> 'Profesionalitas',
        //     'pertanyaan'=> 'Mampu mengambil keputusan secara efektif, baik berdasarkan pengalaman langsung maupun pengalaman tidak langsung.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 1,
        //     'nama_subkriteria'=> 'Profesionalitas',
        //     'pertanyaan'=> 'Mampu menelaah dan mencari keterkaitan hubungan dari informasi-informasi yang ada.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 1,
        //     'nama_subkriteria'=> 'Profesionalitas',
        //     'pertanyaan'=> 'Mampu menggunakan pendekatan/teori yang tepat dalam menyelesaikan masalah yang kompleks.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 1,
        //     'nama_subkriteria'=> 'Profesionalitas',
        //     'pertanyaan'=> 'Mampu mengunakan informasi yang ada dalam menyelesaikan pekerjaannya.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 1,
        //     'nama_subkriteria'=> 'Profesionalitas',
        //     'pertanyaan'=> 'Membuat keputusan dengan cepat dan tegas berdasarkan tujuan yang jelas.',
        // ]);

        // kriteria 2
        MSubKriteria::create([
            'kriteria_id' => 2,
            'nama_subkriteria'=> 'Perhatian terhadap Lingkungan Kerja',
            'pertanyaan'=> 'Inisiatif mengatur kerapian tempat kerja',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 2,
            'nama_subkriteria'=> 'Perhatian terhadap Lingkungan Kerja',
            'pertanyaan'=> 'Bila menemukan sampah, memungut & membuangnya',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 2,
            'nama_subkriteria'=> 'Perhatian terhadap Lingkungan Kerja',
            'pertanyaan'=> 'Memiliki loyalitas tinggi terhadap perusahaan.',
        ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Perhatian terhadap Lingkungan Kerja',
        //     'pertanyaan'=> 'Memiliki kemampuan untuk mencari sumber- sumber informasi baru untuk membantu mengatasi masalah yang kompleks.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Perhatian terhadap Lingkungan Kerja',
        //     'pertanyaan'=> 'Mengetahui kesalahan-kesalahan yang ada dalam proses pengambilan keputusan, dan mampu memperbaikinya.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Perhatian terhadap Lingkungan Kerja',
        //     'pertanyaan'=> 'Mampu dengan mudah memprioritaskan pekerjaan.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Perhatian terhadap Lingkungan Kerja',
        //     'pertanyaan'=> 'Menggunakan pandangan dan perencanaan kedepan dalam memilih masalah.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Perhatian terhadap Lingkungan Kerja',
        //     'pertanyaan'=> 'Bekerja untuk selalu menemukan solusi terbaik.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Perhatian terhadap Lingkungan Kerja',
        //     'pertanyaan'=> 'Konsisten dalam langkah-langkah pembuatan keputusan.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Asertif',
        //     'pertanyaan'=> 'Mengatakan pendapatnya dengan lugas',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Asertif',
        //     'pertanyaan'=> 'Tidak ada tendensi untuk melukai lawan bicara / agresif',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Asertif',
        //     'pertanyaan'=> 'Bicara konstruktif untuk menyelesaikan masalah',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Asertif',
        //     'pertanyaan'=> 'Mampu memilih dan melihat masalah dari sudut pandang yang berbeda dengan orang lain.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Asertif',
        //     'pertanyaan'=> 'Memiliki pengetahuan yang luas yang dapat membantu orang lain dalam pengambilan keputusan.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Asertif',
        //     'pertanyaan'=> 'Memiliki kepercayaan diri dan kemampuan yang tinggi dalam membuat keputusan yang baik.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Asertif',
        //     'pertanyaan'=> 'Mengatur pengambilan keputusan yang strategis untuk disesuaikan dengan situasi saat ini.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 2,
        //     'nama_subkriteria'=> 'Asertif',
        //     'pertanyaan'=> 'Bertanggung jawab penuh atas keputusan yang dibuat.',
        // ]);


        // kriteria 3
        MSubKriteria::create([
            'kriteria_id' => 3,
            'nama_subkriteria'=> 'Responsif (kesigapan)',
            'pertanyaan'=> 'Tanggap situasi klien yang memerlukan bantuan',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 3,
            'nama_subkriteria'=> 'Responsif (kesigapan)',
            'pertanyaan'=> 'Segera bergerak melakukan sesuatu untuk membantu klien',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 3,
            'nama_subkriteria'=> 'Responsif (kesigapan)',
            'pertanyaan'=> 'Mampu dengan cepat menguasai hubungan data, dan dapat memprediksi keadaan di masa yang akan datang menggunakan data tersebut.',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 3,
            'nama_subkriteria'=> 'Responsif (kesigapan)',
            'pertanyaan'=> 'Memiliki rasa keingintahuan yang besar.',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 3,
            'nama_subkriteria'=> 'Responsif (kesigapan)',
            'pertanyaan'=> 'Mampu untuk mengikuti strategi pengambilan keputusan tepat pada waktunya dan tidak hanya memiliki satu cara untuk memecahkan masalah.',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 3,
            'nama_subkriteria'=> 'Responsif (kesigapan)',
            'pertanyaan'=> 'Mampu membuat keputusan dalam kondisi tertekan/sulit.',
        ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan diri dan pakaian',
        //     'pertanyaan'=> 'Postur Ideal',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan diri dan pakaian',
        //     'pertanyaan'=> 'Memakai baju sesuai dengan Prosedur Operasional (SPO)',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan diri dan pakaian',
        //     'pertanyaan'=> 'Selalu rapi dan wangi',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan diri dan pakaian',
        //     'pertanyaan'=> 'Selalu memakai kartu tanda pengenal (nametag)',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan rambut pria',
        //     'pertanyaan'=> 'Panjang sesuai standar, tidak melebihi krah baju',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan rambut pria',
        //     'pertanyaan'=> 'Model dan warna sesuai standar',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan rambut pria',
        //     'pertanyaan'=> 'Selalu rapi, tidak memelihara jambang, janggut bercukur bersih',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan rambut wanita',
        //     'pertanyaan'=> 'Bila panjang diikat dengan rapi, bila pendek tidak melebihi krah baju',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan rambut wanita',
        //     'pertanyaan'=> "Bila dikerudung, berkerudung dengan rapi dan model standar syar'i",
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan rambut wanita',
        //     'pertanyaan'=> 'Model dan warna sesuai standar',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan rambut wanita',
        //     'pertanyaan'=> 'Selalu rapi, berpakai sopan dan santun',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan rambut wanita',
        //     'pertanyaan'=> 'Selalu memakai bedak',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Penampilan rambut wanita',
        //     'pertanyaan'=> 'Pewarna mata, pipi & bibir natural (Disesuaikan)',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Integritas',
        //     'pertanyaan'=> 'Tidak mudah goyah oleh sesuatu yang negatip',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Integritas',
        //     'pertanyaan'=> 'Tidak akan berbohong, bicara sesuai fakta yang ada',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Integritas',
        //     'pertanyaan'=> 'Disiplin, datang tepat waktu, selau ijin saat meninggalkan ruang kerja',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Integritas',
        //     'pertanyaan'=> 'Memahami suatu masalah yang kompleks dengan cepat.',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 3,
        //     'nama_subkriteria'=> 'Integritas',
        //     'pertanyaan'=> 'Memahami alasan-alasan yang relevan dalam pemecahan suatu masalah.',
        // ]);


        // kriteria 4
        MSubKriteria::create([
            'kriteria_id' => 4,
            'nama_subkriteria'=> 'Kesopanan',
            'pertanyaan'=> 'Mempertahankan kontak mata saat berbicara, tidak memutus pembicaraan',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 4,
            'nama_subkriteria'=> 'Kesopanan',
            'pertanyaan'=> 'Memberi hormat dengan mengucapkan "Bapak / Ibu" dan menyebut nama klien',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 4,
            'nama_subkriteria'=> 'Kesopanan',
            'pertanyaan'=> 'Mempersilakan dengan menggunakan tangan yang tepat',
        ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Empati',
        //     'pertanyaan'=> 'Menunda pembicaraan / kegiatan saat klien minta perhatian',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Empati',
        //     'pertanyaan'=> 'Berusaha mendapatkan penjelasan lebih baik, misal dengan mengulang kata-kata klien',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Empati',
        //     'pertanyaan'=> 'Mengungkapkan pemahamannya kepada klien',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Keramahan',
        //     'pertanyaan'=> 'Mudah sekali memberi senyum saat bertemu dan berbicara',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Keramahan',
        //     'pertanyaan'=> 'Dengan mudah memberi salam yang hangat dan bersahabat',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Keramahan',
        //     'pertanyaan'=> 'Memberi kenyamanan misal dengan mengambilkan kursi, mempersilakan duduk',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Belas kasihan',
        //     'pertanyaan'=> 'Peduli pada kebutuhan klien dan memiliki hati yang tulus untuk menolong',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Belas kasihan',
        //     'pertanyaan'=> 'Tetap setia/konsisten walau pertolongan yang akan dilakukan tidak mudah',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Belas kasihan',
        //     'pertanyaan'=> 'Melakukannya dengan gembira',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Tim kerja',
        //     'pertanyaan'=> 'Rela melepaskan ego untuk kepentingan bersama',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Tim kerja',
        //     'pertanyaan'=> 'Aktif mengambil pekerjaan dan tanggung jawab tanpa harus diminta',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 4,
        //     'nama_subkriteria'=> 'Tim kerja',
        //     'pertanyaan'=> 'Menikmati kegembiraan dengan tim yang ada',
        // ]);


        // kriteria 5
        MSubKriteria::create([
            'kriteria_id' => 5,
            'nama_subkriteria'=> 'Hidup damai sejahtera',
            'pertanyaan'=> 'Bebas dari konflik pribadi dan orang lain saat bekerja',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 5,
            'nama_subkriteria'=> 'Hidup damai sejahtera',
            'pertanyaan'=> 'Menampilkan kebahagiaan dalam bekerja, tidak mudah berkeluh kesah',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 5,
            'nama_subkriteria'=> 'Hidup damai sejahtera',
            'pertanyaan'=> 'Aktif berperan dalam doa tiap shift kerja, renungan, dan kebaktian',
        ]);
        MSubKriteria::create([
            'kriteria_id' => 5,
            'nama_subkriteria'=> 'Hidup damai sejahtera',
            'pertanyaan'=> 'Selalu memiliki energi penuh ( antusias, gembira saat bekerja)',
        ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 5,
        //     'nama_subkriteria'=> 'Hidup damai sejahtera',
        //     'pertanyaan'=> 'Mendapatkan energinya dari Tuhan',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 5,
        //     'nama_subkriteria'=> 'Hidup damai sejahtera',
        //     'pertanyaan'=> 'Terbuka dengan orang lain, mencari dukungan positip untuk hidupnya',
        // ]);
        // MSubKriteria::create([
        //     'kriteria_id' => 5,
        //     'nama_subkriteria'=> 'Hidup damai sejahtera',
        //     'pertanyaan'=> 'Ketetapan hati yang kuat bahwa pekerjaannya untuk Tuhan',
        // ]);
    }
}
