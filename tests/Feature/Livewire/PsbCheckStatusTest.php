<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Enums\ApplicationStatus;
use App\Livewire\Public\PsbCheckStatus;
use App\Models\AdmissionWave;
use App\Models\Applicant;
use App\Models\ApplicantParent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('psb check status component searches applicant and renders status details', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $regNumber = 'PSB-2027-MTS-0050';
    $token = 'VALIDTOK';
    $applicant = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => $regNumber,
        'access_token' => $token,
        'program_type' => 'MTS',
        'full_name' => 'Salim bin Abdullah',
        'nik' => '3201777788889999',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-04-04',
        'child_order' => 1,
        'previous_school' => 'SD Asal',
        'address' => 'Bogor Timur',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => 'pending',
    ]);

    ApplicantParent::create([
        'applicant_id' => $applicant->id,
        'father_name' => 'Abdullah',
        'mother_name' => 'Aisyah',
        'parent_phone' => '081234567899',
        'parent_address' => 'Bogor Timur',
    ]);

    // 1. Search with invalid credentials fails
    Livewire::test(PsbCheckStatus::class)
        ->set('registration_number', 'WRONG-REG')
        ->set('access_token', 'WRONGTOK')
        ->call('checkStatus')
        ->assertHasErrors(['registration_number']);

    // 2. Search with valid credentials succeeds
    Livewire::test(PsbCheckStatus::class)
        ->set('registration_number', $regNumber)
        ->set('access_token', $token)
        ->call('checkStatus')
        ->assertHasNoErrors()
        ->assertSee('Salim bin Abdullah')
        ->assertSee($regNumber)
        ->assertSee('pending');
});

test('psb check status component allows editing when pending and resets revision_needed to pending', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-2028',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $regNumber = 'PSB-2027-MTS-0051';
    $token = 'REVISE99';
    $applicant = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => $regNumber,
        'access_token' => $token,
        'program_type' => 'MTS',
        'full_name' => 'Muadz bin Jabal',
        'nik' => '3201555566667777',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-07-07',
        'child_order' => 1,
        'previous_school' => 'SD Lama',
        'address' => 'Alamat Sebelum Edit',
        'registration_fee' => 100000,
        'payment_status' => 'pending_verification',
        'application_status' => ApplicationStatus::RevisionNeeded,
        'admin_notes' => 'Tolong perbarui alamat lengkap.',
    ]);

    ApplicantParent::create([
        'applicant_id' => $applicant->id,
        'father_name' => 'Jabal',
        'mother_name' => 'Halimah',
        'parent_phone' => '081234567899',
        'parent_address' => 'Bogor',
    ]);

    Livewire::test(PsbCheckStatus::class, ['reg' => $regNumber, 'token' => $token])
        ->assertSee('Muadz bin Jabal')
        ->assertSee('Tolong perbarui alamat lengkap.')
        ->set('address', 'Alamat Baru RT 01 RW 02 Ciampea')
        ->call('saveChanges')
        ->assertHasNoErrors();

    $updated = Applicant::find($applicant->id);
    expect($updated->address)->toBe('Alamat Baru RT 01 RW 02 Ciampea');
    expect($updated->application_status)->toBe(ApplicationStatus::Pending);
});
