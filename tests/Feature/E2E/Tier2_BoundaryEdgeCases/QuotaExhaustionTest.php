<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('rejects registration when program quota in active wave is exhausted', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Applicants/Admission_waves tables not yet migrated (M1 required).');
    }

    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I Terbatas',
        'slug' => 'gelombang-i-terbatas',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 1, // Only 1 slot
        'max_quota_mdta' => 10,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Fill the 1 slot for MTS
    DB::table('applicants')->insert([
        'id' => (string) Str::ulid(),
        'admission_wave_id' => $waveId,
        'registration_number' => 'PSB-2027-MTS-0001',
        'access_token' => 'SLOTFULL',
        'program_type' => 'MTS',
        'full_name' => 'Santri Pengisi Kuota',
        'nik' => '3201111111111111',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD Asal',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Second applicant tries to register for MTS
    $responseMts = $this->post('/psb/daftar', [
        'admission_wave_id' => $waveId,
        'program_type' => 'MTS',
        'full_name' => 'Santri Kelebihan Kuota',
        'nik' => '3201222222222222',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-02-02',
        'child_order' => 1,
        'previous_school' => 'SD Asal',
        'address' => 'Bogor',
        'parent_phone' => '081234567890',
    ]);

    if ($responseMts->status() === 404) {
        test()->markTestSkipped('PSB registration route not yet registered (M4 required).');
    }

    // Must be rejected due to quota limit
    expect(in_array($responseMts->status(), [302, 422]))->toBeTrue();
    if ($responseMts->status() === 302) {
        $responseMts->assertSessionHasErrors();
    }
});
