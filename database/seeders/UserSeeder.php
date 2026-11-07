<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Administrator (Akses Penuh Seluruh Modul)
        User::updateOrCreate(
            ['email' => 'admin@daareltazkiyah.sch.id'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password123'),
                'role' => UserRole::SuperAdmin,
                'email_verified_at' => now(),
            ]
        );

        // 2. Admin CMS & Humas (Pengelolaan Berita, Galeri & Konten Profil)
        User::updateOrCreate(
            ['email' => 'cms@daareltazkiyah.sch.id'],
            [
                'name' => 'Admin CMS & Humas',
                'password' => Hash::make('password123'),
                'role' => UserRole::AdminCms,
                'email_verified_at' => now(),
            ]
        );

        // 3. Panitia PSB / Admin TU (Pengelolaan Pendaftaran, Verifikasi & Rekap)
        User::updateOrCreate(
            ['email' => 'psb@daareltazkiyah.sch.id'],
            [
                'name' => 'Panitia PSB',
                'password' => Hash::make('password123'),
                'role' => UserRole::AdminPsb,
                'email_verified_at' => now(),
            ]
        );
    }
}

