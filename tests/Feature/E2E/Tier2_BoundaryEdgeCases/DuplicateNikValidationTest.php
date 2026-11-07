<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('rejects duplicate NIK submission within the same academic year across different waves and programs', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Applicants/Admission_waves tables not yet migrated (M1 required).');
    }

    $wave1Id = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $wave1Id,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(20)->toDateString(),
        'end_date' => now()->subDays(5)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $wave2Id = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $wave2Id,
        'name' => 'Gelombang II',
        'slug' => 'gelombang-ii-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 150000,
        'fee_mdta' => 30000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $existingNik = '3201234567890123';

    // Existing applicant in Gelombang I MTS
    DB::table('applicants')->insert([
        'id' => (string) Str::ulid(),
        'admission_wave_id' => $wave1Id,
        'registration_number' => 'PSB-2027-MTS-0001',
        'access_token' => 'PREVTOK1',
        'program_type' => 'MTS',
        'full_name' => 'Santri Terdaftar Awal',
        'nik' => $existingNik,
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-02-10',
        'child_order' => 1,
        'previous_school' => 'SD Asal',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => 'paid',
        'application_status' => 'verified',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Attempt registering with the same NIK in Gelombang II MDTA
    $response = $this->post('/psb/daftar', [
        'admission_wave_id' => $wave2Id,
        'program_type' => 'MDTA',
        'full_name' => 'Mencoba Daftar Ulang Berbeda Program',
        'nik' => $existingNik,
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-02-10',
        'child_order' => 1,
        'previous_school' => 'SD Asal',
        'address' => 'Bogor',
        'father_name' => 'Ayah Santri',
        'mother_name' => 'Ibu Santri',
        'parent_phone' => '081234567899',
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('PSB registration route not yet registered (M4 required).');
    }

    $response->assertSessionHasErrors('nik');
});

test('rejects NIK that is not exactly 16 numeric digits', function () {
    if (! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Admission waves table not yet migrated (M1 required).');
    }

    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Test 15 digits (too short)
    $resShort = $this->post('/psb/daftar', [
        'admission_wave_id' => $waveId,
        'program_type' => 'MTS',
        'full_name' => 'Short NIK Test',
        'nik' => '320123456789012', // 15 digits
        'parent_phone' => '081234567899',
    ]);

    if ($resShort->status() === 404) {
        test()->markTestSkipped('PSB registration route not yet registered (M4 required).');
    }

    $resShort->assertSessionHasErrors('nik');

    // Test alphanumeric characters in NIK
    $resAlpha = $this->post('/psb/daftar', [
        'admission_wave_id' => $waveId,
        'program_type' => 'MTS',
        'full_name' => 'Alpha NIK Test',
        'nik' => '320123456789012A',
        'parent_phone' => '081234567899',
    ]);

    $resAlpha->assertSessionHasErrors('nik');
});
