<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'administrator',
                'description' => 'Mengelola seluruh sistem INVENTRA.',
            ],
            [
                'name' => 'PLP',
                'slug' => 'plp',
                'description' => 'Mengelola inventaris dan laboratorium.',
            ],
            [
                'name' => 'Kepala Jurusan',
                'slug' => 'kajur',
                'description' => 'Memantau inventaris pada jurusan.',
            ],
            [
                'name' => 'Asisten Laboratorium',
                'slug' => 'aslab',
                'description' => 'Membantu pengelolaan kegiatan laboratorium.',
            ],
            [
                'name' => 'Guru',
                'slug' => 'guru',
                'description' => 'Menggunakan fasilitas dan mengajukan peminjaman.',
            ],
            [
                'name' => 'Siswa',
                'slug' => 'siswa',
                'description' => 'Mengajukan peminjaman fasilitas sekolah.',
            ],
            [
                'name' => 'Karyawan',
                'slug' => 'karyawan',
                'description' => 'Menggunakan fasilitas sekolah.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => $role['slug']],
                [
                    'name' => $role['name'],
                    'description' => $role['description'],
                ]
            );
        }
    }
}