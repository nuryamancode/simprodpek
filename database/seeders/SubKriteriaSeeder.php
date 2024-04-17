<?php

namespace Database\Seeders;

use App\Models\MSubKriteria;
use App\Models\Penilaian\SubKriteriaDirektur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // kriteriadirektur
        // kriteria 1
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Kualitas Kerja',
            'bobot_sub'=> 15,
            'pertanyaan'=>'Bekerja sesuai dengan Standar Prosedur Operasional (SPO)',
            'kriteria_id'=>1,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Kualitas Kerja',
            'bobot_sub'=> 5,
            'pertanyaan'=>'Mampu menyelesaikan tugas dengan tingkat akurasi 95%',
            'kriteria_id'=>1,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Kualitas Kerja',
            'bobot_sub'=> 5,
            'pertanyaan'=>'Mampu menyelesaikan tugas lebih cepat dari apa yang telah di tentukan',
            'kriteria_id'=>1,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Kualitas Kerja',
            'bobot_sub'=> 15,
            'pertanyaan'=>'Mampu memahami dan menerapkan prosedur kerja dengan baik',
            'kriteria_id'=>1,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Keahlian',
            'bobot_sub'=> 10,
            'pertanyaan'=>'Mampu mengatasi masalah dan kendala yang terjadi terkait dengan pekerjaan dengan menggunakan keterampilan yang dimiliki',
            'kriteria_id'=>1,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Keahlian',
            'bobot_sub'=> 10,
            'pertanyaan'=>'Menguasai Softskill dan Hardskill sesuai bidang yang ditekuni',
            'kriteria_id'=>1,
        ]);

        // kriteria 2
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Orientasi Pencapaian',
            'bobot_sub'=> 2,
            'pertanyaan'=>'Menunjukan keinginan untuk mencapai standar kerja yang telah ditetapkan.',
            'kriteria_id'=>2,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Orientasi Pencapaian',
            'bobot_sub'=> 4,
            'pertanyaan'=>'Mampu bekerja untuk mencapai atau melebihi standar kinerja yang ditetapkan oleh pihak manajemen.',
            'kriteria_id'=>2,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Orientasi Pencapaian',
            'bobot_sub'=> 3,
            'pertanyaan'=>'Segera dalam melakukan setiap pekerjaan yang diberikan.',
            'kriteria_id'=>2,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Kerjasama Tim',
            'bobot_sub'=> 3,
            'pertanyaan'=>'Meminta pendapat untuk mengambil keputusan',
            'kriteria_id'=>2,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Kerjasama Tim',
            'bobot_sub'=> 3,
            'pertanyaan'=>'Membangun hubungan interpersonal yang baik',
            'kriteria_id'=>2,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Komunikasi',
            'bobot_sub'=> 3,
            'pertanyaan'=>'Komunikasi yang baik dengan atasan',
            'kriteria_id'=>2,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Komunikasi',
            'bobot_sub'=> 2,
            'pertanyaan'=>'Menyampaikan informasi secara sistematis dan jelas kepada atasan',
            'kriteria_id'=>2,
        ]);


        // kriteria 3
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Disiplin Kerja',
            'bobot_sub'=> 10,
            'pertanyaan'=>'Presensi karyawan',
            'kriteria_id'=>3,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Disiplin Kerja',
            'bobot_sub'=> 3,
            'pertanyaan'=>'Karyawan mampu menyelesaikan pekerjaan dengan tepat waktu',
            'kriteria_id'=>3,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Inisiatif',
            'bobot_sub'=> 3,
            'pertanyaan'=>'Selalu berusaha meningkatkan kemampuan untuk memenuhi tuntutan pekerjaan tanpa adanya perintah dari atasan.',
            'kriteria_id'=>3,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Inisiatif',
            'bobot_sub'=> 2,
            'pertanyaan'=>'Memiliki perilaku yang baik sehingga dapat membawa pegaruh baik di lingkungan kerja.',
            'kriteria_id'=>3,
        ]);
        SubKriteriaDirektur::create([
            'nama_subkriteria'=>'Komitmen Organisasi',
            'bobot_sub'=> 2,
            'pertanyaan'=>'Rela Mengorbankan kepentingan diri sendiri untuk memenuhi kepentingan perusahaan.',
            'kriteria_id'=>3,
        ]);
    }
}
