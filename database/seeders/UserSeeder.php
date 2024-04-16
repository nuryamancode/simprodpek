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
        User::create(
            [
                'email' => "direktur@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'Direktur',
            ]
        );
        User::create(
            [
                'email' => "karyawan1@gmail.com",
                'email_verified_at'=>'2024-03-28 11:07:30',
                'password' => bcrypt('password'),
                'role' => 'Karyawan',
            ]
        );
        User::create(
            [
                'email' => "karyawan2@gmail.com",
                'email_verified_at'=>'2024-03-28 11:07:30',
                'password' => bcrypt('password'),
                'role' => 'Karyawan',
            ]
        );
        User::create(
            [
                'email' => "karyawan3@gmail.com",
                'email_verified_at'=>'2024-03-28 11:07:30',
                'password' => bcrypt('password'),
                'role' => 'Karyawan',
            ]
        );
        MHr::create(
            [
                'nama_lengkap' => 'Dadang HR',
                'user_id' => 1
            ]
        );
        MDirektur::create(
            [
                'nama_lengkap' => 'Usman Direktur',
                'user_id' => 2
            ]
        );
        MBidang::create([
            'nama_bidang'=>'Programmer',
        ]);
        MBidang::create([
            'nama_bidang'=>'Analyst',
        ]);
        MBidang::create([
            'nama_bidang'=>'Project Manager',
        ]);
        MKaryawan::create(
            [
                'nama_lengkap' => 'Karyawan 1',
                'user_id' => 3,
                'bidang_id' => 1,
            ]
        );
        MKaryawan::create(
            [
                'nama_lengkap' => 'Karyawan 2',
                'user_id' => 4,
                'bidang_id' =>2,
            ]
        );
        MKaryawan::create(
            [
                'nama_lengkap' => 'Karyawan 3',
                'user_id' => 5,
                'bidang_id' => 3,
            ]
        );
    }
}
