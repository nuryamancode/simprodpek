<?php

namespace Database\Seeders;

use App\Models\MKriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MKriteria::create([
            "nama_kriteria" => "Kompetensi Intelektual",
            "bobot_kriteria" => 40,
        ]);
        MKriteria::create([
            "nama_kriteria" => "Kompetensi Fisik",
            "bobot_kriteria" => 10,
        ]);
        MKriteria::create([
            "nama_kriteria" => "Kompetensi Pribadi",
            "bobot_kriteria" => 20,
        ]);
        MKriteria::create([
            "nama_kriteria" => "Kompetensi Sosial",
            "bobot_kriteria" => 10,
        ]);
        MKriteria::create([
            "nama_kriteria" => "Kompetensi Spritual",
            "bobot_kriteria" => 20,
        ]);
    }
}
