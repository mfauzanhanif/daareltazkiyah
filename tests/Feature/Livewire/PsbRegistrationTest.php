<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Livewire\Public\PsbRegistration;
use App\Models\AdmissionWave;
use App\Models\Applicant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('psb registration livewire component renders active wave and closed state correctly', function () {
    // 1. Without active wave, component shows closed message
    Livewire::test(PsbRegistration::class)
        ->assertOk()
        ->assertSee('Pendaftaran Santri Baru Sedang Ditutup');

    // 2. With active wave, component shows step 1
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 50,
        'max_quota_mdta' => 50,
    ]);

    Livewire::test(PsbRegistration::class)
        ->assertOk()
        ->assertSee('Langkah 1')
        ->assertSee('Data Calon Santri')
        ->assertSee('Nama Lengkap')
        ->assertSee('NIK');
});

test('psb registration component handles multi-step validation and real-time NIK check', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 50,
        'max_quota_mdta' => 50,
    ]);

    $existingNik = '3201234567890001';
    Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-0001',
        'access_token' => 'PREVTOK1',
        'program_type' => 'MTS',
        'full_name' => 'Santri Terdaftar',
        'nik' => $existingNik,
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD Asal',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => 'paid',
        'application_status' => 'pending',
    ]);

    $test = Livewire::test(PsbRegistration::class)
        ->assertSet('step', 1)
        // Step 1 with empty fields should fail
        ->call('nextStep')
        ->assertHasErrors(['full_name', 'nik', 'birth_place', 'birth_date', 'address'])
        ->assertSet('step', 1)
        // Test duplicate NIK validation
        ->set('nik', $existingNik)
        ->assertHasErrors(['nik'])
        // Provide valid unique NIK and Step 1 data
        ->set('full_name', 'Santri Baru Unik')
        ->set('nik', '3201999988887777')
        ->set('gender', 'L')
        ->set('birth_place', 'Bogor')
        ->set('birth_date', '2014-05-15')
        ->set('child_order', 1)
        ->set('address', 'Jl. Cibanteng No. 10')
        ->call('nextStep')
        ->assertSet('step', 2)
        // Step 2 validation
        ->call('nextStep')
        ->assertHasErrors(['father_name', 'mother_name', 'parent_phone'])
        ->set('father_name', 'Sulaiman')
        ->set('mother_name', 'Maryam')
        ->set('parent_phone', '081234567890')
        ->call('nextStep')
        ->assertSet('step', 3)
        // Step 3 validation
        ->call('nextStep')
        ->assertHasErrors(['previous_school'])
        ->set('previous_school', 'SDIT Al Fatih')
        ->set('school_level', 'SD')
        ->set('program_type', 'MTS')
        ->call('nextStep')
        ->assertSet('step', 4);
});

test('psb registration component completes submission and redirects to success', function () {
    Storage::fake('private');

    $wave = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 50,
        'max_quota_mdta' => 50,
    ]);

    $photo = UploadedFile::fake()->image('pasfoto.jpg', 300, 400);
    $kk = UploadedFile::fake()->create('kk.pdf', 500, 'application/pdf');
    $akta = UploadedFile::fake()->create('akta.pdf', 500, 'application/pdf');
    $payment = UploadedFile::fake()->image('bukti.jpg', 600, 800);

    Livewire::test(PsbRegistration::class)
        // Step 1: Data Santri
        ->set('full_name', 'Muhammad Faris')
        ->set('nik', '3201444433332222')
        ->set('gender', 'L')
        ->set('birth_place', 'Bogor')
        ->set('birth_date', '2014-06-10')
        ->set('child_order', 1)
        ->set('total_siblings', 3)
        ->set('address', 'Ciampea Bogor')
        ->call('nextStep')
        // Step 2: Orang Tua / Wali
        ->set('father_name', 'Sulaiman')
        ->set('mother_name', 'Maryam')
        ->set('parent_phone', '081298765432')
        ->call('nextStep')
        // Step 3: Sekolah & Program
        ->set('previous_school', 'SDIT Nurul Fikri')
        ->set('school_level', 'SD')
        ->set('program_type', 'MTS')
        ->call('nextStep')
        // Step 4: Dokumen
        ->set('document_photo', $photo)
        ->set('document_kk', $kk)
        ->set('document_akta', $akta)
        ->set('document_payment', $payment)
        ->call('nextStep')
        // Step 5: Review & Persetujuan
        ->set('agreement', true)
        ->call('submit')
        ->assertRedirect();

    $applicant = Applicant::where('nik', '3201444433332222')->first();
    expect($applicant)->not->toBeNull();
    expect($applicant->full_name)->toBe('Muhammad Faris');
    expect($applicant->registration_number)->toMatch('/^PSB-2027-MTS-\d{4}$/');
    expect($applicant->access_token)->toMatch('/^[A-Z0-9]{8}$/');
});
