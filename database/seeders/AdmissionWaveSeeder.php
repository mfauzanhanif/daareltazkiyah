<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AdmissionWave;
use Illuminate\Database\Seeder;

class AdmissionWaveSeeder extends Seeder
{
    public function run(): void
    {
        // Gelombang I (1 Oktober 2026 – 28 Februari 2027)
        AdmissionWave::updateOrCreate(
            ['slug' => 'gelombang-i-2027-2028'],
            [
                'name' => 'Gelombang I',
                'academic_year' => '2027/2028',
                'start_date' => '2026-10-01',
                'end_date' => '2027-02-28',
                'fee_mts' => 100000,
                'fee_mdta' => 25000,
                'max_quota_mts' => 50,
                'max_quota_mdta' => 30,
            ]
        );

        // Gelombang II (1 Maret 2027 – 30 Juni 2027)
        AdmissionWave::updateOrCreate(
            ['slug' => 'gelombang-ii-2027-2028'],
            [
                'name' => 'Gelombang II',
                'academic_year' => '2027/2028',
                'start_date' => '2027-03-01',
                'end_date' => '2027-06-30',
                'fee_mts' => 150000,
                'fee_mdta' => 30000,
                'max_quota_mts' => 30,
                'max_quota_mdta' => 20,
            ]
        );
    }
}
