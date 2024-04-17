<?php

namespace Database\Seeders;

use App\Models\Penilaian\SubKriteriaRekanKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKriteriaSeed2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // kriteria 1
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Kualitas Kerja',
            'bobot_sub'=> 10,
            'pertanyaan'=>'Bekerja sesuai dengan Standar Prosedur Operasional (SPO)',
            'kriteria_id'=>1,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Kualitas Kerja',
            'bobot_sub'=> 10,
            'pertanyaan'=>'Mampu memahami dan menerapkan prosedur kerja dengan baik',
            'kriteria_id'=>1,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Kualitas Kerja',
            'bobot_sub'=> 5,
            'pertanyaan'=>'Mampu menyelesaikan tugas dalam waktu yang telah ditentukan',
            'kriteria_id'=>1,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Keahlian',
            'bobot_sub'=> 10,
            'pertanyaan'=>'Menguasai Softskill dan Hardskill sesuai bidang yang ditekuni',
            'kriteria_id'=>1,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Keahlian',
            'bobot_sub'=> 5,
            'pertanyaan'=>'Dapat memberikan inovasi, sehingga dapat meningkatkan kinerja. Seperti menciptakan ide-ide baru.',
            'kriteria_id'=>1,
        ]);

        // kriteria 2
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Orientasi Pencapaian',
            'bobot_sub'=> 4,
            'pertanyaan'=>'Seberapa cepat dan tepat rekan kerja menyelesaikan tugas yang diberikan kepada mereka',
            'kriteria_id'=>2,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Orientasi Pencapaian',
            'bobot_sub'=> 4,
            'pertanyaan'=>'Seberapa cepat rekan kerja merespons permintaan atau tantangan pekerjaan yang muncul',
            'kriteria_id'=>2,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Kerjasama Tim',
            'bobot_sub'=> 4,
            'pertanyaan'=>'Selalu memberikan kontribusi dalam setiap pekerjaan didalam tim',
            'kriteria_id'=>2,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Kerjasama Tim',
            'bobot_sub'=> 3,
            'pertanyaan'=>'Membangun hubungan interpersonal yang baik ',
            'kriteria_id'=>2,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Kerjasama Tim',
            'bobot_sub'=> 3,
            'pertanyaan'=>'Kemampuan menyelesaikan konflik dalam tim',
            'kriteria_id'=>2,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Kerjasama Tim',
            'bobot_sub'=> 3,
            'pertanyaan'=>'Menghargai kontribusi rekan kerja yang memiliki performansi baik dengan memberikan semangat berupa pujian.',
            'kriteria_id'=>2,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Kerjasama Tim',
            'bobot_sub'=> 3,
            'pertanyaan'=>'Dapat memberikan pendapat untuk mengambil keputusan.',
            'kriteria_id'=>2,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Komunikasi',
            'bobot_sub'=> 2,
            'pertanyaan'=>'Komunikasi yang efektif dengan rekan kerja',
            'kriteria_id'=>2,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Komunikasi',
            'bobot_sub'=> 2,
            'pertanyaan'=>'Kemampuan mendengar dan memahami orang lain',
            'kriteria_id'=>2,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Komunikasi',
            'bobot_sub'=> 2,
            'pertanyaan'=>'Menyampaikan informasi dengan jelas dan efektif',
            'kriteria_id'=>2,
        ]);


        // kriteria 3
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Disiplin Kerja',
            'bobot_sub'=> 7,
            'pertanyaan'=>'Ketaatan pada peraturan dan kebijakan perusahaan',
            'kriteria_id'=>3,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Disiplin Kerja',
            'bobot_sub'=> 7,
            'pertanyaan'=>'Seberapa konsisten karyawan dapat menyelesaikan tugas-tugas dengan tepat waktu',
            'kriteria_id'=>3,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Inisiatif',
            'bobot_sub'=> 5,
            'pertanyaan'=>'Inisiatif dalam menyediakan ide-ide dalam menyelesaikan masalah meningkatkan produktivitas tim',
            'kriteria_id'=>3,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Inisiatif',
            'bobot_sub'=> 5,
            'pertanyaan'=>'Mengusulkan perubahan atau inovasi dalam sistem untuk mempemudah pekerjaan',
            'kriteria_id'=>3,
        ]);
        SubKriteriaRekanKerja::create([
            'nama_subkriteria'=>'Inisiatif',
            'bobot_sub'=> 6,
            'pertanyaan'=>'Membantu rekan kerja lain yang memiliki kendala',
            'kriteria_id'=>3,
        ]);
    }
}
