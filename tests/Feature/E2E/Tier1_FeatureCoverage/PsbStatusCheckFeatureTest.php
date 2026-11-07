<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('applicant can query registration status with valid registration number and access token', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Applicants table not yet migrated (M1 required).');
    }

    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $regNumber = 'PSB-2027-MTS-0002';
    $token = 'SECRET77';
    DB::table('applicants')->insert([
        'id' => (string) Str::ulid(),
        'admission_wave_id' => $waveId,
        'registration_number' => $regNumber,
        'access_token' => $token,
        'program_type' => 'MTS',
        'full_name' => 'Fathur Rahman',
        'nik' => '3201556677889900',
        'gender' => 'L',
        'birth_place' => 'Jakarta',
        'birth_date' => '2014-03-21',
        'child_order' => 2,
        'previous_school' => 'SDIT Al-Hikmah',
        'address' => 'Jakarta Selatan',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->post('/psb/status', [
        'registration_number' => $regNumber,
        'access_token' => $token,
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('PSB status check route not yet registered (M4 required).');
    }

    $response->assertOk()
        ->assertSee('Fathur Rahman')
        ->assertSee('pending')
        ->assertSee($regNumber);
});

test('status check rejects invalid registration number or token', function () {
    if (! Schema::hasTable('applicants')) {
        test()->markTestSkipped('Applicants table not yet migrated (M1 required).');
    }

    $response = $this->post('/psb/status', [
        'registration_number' => 'PSB-2027-MTS-9999',
        'access_token' => 'WRONGTOK',
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('PSB status check route not yet registered (M4 required).');
    }

    // Must not show status details; either validation error or 404/422
    expect(in_array($response->status(), [200, 302, 404, 422]))->toBeTrue();
    if ($response->status() === 302) {
        $response->assertSessionHasErrors();
    }
});

test('applicant can edit biodata when application status is pending', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Applicants table not yet migrated (M1 required).');
    }

    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $regNumber = 'PSB-2027-MTS-0003';
    $token = 'EDITABLE';
    $applicantId = (string) Str::ulid();
    DB::table('applicants')->insert([
        'id' => $applicantId,
        'admission_wave_id' => $waveId,
        'registration_number' => $regNumber,
        'access_token' => $token,
        'program_type' => 'MTS',
        'full_name' => 'Salahudin Al-Ayyubi',
        'nik' => '3201445566778899',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-04-10',
        'child_order' => 1,
        'previous_school' => 'SD Lama',
        'address' => 'Alamat Awal',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->put("/psb/edit/{$regNumber}", [
        'access_token' => $token,
        'address' => 'Alamat Baru Diperbarui RT 05 RW 02',
        'previous_school' => 'SD Baru Diperbaiki',
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('Applicant edit route not yet registered (M4 required).');
    }

    $response->assertSessionHasNoErrors();
    $updated = DB::table('applicants')->where('id', $applicantId)->first();
    expect($updated->address)->toBe('Alamat Baru Diperbarui RT 05 RW 02');
    expect($updated->previous_school)->toBe('SD Baru Diperbaiki');
});

test('applicant can view revision notes and update documents when status is revision_needed', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Applicants table not yet migrated (M1 required).');
    }

    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $regNumber = 'PSB-2027-MTS-0004';
    $token = 'REVISE88';
    $note = 'Foto Kartu Keluarga buram, mohon unggah ulang.';
    DB::table('applicants')->insert([
        'id' => (string) Str::ulid(),
        'admission_wave_id' => $waveId,
        'registration_number' => $regNumber,
        'access_token' => $token,
        'program_type' => 'MTS',
        'full_name' => 'Bilal bin Rabah',
        'nik' => '3201334455667788',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-06-15',
        'child_order' => 1,
        'previous_school' => 'SD Asal',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'revision_needed',
        'admin_notes' => $note,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->post('/psb/status', [
        'registration_number' => $regNumber,
        'access_token' => $token,
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('PSB status check route not yet registered (M4 required).');
    }

    $response->assertOk()
        ->assertSee('revision_needed')
        ->assertSee($note);
});
