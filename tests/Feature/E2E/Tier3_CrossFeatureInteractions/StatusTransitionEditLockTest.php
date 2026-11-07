<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('applicant edit is permitted in pending state but locked after admin transitions to verified', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Applicants/Admission_waves tables not yet migrated (M1 required).');
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

    $regNumber = 'PSB-2027-MTS-0099';
    $token = 'LOCKTEST';
    $applicantId = (string) Str::ulid();

    // 1. Initially created with application_status = 'pending'
    DB::table('applicants')->insert([
        'id' => $applicantId,
        'admission_wave_id' => $waveId,
        'registration_number' => $regNumber,
        'access_token' => $token,
        'program_type' => 'MTS',
        'full_name' => 'Usamah bin Zaid',
        'nik' => '3201123412341234',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-07-07',
        'child_order' => 1,
        'previous_school' => 'SD Asal',
        'address' => 'Alamat Asli Sebelum Edit',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // 2. While pending, update is permitted
    $pendingEditResponse = $this->put("/psb/edit/{$regNumber}", [
        'access_token' => $token,
        'address' => 'Alamat Berhasil Diubah Saat Pending',
    ]);

    if ($pendingEditResponse->status() === 404) {
        test()->markTestSkipped('Applicant edit route not yet registered (M4 required).');
    }

    $pendingEditResponse->assertSessionHasNoErrors();
    $applicantPending = DB::table('applicants')->where('id', $applicantId)->first();
    expect($applicantPending->address)->toBe('Alamat Berhasil Diubah Saat Pending');

    // 3. Panitia transitions status to 'verified'
    DB::table('applicants')->where('id', $applicantId)->update([
        'application_status' => 'verified',
        'payment_status' => 'paid',
        'updated_at' => now(),
    ]);

    // 4. While verified, applicant attempt to edit MUST be rejected
    $lockedEditResponse = $this->put("/psb/edit/{$regNumber}", [
        'access_token' => $token,
        'address' => 'Mencoba Mengubah Saat Sudah Diverifikasi',
    ]);

    // System must reject modification: 403 Forbidden, 422 Unprocessable, or redirect with error
    expect(in_array($lockedEditResponse->status(), [302, 403, 422]))->toBeTrue();
    if ($lockedEditResponse->status() === 302) {
        $lockedEditResponse->assertSessionHasErrors();
    }

    // Verify address did NOT change
    $applicantVerified = DB::table('applicants')->where('id', $applicantId)->first();
    expect($applicantVerified->address)->toBe('Alamat Berhasil Diubah Saat Pending');
});
