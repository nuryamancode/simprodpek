<?php

namespace Database\Seeders;

use App\Models\Penilaian\JenisPenilaian;
use App\Models\Penilaian\Penilai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisPenilaian::create([
            'nama_penilai'=> 'Rekan Kerja',
            'nilai_bobot'=> '40',
        ]);
        JenisPenilaian::create([
            'nama_penilai'=> 'Direktur',
            'nilai_bobot'=> '60',
        ]);
        Penilai::create([
            'periode'=> '2024',
            'jenis_dinilai'=> 'Karyawan To Rekan Kerja',
            'jenis_penilai_id'=> 1,
            'status_penilaian'=> 'Belum Dinilai',
        ]);
        Penilai::create([
            'periode'=> '2024',
            'jenis_dinilai'=> 'Direktur To Karyawan',
            'jenis_penilai_id'=> 2,
            'status_penilaian'=> 'Belum Dinilai',
        ]);
    }
}
