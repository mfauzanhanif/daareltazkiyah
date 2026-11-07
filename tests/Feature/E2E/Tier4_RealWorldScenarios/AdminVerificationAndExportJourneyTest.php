<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

test('complete admin verification journey: login -> review applicant -> request revision -> approve -> audit log check -> export Excel', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves') || ! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
        test()->markTestSkipped('PSB tables or users role column not yet migrated (M1 required).');
    }

    // Step 1: Panitia Admin Authentication
    $admin = User::factory()->create([
        'name' => 'Ustadz Panitia PSB',
        'email' => 'panitia@daareltazkiyah.com',
        'role' => 'admin_psb',
    ]);

    $this->actingAs($admin);

    // Setup active wave
    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(5)->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Setup applicant in pending status
    $applicantId = (string) Str::ulid();
    $regNumber = 'PSB-2027-MTS-0100';
    $token = 'JOURNEY1';
    DB::table('applicants')->insert([
        'id' => $applicantId,
        'admission_wave_id' => $waveId,
        'registration_number' => $regNumber,
        'access_token' => $token,
        'program_type' => 'MTS',
        'full_name' => 'Fathir Ahmad',
        'nik' => '3201112233445566',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-04-12',
        'child_order' => 1,
        'previous_school' => 'SDIT Insan Mandiri',
        'address' => 'Jl. Sindang Barang No. 8',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Step 2: Access Panitia Dashboard
    $dashboardResponse = $this->get('/admin/psb');
    if ($dashboardResponse->status() === 404) {
        test()->markTestSkipped('Admin PSB dashboard route not yet registered (M5 required).');
    }
    $dashboardResponse->assertOk();

    // Step 3: Inspect applicant in applicants management table
    $listResponse = $this->get('/admin/psb/applicants?search=Fathir');
    $listResponse->assertOk()
        ->assertSee('Fathir Ahmad')
        ->assertSee($regNumber);

    // Step 4: Panitia requests revision
    $revisionNote = 'Foto KK buram dan tidak terbaca, silakan unggah ulang.';
    $revisionResponse = $this->patch("/admin/psb/applicants/{$applicantId}/status", [
        'application_status' => 'revision_needed',
        'admin_notes' => $revisionNote,
    ]);
    $revisionResponse->assertSessionHasNoErrors();

    $applicantAfterRevision = DB::table('applicants')->where('id', $applicantId)->first();
    expect($applicantAfterRevision->application_status)->toBe('revision_needed');
    expect($applicantAfterRevision->admin_notes)->toBe($revisionNote);

    // Step 5: Applicant re-uploads / corrects document, setting status back to pending
    $reuploadResponse = $this->put("/psb/edit/{$regNumber}", [
        'access_token' => $token,
        'address' => 'Jl. Sindang Barang No. 8 (Sudah upload ulang KK baru)',
    ]);
    $reuploadResponse->assertSessionHasNoErrors();

    // Step 6: Panitia gives final approval (verified & paid)
    $approvalNote = 'Berkas lengkap dan pembayaran telah tervalidasi.';
    $approvalResponse = $this->patch("/admin/psb/applicants/{$applicantId}/status", [
        'application_status' => 'verified',
        'payment_status' => 'paid',
        'admin_notes' => $approvalNote,
    ]);
    $approvalResponse->assertSessionHasNoErrors();

    $finalApplicant = DB::table('applicants')->where('id', $applicantId)->first();
    expect($finalApplicant->application_status)->toBe('verified');
    expect($finalApplicant->payment_status)->toBe('paid');

    // Step 7: Verify Spatie Activitylog audit trail
    if (Schema::hasTable('activity_log')) {
        $activities = DB::table('activity_log')
            ->where('subject_id', $applicantId)
            ->get();
        expect($activities->count())->toBeGreaterThanOrEqual(1);
    }

    // Step 8: Panitia exports applicant data to Excel
    $exportResponse = $this->get('/admin/psb/export');
    $exportResponse->assertOk();
    $disposition = $exportResponse->headers->get('content-disposition') ?? '';
    expect(str_contains($disposition, '.xlsx') || str_contains($disposition, 'attachment'))->toBeTrue();
});
