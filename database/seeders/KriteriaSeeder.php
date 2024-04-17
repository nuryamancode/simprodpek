<?php

namespace Database\Seeders;

use App\Models\MKriteria;
use App\Models\Penilaian\KriteriaDirektur;
use App\Models\Penilaian\KriteriaRekanKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // kriteria direktur
        KriteriaDirektur::create([
            'nama_kriteria'=>'Kompetensi Teknis',
            'bobot_kriteria'=>60,
        ]);
        KriteriaDirektur::create([
            'nama_kriteria'=>'Kompetensi Pribadi',
            'bobot_kriteria'=>20,
        ]);
        KriteriaDirektur::create([
            'nama_kriteria'=>'Kompetensi Komitmen dan Motivasi ',
            'bobot_kriteria'=>20,
        ]);


        // kriteria rekan kerja
        KriteriaRekanKerja::create([
            'nama_kriteria'=>'Kompetensi Teknis',
            'bobot_kriteria'=>40,
        ]);
        KriteriaRekanKerja::create([
            'nama_kriteria'=>'Kompetensi Pribadi',
            'bobot_kriteria'=>30,
        ]);
        KriteriaRekanKerja::create([
            'nama_kriteria'=>'Kompetensi Komitmen dan Motivasi ',
            'bobot_kriteria'=>30,
        ]);
    }
}
