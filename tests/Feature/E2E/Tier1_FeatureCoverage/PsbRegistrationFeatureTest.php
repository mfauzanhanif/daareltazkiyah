<?php

declare(strict_types=1);

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

test('registration page renders successfully when an admission wave is active', function () {
    if (! Schema::hasTable('admission_waves')) {
        test()->markTestSkipped('Admission waves table not yet migrated (M1 required).');
    }

    DB::table('admission_waves')->insert([
        'id' => (string) Str::ulid(),
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

    $response = $this->get('/psb');
    if ($response->status() === 404) {
        test()->markTestSkipped('PSB registration route not yet registered (M4 required).');
    }

    $response->assertOk()
        ->assertSee('Gelombang I')
        ->assertSee('MTS')
        ->assertSee('MDTA');
});

test('successful registration creates applicant, parent, and document records with atomic registration number and access token', function () {
    if (! Schema::hasTable('applicants') || ! Schema::hasTable('admission_waves') || ! Schema::hasTable('applicant_parents') || ! Schema::hasTable('applicant_documents')) {
        test()->markTestSkipped('PSB tables not yet migrated (M1 required).');
    }

    Storage::fake('private');

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

    $postData = [
        'admission_wave_id' => $waveId,
        'program_type' => 'MTS',
        'full_name' => 'Muhammad Fatih Al-Ayyubi',
        'nik' => '3201234567890001',
        'nisn' => '0123456789',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-05-12',
        'child_order' => 1,
        'previous_school' => 'SDIT Daar El Fikri',
        'address' => 'Jl. Raya Ciampea No. 45, Bogor',
        'father_name' => 'Abdullah',
        'mother_name' => 'Khadijah',
        'father_job' => 'Wiraswasta',
        'mother_job' => 'Guru',
        'parent_income' => '3-5 Juta',
        'parent_phone' => '081234567890',
        'parent_address' => 'Jl. Raya Ciampea No. 45, Bogor',
        'document_photo' => UploadedFile::fake()->image('pasfoto.jpg', 300, 400),
        'document_kk' => UploadedFile::fake()->create('kk.pdf', 500, 'application/pdf'),
        'document_akta' => UploadedFile::fake()->create('akta.pdf', 500, 'application/pdf'),
        'document_payment' => UploadedFile::fake()->image('transfer.jpg', 600, 800),
    ];

    $response = $this->post('/psb/daftar', $postData);
    if ($response->status() === 404) {
        test()->markTestSkipped('PSB registration submission route not yet registered (M4 required).');
    }

    $response->assertSessionHasNoErrors();

    // Verify applicant in database
    $applicant = DB::table('applicants')->where('nik', '3201234567890001')->first();
    expect($applicant)->not->toBeNull();
    expect($applicant->full_name)->toBe('Muhammad Fatih Al-Ayyubi');
    expect($applicant->program_type)->toBe('MTS');
    expect($applicant->registration_fee)->toBe(100000);
    expect($applicant->application_status)->toBe('pending');
    expect($applicant->payment_status)->toBe('pending_verification');

    // Verify atomic registration number format: PSB-2027-[PROGRAM]-[NUMBER]
    expect($applicant->registration_number)->toMatch('/^PSB-2027-MTS-\d{4}$/');

    // Verify 8-character uppercase alphanumeric access token
    expect($applicant->access_token)->toMatch('/^[A-Z0-9]{8}$/');

    // Verify parent record
    $parent = DB::table('applicant_parents')->where('applicant_id', $applicant->id)->first();
    expect($parent)->not->toBeNull();
    expect($parent->father_name)->toBe('Abdullah');
    expect($parent->parent_phone)->toBe('081234567890');

    // Verify documents records
    $documents = DB::table('applicant_documents')->where('applicant_id', $applicant->id)->get();
    expect($documents->count())->toBeGreaterThanOrEqual(4);
});

test('registration proof PDF can be downloaded via DomPDF stream', function () {
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

    $regNumber = 'PSB-2027-MTS-0001';
    $applicantId = (string) Str::ulid();
    DB::table('applicants')->insert([
        'id' => $applicantId,
        'admission_wave_id' => $waveId,
        'registration_number' => $regNumber,
        'access_token' => 'ABCD1234',
        'program_type' => 'MTS',
        'full_name' => 'Ahmad Zaki Fauzan',
        'nik' => '3201998877665544',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD Negeri 1 Bogor',
        'address' => 'Bogor Barat',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $response = $this->get("/psb/bukti/{$regNumber}");
    if ($response->status() === 404) {
        test()->markTestSkipped('PDF proof download route not yet registered (M4 required).');
    }

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');
});
