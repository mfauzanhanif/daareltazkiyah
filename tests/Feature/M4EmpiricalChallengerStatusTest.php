<?php

declare(strict_types=1);

use App\Enums\ApplicationStatus;
use App\Livewire\Public\PsbCheckStatus;
use App\Models\AdmissionWave;
use App\Models\Applicant;
use App\Models\ApplicantDocument;
use App\Models\ApplicantParent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Spatie\Activitylog\Models\Activity;

/**
 * Helper to create an active admission wave for testing.
 */
function createActiveAdmissionWave(): AdmissionWave
{
    return AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'quota_mts' => 100,
        'quota_mdta' => 50,
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'is_active' => true,
    ]);
}

/**
 * Helper to create an applicant record.
 */
function createApplicant(
    AdmissionWave $wave,
    string $regNumber = 'PSB-2027-MTS-0001',
    string $token = 'SEC12345',
    ApplicationStatus $status = ApplicationStatus::Pending,
    ?string $notes = null,
    ?string $nik = null
): Applicant {
    static $counter = 1000;
    $counter++;
    $uniqueNik = $nik ?? sprintf('3201998877%06d', $counter);

    $applicant = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => $regNumber,
        'access_token' => $token,
        'program_type' => 'MTS',
        'full_name' => 'Ahmad Dahlan '.$counter,
        'nik' => $uniqueNik,
        'gender' => 'L',
        'birth_place' => 'Yogyakarta',
        'birth_date' => '2014-08-01',
        'child_order' => 1,
        'previous_school' => 'SDIT Al-Ihsan',
        'address' => 'Jl. Kaliurang KM 5',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => $status,
        'admin_notes' => $notes,
    ]);

    ApplicantParent::create([
        'applicant_id' => $applicant->id,
        'father_name' => 'Dahlan',
        'mother_name' => 'Siti',
        'parent_phone' => '081234567890',
        'parent_address' => 'Jl. Kaliurang KM 5',
    ]);

    return $applicant;
}

/*
|--------------------------------------------------------------------------
| Challenge 1: Status Check Rate Limiting & Brute Force Protection
|--------------------------------------------------------------------------
*/

test('status check endpoint throttles after 10 requests within 60 seconds returning HTTP 429', function () {
    RateLimiter::clear('psb-status-check:127.0.0.1');

    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0010', 'TOKEN010');

    // First 10 requests must be allowed through to the controller
    for ($i = 1; $i <= 10; $i++) {
        $response = $this->post('/psb/status', [
            'registration_number' => $applicant->registration_number,
            'access_token' => 'WRONGTOKEN'.$i,
        ]);

        // Each failed credential attempt redirects back with validation error (302)
        expect($response->status())->toBe(302);
    }

    // The 11th request must be throttled with HTTP 429 Too Many Requests
    $throttledResponse = $this->post('/psb/status', [
        'registration_number' => $applicant->registration_number,
        'access_token' => 'WRONGTOKEN11',
    ]);

    $throttledResponse->assertStatus(429);
});

test('livewire status check component throttles after 10 attempts', function () {
    RateLimiter::clear('psb-status-check:127.0.0.1');

    $component = Livewire::test(PsbCheckStatus::class);

    // Perform 10 failed searches
    for ($i = 1; $i <= 10; $i++) {
        $component->set('registration_number', 'PSB-2027-MTS-9999')
            ->set('access_token', 'FAILTOK'.$i)
            ->call('checkStatus')
            ->assertHasErrors(['registration_number' => 'Nomor registrasi atau token akses tidak valid.']);
    }

    // 11th attempt must trigger rate limiter message
    $component->set('registration_number', 'PSB-2027-MTS-9999')
        ->set('access_token', 'FAILTOK11')
        ->call('checkStatus');

    $errors = $component->errors()->get('registration_number');
    expect($errors)->not->toBeEmpty();
    expect(implode(' ', $errors))->toContain('Terlalu banyak percobaan');
});

/*
|--------------------------------------------------------------------------
| Challenge 2: Edit Lockout on Verified, Accepted, and Rejected Applicants
|--------------------------------------------------------------------------
*/

test('editing applicant with verified status returns HTTP 403 Forbidden and keeps data unmodified', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0021', 'VERIFIEDOK', ApplicationStatus::Verified);

    $originalAddress = $applicant->address;

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'address' => 'Hacker Alamat Baru',
        'previous_school' => 'Sekolah Diubah Saat Verified',
    ]);

    $response->assertForbidden();

    $applicant->refresh();
    expect($applicant->address)->toBe($originalAddress);
    expect($applicant->previous_school)->toBe('SDIT Al-Ihsan');
});

test('editing applicant with accepted status returns HTTP 403 Forbidden and keeps data unmodified', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0022', 'ACCEPTEDOK', ApplicationStatus::Accepted);

    $originalAddress = $applicant->address;

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'address' => 'Alamat Ditolak Karena Diterima',
    ]);

    $response->assertForbidden();

    $applicant->refresh();
    expect($applicant->address)->toBe($originalAddress);
});

test('editing applicant with rejected status returns HTTP 403 Forbidden and keeps data unmodified', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0023', 'REJECTEDOK', ApplicationStatus::Rejected);

    $originalAddress = $applicant->address;

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'address' => 'Alamat Ditolak Karena Ditolak',
    ]);

    $response->assertForbidden();

    $applicant->refresh();
    expect($applicant->address)->toBe($originalAddress);
});

test('editing applicant with reserve status returns HTTP 403 Forbidden', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0024', 'RESERVETOK', ApplicationStatus::Reserve);

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'address' => 'Alamat Cadangan',
    ]);

    $response->assertForbidden();
});

test('livewire status component blocks saveChanges when applicant status is locked', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0025', 'LWLOCKTEST', ApplicationStatus::Verified);

    Livewire::test(PsbCheckStatus::class, ['reg' => $applicant->registration_number, 'token' => $applicant->access_token])
        ->set('address', 'Alamat Diubah Lewat Livewire Saat Verified')
        ->call('saveChanges')
        ->assertHasErrors(['edit_error' => 'Data pendaftaran sudah dikunci dan tidak dapat diubah.']);

    $applicant->refresh();
    expect($applicant->address)->not->toBe('Alamat Diubah Lewat Livewire Saat Verified');
});

/*
|--------------------------------------------------------------------------
| Challenge 3: Status Transition from revision_needed to pending with Activity Log
|--------------------------------------------------------------------------
*/

test('editing applicant in revision_needed transitions status to pending and writes activity log via HTTP', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant(
        $wave,
        'PSB-2027-MTS-0030',
        'REVTRANS01',
        ApplicationStatus::RevisionNeeded,
        'Mohon perbaiki KK yang buram.'
    );

    expect($applicant->application_status)->toBe(ApplicationStatus::RevisionNeeded);

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'address' => 'Jl. Kaliurang KM 8 RT 02 RW 05',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Data pendaftaran berhasil diperbarui.');

    $applicant->refresh();
    expect($applicant->application_status)->toBe(ApplicationStatus::Pending);
    expect($applicant->address)->toBe('Jl. Kaliurang KM 8 RT 02 RW 05');

    // Assert Spatie activity log was written
    $activity = Activity::where('log_name', 'psb_applicant')
        ->where('subject_type', Applicant::class)
        ->where('subject_id', $applicant->id)
        ->latest('id')
        ->first();

    expect($activity)->not->toBeNull();
    expect($activity->description)->toContain($applicant->registration_number);
    expect($activity->description)->toContain('kembali ke pending');
});

test('editing applicant in revision_needed transitions status to pending via Livewire', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant(
        $wave,
        'PSB-2027-MTS-0031',
        'REVTRANS02',
        ApplicationStatus::RevisionNeeded,
        'Foto akta kurang jelas.'
    );

    Livewire::test(PsbCheckStatus::class, ['reg' => $applicant->registration_number, 'token' => $applicant->access_token])
        ->set('address', 'Alamat Baru Via Livewire Transition')
        ->call('saveChanges')
        ->assertHasNoErrors();

    $applicant->refresh();
    expect($applicant->application_status)->toBe(ApplicationStatus::Pending);

    // Verify activity log from Livewire
    $activity = Activity::where('log_name', 'psb_applicant')
        ->where('subject_type', Applicant::class)
        ->where('subject_id', $applicant->id)
        ->latest('id')
        ->first();

    expect($activity)->not->toBeNull();
    expect($activity->description)->toContain('layanan mandiri');
    expect($activity->description)->toContain('kembali ke pending');
});

test('editing applicant already in pending keeps status as pending without revision log', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0032', 'PENDTRANS', ApplicationStatus::Pending);

    $initialLogCount = Activity::where('subject_type', Applicant::class)
        ->where('subject_id', $applicant->id)
        ->count();

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'address' => 'Perubahan Normal Saat Pending',
    ]);

    $response->assertRedirect();
    $applicant->refresh();
    expect($applicant->application_status)->toBe(ApplicationStatus::Pending);
});

/*
|--------------------------------------------------------------------------
| Challenge 4: Document Re-Upload Validation (MIME & Size Restrictions)
|--------------------------------------------------------------------------
*/

test('document re-upload rejects files exceeding 2048KB', function () {
    Storage::fake('private');

    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0040', 'DOCLIMITS01', ApplicationStatus::RevisionNeeded);

    // 2500 KB file (> 2048 KB limit)
    $oversizedFile = UploadedFile::fake()->create('dokumen_raksasa.pdf', 2500, 'application/pdf');

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'document_kk' => $oversizedFile,
    ]);

    $response->assertSessionHasErrors('document_kk');
});

test('document photo rejects non-image formats including PDF and scripts', function () {
    Storage::fake('private');

    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0041', 'DOCPHOTO01', ApplicationStatus::RevisionNeeded);

    // Test 1: PDF masquerading as photo (only jpg, jpeg, png allowed)
    $pdfAsPhoto = UploadedFile::fake()->create('foto_santri.pdf', 500, 'application/pdf');
    $res1 = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'document_photo' => $pdfAsPhoto,
    ]);
    $res1->assertSessionHasErrors('document_photo');

    // Test 2: Executable file masquerading as photo
    $exeAsPhoto = UploadedFile::fake()->create('foto_malicious.exe', 100, 'application/x-msdownload');
    $res2 = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'document_photo' => $exeAsPhoto,
    ]);
    $res2->assertSessionHasErrors('document_photo');

    // Test 3: Text file
    $txtAsPhoto = UploadedFile::fake()->create('catatan.txt', 50, 'text/plain');
    $res3 = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'document_photo' => $txtAsPhoto,
    ]);
    $res3->assertSessionHasErrors('document_photo');
});

test('document kk rejects disallowed formats like exe and zip', function () {
    Storage::fake('private');

    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0042', 'DOCKK01', ApplicationStatus::RevisionNeeded);

    $badFile = UploadedFile::fake()->create('virus.exe', 100, 'application/x-msdownload');

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'document_kk' => $badFile,
    ]);

    $response->assertSessionHasErrors('document_kk');
});

test('document re-upload with valid image or PDF succeeds and replaces document record', function () {
    Storage::fake('private');

    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0043', 'DOCVALID01', ApplicationStatus::RevisionNeeded);

    $validKk = UploadedFile::fake()->create('kk_terbaru.pdf', 1024, 'application/pdf');

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'document_kk' => $validKk,
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect();

    $doc = ApplicantDocument::where('applicant_id', $applicant->id)
        ->where('document_type', 'kk')
        ->first();

    expect($doc)->not->toBeNull();
    expect($doc->original_name)->toBe('kk_terbaru.pdf');
    Storage::disk('private')->assertExists($doc->file_path);
});

/*
|--------------------------------------------------------------------------
| Challenge 5: Cross-Applicant Data Isolation
|--------------------------------------------------------------------------
*/

test('status check rejects query using applicant B registration number with applicant A access token', function () {
    $wave = createActiveAdmissionWave();
    $applicantA = createApplicant($wave, 'PSB-2027-MTS-0051', 'TOKEN_AAA');
    $applicantB = createApplicant($wave, 'PSB-2027-MTS-0052', 'TOKEN_BBB');

    // Attempt to access Applicant B's data using Applicant A's token
    $response = $this->post('/psb/status', [
        'registration_number' => $applicantB->registration_number,
        'access_token' => $applicantA->access_token, // Mismatched token!
    ]);

    // Must be rejected with validation error, never revealing applicant B's record
    $response->assertSessionHasErrors('registration_number');
    $response->assertDontSee($applicantB->full_name);
    $response->assertDontSee($applicantB->nik);
});

test('edit endpoint returns HTTP 403 Forbidden when attempting to update applicant B using applicant A access token', function () {
    $wave = createActiveAdmissionWave();
    $applicantA = createApplicant($wave, 'PSB-2027-MTS-0053', 'TOKEN_AAA');
    $applicantB = createApplicant($wave, 'PSB-2027-MTS-0054', 'TOKEN_BBB');

    $originalAddressB = $applicantB->address;

    // Attacker tries to modify Applicant B using Applicant A's token
    $response = $this->put("/psb/edit/{$applicantB->registration_number}", [
        'access_token' => $applicantA->access_token,
        'address' => 'ALAMAT DIBAJAK OLEH A',
    ]);

    $response->assertForbidden();

    // Verify Applicant B remains completely unmodified
    $applicantB->refresh();
    expect($applicantB->address)->toBe($originalAddressB);

    // Verify Applicant A remains completely unmodified
    $applicantA->refresh();
    expect($applicantA->address)->not->toBe('ALAMAT DIBAJAK OLEH A');
});

test('edit endpoint returns HTTP 403 Forbidden with forged access token', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0055', 'REALTHING');

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => 'FORGED_TOKEN',
        'address' => 'Data Dicoba Diubah Dengan Token Palsu',
    ]);

    $response->assertForbidden();
});

test('livewire status component blocks cross-applicant access', function () {
    $wave = createActiveAdmissionWave();
    $applicantA = createApplicant($wave, 'PSB-2027-MTS-0056', 'TOK_LIVE_A');
    $applicantB = createApplicant($wave, 'PSB-2027-MTS-0057', 'TOK_LIVE_B');

    Livewire::test(PsbCheckStatus::class)
        ->set('registration_number', $applicantB->registration_number)
        ->set('access_token', $applicantA->access_token)
        ->call('checkStatus')
        ->assertHasErrors(['registration_number' => 'Nomor registrasi atau token akses tidak valid.'])
        ->assertDontSee($applicantB->full_name);
});

/*
|--------------------------------------------------------------------------
| Additional Adversarial Stress Tests: Injection, Escalation, Boundaries & Soft Deletes
|--------------------------------------------------------------------------
*/

test('applicant cannot escalate privileges or alter immutable fields like application_status or payment_status during edit', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0060', 'ESCALATETEST', ApplicationStatus::Pending);

    $originalNik = $applicant->nik;
    $originalRegNumber = $applicant->registration_number;

    $response = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'application_status' => 'accepted', // Attempted privilege escalation
        'payment_status' => 'paid',          // Attempted payment bypass
        'registration_number' => 'PSB-2027-MTS-0000',
        'nik' => '3201000000000000',
        'address' => 'Alamat Valid Baru',
    ]);

    $response->assertRedirect();
    $applicant->refresh();

    // Valid field was updated
    expect($applicant->address)->toBe('Alamat Valid Baru');

    // Immutable/protected fields remained unchanged
    expect($applicant->application_status)->toBe(ApplicationStatus::Pending);
    expect($applicant->payment_status->value)->toBe('pending_verification');
    expect($applicant->registration_number)->toBe($originalRegNumber);
    expect($applicant->nik)->toBe($originalNik);
});

test('status check input trimming handles leading and trailing whitespaces gracefully', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0061', 'TRIMMEDOK');

    $response = $this->post('/psb/status', [
        'registration_number' => "  {$applicant->registration_number}  \n",
        'access_token' => "  {$applicant->access_token}  ",
    ]);

    $response->assertOk()
        ->assertSee($applicant->full_name)
        ->assertSee($applicant->registration_number);
});

test('status check withstands adversarial SQL injection and XSS input vectors safely without leaking data', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0062', 'SECURETOK');

    $adversarialInputs = [
        "' OR '1'='1",
        "'; DROP TABLE applicants; --",
        "PSB-2027-MTS-0062' UNION SELECT * FROM applicants --",
        '<script>alert("xss")</script>',
        '${7*7}',
        '" OR ""="',
    ];

    foreach ($adversarialInputs as $input) {
        $response = $this->post('/psb/status', [
            'registration_number' => $input,
            'access_token' => 'SECURETOK',
        ]);

        // Must redirect with validation error, never returning 200 or leaking applicant data
        expect($response->status())->toBe(302);
        $response->assertSessionHasErrors();
        $response->assertDontSee($applicant->full_name);
    }
});

test('exact file size boundary: 2048KB document passes while 2049KB is strictly rejected', function () {
    Storage::fake('private');

    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0063', 'BOUNDARYTOK', ApplicationStatus::RevisionNeeded);

    // 1. Boundary: 2048 KB (allowed)
    $file2048 = UploadedFile::fake()->create('boundary_pass.pdf', 2048, 'application/pdf');
    $resPass = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'document_kk' => $file2048,
    ]);
    $resPass->assertSessionHasNoErrors();

    // 2. Boundary: 2049 KB (rejected)
    $file2049 = UploadedFile::fake()->create('boundary_fail.pdf', 2049, 'application/pdf');
    $resFail = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'document_kk' => $file2049,
    ]);
    $resFail->assertSessionHasErrors('document_kk');
});

test('soft deleted applicant cannot be queried via status check or updated via edit endpoint', function () {
    $wave = createActiveAdmissionWave();
    $applicant = createApplicant($wave, 'PSB-2027-MTS-0064', 'SOFTDELTOK', ApplicationStatus::Pending);

    // Soft delete applicant
    $applicant->delete();
    expect($applicant->trashed())->toBeTrue();

    // Attempt status check
    $statusResponse = $this->post('/psb/status', [
        'registration_number' => $applicant->registration_number,
        'access_token' => $applicant->access_token,
    ]);
    $statusResponse->assertSessionHasErrors('registration_number');
    $statusResponse->assertDontSee($applicant->full_name);

    // Attempt edit
    $editResponse = $this->put("/psb/edit/{$applicant->registration_number}", [
        'access_token' => $applicant->access_token,
        'address' => 'Mencoba Update Data Soft Deleted',
    ]);
    $editResponse->assertForbidden();
});
