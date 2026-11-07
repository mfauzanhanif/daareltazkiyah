<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('updating applicant status generates Spatie Activitylog audit trail with causer and notes', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves') || ! Schema::hasTable('activity_log') || ! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
        test()->markTestSkipped('Applicants/Activity_log/Users tables not yet migrated (M1 required).');
    }

    $admin = createUser([
        'role' => 'admin_psb',
    ]);

    $this->actingAs($admin);

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

    $applicantId = (string) Str::ulid();
    DB::table('applicants')->insert([
        'id' => $applicantId,
        'admission_wave_id' => $waveId,
        'registration_number' => 'PSB-2027-MTS-0050',
        'access_token' => 'AUDITLOG',
        'program_type' => 'MTS',
        'full_name' => 'Thalhah bin Ubaidillah',
        'nik' => '3201998877661122',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-08-08',
        'child_order' => 1,
        'previous_school' => 'SD Asal',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $note = 'Dokumen persyaratan lengkap dan biaya pendaftaran telah diverifikasi.';
    $response = $this->patch("/admin/psb/applicants/{$applicantId}/status", [
        'application_status' => 'verified',
        'payment_status' => 'paid',
        'admin_notes' => $note,
    ]);

    if ($response->status() === 404) {
        test()->markTestSkipped('Applicant status update route not yet registered (M5 required).');
    }

    $response->assertSessionHasNoErrors();

    // Verify Spatie activity_log entry
    $activity = DB::table('activity_log')
        ->where('subject_id', $applicantId)
        ->latest('id')
        ->first();

    expect($activity)->not->toBeNull();
    expect((string) $activity->causer_id)->toBe((string) $admin->id);

    $properties = (string) $activity->properties;
    expect(str_contains($properties, 'verified') || str_contains($properties, $note))->toBeTrue();
});
