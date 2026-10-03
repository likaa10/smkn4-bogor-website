<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun ADMIN - password sendiri, khusus panel admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@smkn4bogor.sch.id',
            'password' => Hash::make('Admin#4Bogor2026'),
            'role' => 'admin',
        ]);

        // Akun USER biasa - password BEDA dari admin
        User::create([
            'name' => 'User Sekolah',
            'username' => 'user',
            'email' => 'user@smkn4bogor.sch.id',
            'password' => Hash::make('User#4Bogor2026'),
            'role' => 'user',
        ]);

        // Contoh data jurusan
        $majors = [
            ['name' => 'TO', 'tagline' => '"Drive Your Dream"'],
            ['name' => 'TPFL', 'tagline' => 'Teknik Pengolahan Farmasi & Logam'],
            ['name' => 'TJKT', 'tagline' => 'Teknik Jaringan Komputer & Telekomunikasi'],
            ['name' => 'PPLG', 'tagline' => 'Pengembangan Perangkat Lunak dan Gim'],
        ];

        foreach ($majors as $m) {
            Major::create([
                'name' => $m['name'],
                'slug' => str()->slug($m['name']),
                'tagline' => $m['tagline'],
                'description' => 'Deskripsi singkat mengenai jurusan '.$m['name'].' di SMKN 4 Kota Bogor.',
                'points' => [
                    'Dasar Pemrograman' => 'Mempelajari logika pemrograman serta membuat program menggunakan bahasa pemrograman.',
                ],
            ]);
        }
    }
}
