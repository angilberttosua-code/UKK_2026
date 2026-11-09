<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@sekolah.test', 'password' => 'admin123', 'role' => 'admin']);
        User::create(['name' => 'Dimas', 'email' => 'siswa@sekolah.test', 'password' => '123456', 'role' => 'siswa', 'nis' => '12345', 'kelas' => 'XII RPL 1']);
    
        foreach(['Ruang Kelas', 'Toilet', 'Laboratorium', 'Lapangan'] as $nama){
            Category::create(['nama'=>$nama]);
        }
    }
}
