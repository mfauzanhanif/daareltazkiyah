<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AdmissionWave;
use Illuminate\Database\Seeder;

class AdmissionWaveSeeder extends Seeder
{
    public function run(): void
    {
        // Gelombang I (Currently active for TA 2027/2028)
        AdmissionWave::updateOrCreate(
            ['slug' => 'gelombang-i-2027-2028'],
            [
                'name' => 'Gelombang I',
                'academic_year' => '2027/2028',
                'start_date' => '2026-10-01',
                'end_date' => '2027-04-30',
                'fee_mts' => 350000,
                'fee_mdta' => 150000,
                'max_quota_mts' => 50,
                'max_quota_mdta' => 30,
            ]
        );

        // Gelombang II (Upcoming future wave)
        AdmissionWave::updateOrCreate(
            ['slug' => 'gelombang-ii-2027-2028'],
            [
                'name' => 'Gelombang II',
                'academic_year' => '2027/2028',
                'start_date' => '2027-05-01',
                'end_date' => '2027-07-31',
                'fee_mts' => 400000,
                'fee_mdta' => 175000,
                'max_quota_mts' => 30,
                'max_quota_mdta' => 20,
            ]
        );
    }
}
