<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Lomba;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswaData = [
            [
                'nim_nip' => '36245578001',
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@mahasiswa.ac.id',
                'password' => Hash::make('pass100'),
                'status_akun' => 'Aktif',
                'role' => 'mahasiswa',
            ],
            [
                'nim_nip' => '36245578002',
                'name' => 'Siti Aminah',
                'email' => 'siti.aminah@mahasiswa.ac.id',
                'password' => Hash::make('pass101'),
                'status_akun' => 'Aktif',
                'role' => 'mahasiswa',
            ],
            [
                'nim_nip' => '36245578003',
                'name' => 'Ahmad Rian',
                'email' => 'ahmad.rian@mahasiswa.ac.id',
                'password' => Hash::make('pass102'),
                'status_akun' => 'Non-Aktif',
                'role' => 'mahasiswa',
            ],
            [
                'nim_nip' => '19800101',
                'name' => 'Bapak Koor',
                'email' => 'koor@kampus.ac.id',
                'password' => Hash::make('password'),
                'status_akun' => 'Aktif',
                'role' => 'koor_kaprodi',
            ],
            [
                'nim_nip' => '19900101',
                'name' => 'Ibu Staf',
                'email' => 'staf@staf.ac.id',
                'password' => Hash::make('password'),
                'status_akun' => 'Aktif',
                'role' => 'staf',
            ]
        ];

        foreach ($mahasiswaData as $data) {
            User::create($data);
        }

        Lomba::create([
            'nama_lomba' => 'Olimpiade Matematika',
            'deskripsi' => 'Lomba matematika tingkat nasional.',
        ]);
        Lomba::create([
            'nama_lomba' => 'Hackathon 2026',
            'deskripsi' => 'Lomba programming dan pembuatan aplikasi.',
        ]);
    }
}
