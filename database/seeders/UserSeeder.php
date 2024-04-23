<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\MBidang;
use App\Models\MDirektur;
use App\Models\MHr;
use App\Models\MKaryawan;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(
            [
                'email' => "human@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'Human Resource',
            ]
        );
        
        MHr::create(
            [
                'nama_lengkap' => 'Dadang HR',
                'user_id' => 1
            ]
        );
    }
}
