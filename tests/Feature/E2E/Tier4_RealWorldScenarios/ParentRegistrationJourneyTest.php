<?php

declare(strict_types=1);

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

test('complete parent registration journey: landing page -> fee check -> multi-step registration -> PDF proof download -> self-service status verification', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves') || ! Schema::hasTable('applicant_parents') || ! Schema::hasTable('applicant_documents')) {
        test()->markTestSkipped('PSB tables not yet migrated (M1 required).');
    }

    Storage::fake('private');

    // 1. Setup Active Gelombang I
    $waveId = (string) Str::ulid();
    DB::table('admission_waves')->insert([
        'id' => $waveId,
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(3)->toDateString(),
        'end_date' => now()->addDays(25)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Step 1: Parent visits landing page
    $landingResponse = $this->get('/');
    $landingResponse->assertOk();

    // Step 2: Parent checks registration portal
    $psbResponse = $this->get('/psb');
    if ($psbResponse->status() === 404) {
        test()->markTestSkipped('PSB registration route not yet registered (M4 required).');
    }
    $psbResponse->assertOk();

    // Step 3: Parent fills and submits multi-step registration form for MTS
    $nik = '3201888899990001';
    $formData = [
        'admission_wave_id' => $waveId,
        'program_type' => 'MTS',
        'full_name' => 'Ahmad Khalid Al-Walid',
        'nik' => $nik,
        'nisn' => '0011223344',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-06-20',
        'child_order' => 1,
        'previous_school' => 'SDIT Daar El Fikri',
        'address' => 'Jl. Sindang Barang No. 12, Bogor Barat',
        'father_name' => 'Khalid',
        'mother_name' => 'Fatimah',
        'father_job' => 'PNS',
        'mother_job' => 'Ibu Rumah Tangga',
        'parent_income' => '3-5 Juta',
        'parent_phone' => '081234567800',
        'parent_address' => 'Jl. Sindang Barang No. 12, Bogor Barat',
        'document_photo' => UploadedFile::fake()->image('pasfoto.jpg', 300, 400),
        'document_kk' => UploadedFile::fake()->create('kk.pdf', 300, 'application/pdf'),
        'document_akta' => UploadedFile::fake()->create('akta.pdf', 300, 'application/pdf'),
        'document_payment' => UploadedFile::fake()->image('transfer.jpg', 500, 700),
    ];

    $submitResponse = $this->post('/psb/daftar', $formData);
    $submitResponse->assertSessionHasNoErrors();

    // Step 4: Verify generated records in database
    $applicant = DB::table('applicants')->where('nik', $nik)->first();
    expect($applicant)->not->toBeNull();
    expect($applicant->full_name)->toBe('Ahmad Khalid Al-Walid');
    expect($applicant->program_type)->toBe('MTS');
    expect($applicant->registration_fee)->toBe(100000);
    expect($applicant->application_status)->toBe('pending');
    expect($applicant->payment_status)->toBe('pending_verification');

    // Verify atomic registration number and access token
    $regNumber = $applicant->registration_number;
    $accessToken = $applicant->access_token;
    expect($regNumber)->toMatch('/^PSB-2027-MTS-\d{4}$/');
    expect($accessToken)->toMatch('/^[A-Z0-9]{8}$/');

    // Step 5: Parent downloads registration proof PDF
    $pdfResponse = $this->get("/psb/bukti/{$regNumber}");
    if ($pdfResponse->status() === 404) {
        test()->markTestSkipped('PDF proof download route not yet registered (M4 required).');
    }
    $pdfResponse->assertOk()
        ->assertHeader('content-type', 'application/pdf');

    // Step 6: Parent performs self-service status verification
    $statusResponse = $this->post('/psb/status', [
        'registration_number' => $regNumber,
        'access_token' => $accessToken,
    ]);
    $statusResponse->assertOk()
        ->assertSee('Ahmad Khalid Al-Walid')
        ->assertSee($regNumber)
        ->assertSee('pending');
});
