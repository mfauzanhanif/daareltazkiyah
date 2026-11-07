<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@daareltazkiyah.sch.id'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password123'),
                'role' => UserRole::SuperAdmin,
                'email_verified_at' => now(),
            ]
        );

        // Seed additional admin accounts for CMS & PSB testing
        User::updateOrCreate(
            ['email' => 'cms@daareltazkiyah.sch.id'],
            [
                'name' => 'Admin CMS & Humas',
                'password' => Hash::make('password123'),
                'role' => UserRole::AdminCms,
                'email_verified_at' => now(),
            ]
        );

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
