<?php

declare(strict_types=1);

use App\Enums\ApplicationStatus;
use App\Enums\PaymentStatus;
use App\Enums\ProgramType;
use App\Enums\SettingGroup;
use App\Models\AdmissionWave;
use App\Models\Applicant;
use App\Models\SiteSetting;
use App\Rules\UniqueNikPerAcademicYear;
use App\Services\PdfService;
use App\Services\RegistrationNumberService;
use App\Services\RegistrationService;
use App\Services\TokenService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

/**
 * Helper to generate valid mock applicant data.
 *
 * @param  array<string, mixed>  $overrides
 * @return array<string, mixed>
 */
function validApplicantPayload(string $waveId, string $program = 'MTS', array $overrides = []): array
{
    return array_merge([
        'admission_wave_id' => $waveId,
        'program_type' => $program,
        'full_name' => 'Santri Challenger Test',
        'nik' => '3201'.str_pad((string) random_int(100000000000, 999999999999), 12, '0', STR_PAD_LEFT),
        'nisn' => '0098765432',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-03-25',
        'child_order' => 1,
        'previous_school' => 'SDIT Insan Mandiri',
        'address' => 'Jl. Sindangbarang No. 12, Bogor Barat',
        'father_name' => 'Ahmad Subagja',
        'mother_name' => 'Siti Nurjanah',
        'father_job' => 'PNS',
        'mother_job' => 'Ibu Rumah Tangga',
        'parent_income' => '5-10 Juta',
        'parent_phone' => '081234567890',
        'parent_address' => 'Jl. Sindangbarang No. 12, Bogor Barat',
    ], $overrides);
}

// =========================================================================
// CHALLENGE 1: CONCURRENCY & SEQUENCE GENERATION SAFETY
// =========================================================================

test('challenge 1.1: sequential registration numbers increment strictly and independently for MTS and MDTA', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 50,
        'max_quota_mdta' => 50,
    ]);

    $service = app(RegistrationNumberService::class);

    // Initial sequence for MTS
    $mts1 = $service->generate(ProgramType::Mts, $wave);
    expect($mts1)->toBe('PSB-2027-MTS-0001');

    // Create MTS 1 record
    Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => $mts1,
        'access_token' => 'TOK00001',
        'program_type' => ProgramType::Mts,
        'full_name' => 'MTS Student 1',
        'nik' => '3201000000000001',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    // Initial sequence for MDTA must be 0001, completely independent of MTS
    $mdta1 = $service->generate(ProgramType::Mdta, $wave);
    expect($mdta1)->toBe('PSB-2027-MDTA-0001');

    // Create MDTA 1 record
    Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => $mdta1,
        'access_token' => 'TOK00002',
        'program_type' => ProgramType::Mdta,
        'full_name' => 'MDTA Student 1',
        'nik' => '3201000000000002',
        'gender' => 'P',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-02-01',
        'child_order' => 1,
        'previous_school' => 'SD 2',
        'address' => 'Bogor',
        'registration_fee' => 25000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    // Subsequent MTS must be 0002
    $mts2 = $service->generate(ProgramType::Mts, $wave);
    expect($mts2)->toBe('PSB-2027-MTS-0002');

    // Subsequent MDTA must be 0002
    $mdta2 = $service->generate(ProgramType::Mdta, $wave);
    expect($mdta2)->toBe('PSB-2027-MDTA-0002');
});

test('challenge 1.2: soft-deleted applicants do not cause sequence collisions or rollbacks', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $service = app(RegistrationNumberService::class);

    // Create applicant 1 and 2
    $app1 = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-0001',
        'access_token' => 'DELTOK01',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Student 1',
        'nik' => '3201000000000011',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    $app2 = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-0002',
        'access_token' => 'DELTOK02',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Student 2 to be deleted',
        'nik' => '3201000000000012',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 2,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    // Soft delete the highest sequence applicant (0002)
    $app2->delete();
    expect($app2->trashed())->toBeTrue();

    // Generating next number must respect withTrashed and produce 0003, NOT 0002
    $next = $service->generate(ProgramType::Mts, $wave);
    expect($next)->toBe('PSB-2027-MTS-0003');
});

test('challenge 1.3: sequence generation spans multiple waves in the same academic year seamlessly', function () {
    $wave1 = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(30)->toDateString(),
        'end_date' => now()->subDays(5)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $wave2 = AdmissionWave::create([
        'name' => 'Gelombang II',
        'slug' => 'gelombang-ii-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 150000,
        'fee_mdta' => 30000,
    ]);

    $service = app(RegistrationNumberService::class);

    // Wave 1 registration
    Applicant::create([
        'admission_wave_id' => $wave1->id,
        'registration_number' => 'PSB-2027-MTS-0001',
        'access_token' => 'WAVETOK1',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Student Wave 1',
        'nik' => '3201000000000021',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    // Next applicant registering in Wave 2 (same academic year 2027/2028) must receive 0002
    $wave2Seq = $service->generate(ProgramType::Mts, $wave2);
    expect($wave2Seq)->toBe('PSB-2027-MTS-0002');
});

test('challenge 1.4: sequence padding handles transitions cleanly (e.g. 0099 to 0100 and 0999 to 1000)', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $service = app(RegistrationNumberService::class);

    // Seed sequence 0099
    Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-0099',
        'access_token' => 'PADTOK99',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Student 99',
        'nik' => '3201000000000099',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    expect($service->generate(ProgramType::Mts, $wave))->toBe('PSB-2027-MTS-0100');

    // Seed sequence 0999
    Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-0999',
        'access_token' => 'PADTOK999',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Student 999',
        'nik' => '3201000000000999',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    expect($service->generate(ProgramType::Mts, $wave))->toBe('PSB-2027-MTS-1000');
});

// =========================================================================
// CHALLENGE 2: QUOTA EXHAUSTION BOUNDARY
// =========================================================================

test('challenge 2.1: registration strictly rejects when program quota is fully exhausted at exact boundary', function () {
    Storage::fake('private');

    $wave = AdmissionWave::create([
        'name' => 'Gelombang Kuota Terbatas',
        'slug' => 'gelombang-kuota-terbatas',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 2, // Exactly 2 slots
        'max_quota_mdta' => 5,
    ]);

    $regService = app(RegistrationService::class);

    // Slot 1: Succeeds
    $data1 = validApplicantPayload($wave->id, 'MTS', ['nik' => '3201000000000101']);
    $applicant1 = $regService->register($data1);
    expect($applicant1->registration_number)->toBe('PSB-2027-MTS-0001');

    // Slot 2: Succeeds (reaches limit 2/2)
    $data2 = validApplicantPayload($wave->id, 'MTS', ['nik' => '3201000000000102']);
    $applicant2 = $regService->register($data2);
    expect($applicant2->registration_number)->toBe('PSB-2027-MTS-0002');

    // Verification: wave hasQuotaFor MTS is now false
    expect($wave->hasQuotaFor(ProgramType::Mts))->toBeFalse();
    expect($wave->remainingQuotaFor(ProgramType::Mts))->toBe(0);

    // Slot 3: MUST be rejected with ValidationException
    $data3 = validApplicantPayload($wave->id, 'MTS', ['nik' => '3201000000000103']);

    expect(fn () => $regService->register($data3))
        ->toThrow(ValidationException::class, 'Kuota pendaftaran untuk program MTS pada gelombang ini telah penuh.');
});

test('challenge 2.2: exhaustion of MTS quota does not block MDTA registration on the same wave', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang Dual Program',
        'slug' => 'gelombang-dual-program',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 1, // Only 1 MTS slot
        'max_quota_mdta' => 10, // 10 MDTA slots available
    ]);

    $regService = app(RegistrationService::class);

    // Fill MTS quota
    $regService->register(validApplicantPayload($wave->id, 'MTS', ['nik' => '3201000000000201']));
    expect($wave->hasQuotaFor(ProgramType::Mts))->toBeFalse();
    expect($wave->hasQuotaFor(ProgramType::Mdta))->toBeTrue();

    // MDTA registration must succeed
    $mdtaApplicant = $regService->register(validApplicantPayload($wave->id, 'MDTA', ['nik' => '3201000000000202']));
    expect($mdtaApplicant->program_type)->toBe(ProgramType::Mdta);
    expect($mdtaApplicant->registration_number)->toBe('PSB-2027-MDTA-0001');
    expect($wave->remainingQuotaFor(ProgramType::Mdta))->toBe(9);
});

test('challenge 2.3: rejected applicant re-opens quota slot for new applicant', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang Rejection Test',
        'slug' => 'gelombang-rejection-test',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 1,
    ]);

    $regService = app(RegistrationService::class);

    // 1. Fill the single slot
    $app1 = $regService->register(validApplicantPayload($wave->id, 'MTS', ['nik' => '3201000000000301']));
    expect($wave->hasQuotaFor(ProgramType::Mts))->toBeFalse();

    // 2. Reject the applicant
    $app1->updateStatus(ApplicationStatus::Rejected, 'Berkas tidak memenuhi syarat.');

    // 3. Quota must now be open again
    expect($wave->hasQuotaFor(ProgramType::Mts))->toBeTrue();
    expect($wave->remainingQuotaFor(ProgramType::Mts))->toBe(1);

    // 4. New applicant can register successfully
    $app2 = $regService->register(validApplicantPayload($wave->id, 'MTS', ['nik' => '3201000000000302']));
    expect($app2->registration_number)->toBe('PSB-2027-MTS-0002');
});

// =========================================================================
// CHALLENGE 3: NIK UNIQUENESS PER ACADEMIC YEAR
// =========================================================================

test('challenge 3.1: duplicate NIK across different waves in the same academic year is blocked', function () {
    $wave1 = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-2027-nik',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(30)->toDateString(),
        'end_date' => now()->subDays(5)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $wave2 = AdmissionWave::create([
        'name' => 'Gelombang II',
        'slug' => 'gelombang-ii-2027-nik',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(20)->toDateString(),
        'fee_mts' => 150000,
        'fee_mdta' => 30000,
    ]);

    $nik = '3201999900001111';

    // Register applicant in Wave 1
    Applicant::create([
        'admission_wave_id' => $wave1->id,
        'registration_number' => 'PSB-2027-MTS-0001',
        'access_token' => 'NIKTOK01',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Santri Wave 1',
        'nik' => $nik,
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    // Validation rule in Wave 2 must fail
    $validator = Validator::make(['nik' => $nik], ['nik' => new UniqueNikPerAcademicYear($wave2->id)]);
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('nik'))->toBe('NIK ini telah terdaftar pada Tahun Ajaran 2027/2028.');

    // Also verify via RegistrationService
    $regService = app(RegistrationService::class);
    expect(fn () => $regService->register(validApplicantPayload($wave2->id, 'MDTA', ['nik' => $nik])))
        ->toThrow(ValidationException::class, 'NIK ini telah terdaftar pada Tahun Ajaran 2027/2028.');
});

test('challenge 3.2: same NIK in a different academic year is accepted', function () {
    $waveYear1 = AdmissionWave::create([
        'name' => 'Gelombang 2027',
        'slug' => 'gelombang-2027',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDays(60)->toDateString(),
        'end_date' => now()->subDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $waveYear2 = AdmissionWave::create([
        'name' => 'Gelombang 2028',
        'slug' => 'gelombang-2028',
        'academic_year' => '2028/2029', // Different academic year
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 120000,
        'fee_mdta' => 30000,
    ]);

    $nik = '3201999900002222';

    // Registered in 2027/2028
    Applicant::create([
        'admission_wave_id' => $waveYear1->id,
        'registration_number' => 'PSB-2027-MTS-0001',
        'access_token' => 'NIKTOK02',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Santri Year 1',
        'nik' => $nik,
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    // Validation rule in 2028/2029 must pass without error
    $validator2028 = Validator::make(['nik' => $nik], ['nik' => new UniqueNikPerAcademicYear($waveYear2->id)]);
    expect($validator2028->passes())->toBeTrue();

    // RegistrationService must accept the registration
    $regService = app(RegistrationService::class);
    $app2028 = $regService->register(validApplicantPayload($waveYear2->id, 'MTS', ['nik' => $nik]));
    expect($app2028->registration_number)->toBe('PSB-2028-MTS-0001');
    expect($app2028->nik)->toBe($nik);
});

test('challenge 3.3: self-update with same NIK is permitted, while colliding with another applicant is blocked', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-self-test',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $appA = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-0001',
        'access_token' => 'APPA1234',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Santri A',
        'nik' => '320100000000000A',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    $appB = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-0002',
        'access_token' => 'APPB1234',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Santri B',
        'nik' => '320100000000000B',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 2,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    // 1. App A updating own data keeping same NIK -> PASSES
    $validatorSelf = Validator::make(['nik' => '320100000000000A'], [
        'nik' => new UniqueNikPerAcademicYear($wave->id, $appA->id),
    ]);
    expect($validatorSelf->passes())->toBeTrue();

    // 2. App A attempting to change NIK to App B's NIK -> FAILS
    $validatorCollision = Validator::make(['nik' => '320100000000000B'], [
        'nik' => new UniqueNikPerAcademicYear($wave->id, $appA->id),
    ]);
    expect($validatorCollision->fails())->toBeTrue();
});

// =========================================================================
// CHALLENGE 4: ACCESS TOKEN UNIQUENESS & FORMAT
// =========================================================================

test('challenge 4.1: access tokens strictly adhere to [A-Z0-9]{8} format and length 8', function () {
    $tokenService = app(TokenService::class);

    for ($i = 0; $i < 50; $i++) {
        $token = $tokenService->generate();
        expect(strlen($token))->toBe(8);
        expect($token)->toMatch('/^[A-Z0-9]{8}$/');
    }
});

test('challenge 4.2: access token generation prevents duplicate collisions with pre-existing tokens', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang Token Test',
        'slug' => 'gelombang-token-test',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $tokenService = app(TokenService::class);
    $generatedTokens = [];

    // Pre-seed an applicant with a specific token
    $fixedToken = 'COLLIS01';
    Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-9001',
        'access_token' => $fixedToken,
        'program_type' => ProgramType::Mts,
        'full_name' => 'Existing Token Holder',
        'nik' => '3201888877776666',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    // Generate 100 tokens and verify none equal $fixedToken and all are unique
    for ($i = 0; $i < 100; $i++) {
        $tok = $tokenService->generate();
        expect($tok)->not->toBe($fixedToken);
        $generatedTokens[] = $tok;
    }

    expect(count(array_unique($generatedTokens)))->toBe(100);
});

// =========================================================================
// CHALLENGE 5: DOMPDF PROOF GENERATION
// =========================================================================

test('challenge 5.1: DomPDF proof stream returns valid PDF binary header and substantial content length', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang I',
        'slug' => 'gelombang-i-pdf',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $regNumber = 'PSB-2027-MTS-7777';
    $applicant = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => $regNumber,
        'access_token' => 'PDFTOK01',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Fatih Al-Ayyubi PDF Test',
        'nik' => '3201777788889999',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-05-12',
        'child_order' => 1,
        'previous_school' => 'SDIT Daar El Fikri',
        'address' => 'Jl. Raya Ciampea No. 45, Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    $applicant->parent()->create([
        'applicant_id' => $applicant->id,
        'father_name' => 'Ayah Fatih',
        'mother_name' => 'Ibu Fatih',
        'parent_phone' => '081234567890',
        'parent_address' => 'Jl. Raya Ciampea No. 45, Bogor',
    ]);

    $response = $this->get("/psb/bukti/{$regNumber}");
    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');
    $response->assertHeader('content-disposition', "attachment; filename=\"Bukti-Pendaftaran-{$regNumber}.pdf\"");

    $content = $response->getContent();
    expect($content)->toBeString();
    // Valid PDF starts with %PDF-1.
    expect(str_starts_with($content, '%PDF-1.'))->toBeTrue();
    // Substantial size indicating complete layout rendering (> 5000 bytes)
    expect(strlen($content))->toBeGreaterThan(5000);
});

test('challenge 5.2: proof reflects dynamic SiteSetting updates and adheres to A4 specifications', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang Khusus Settings',
        'slug' => 'gelombang-khusus-settings',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $customSchoolName = 'PPMTQ DAAR EL TAZKIYAH KAMPUS CABANG';
    $customBankAcc = '888777666555';
    SiteSetting::set('school_name', $customSchoolName, SettingGroup::General);
    SiteSetting::set('bank_account_number', $customBankAcc, SettingGroup::Billing);

    $applicant = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-8888',
        'access_token' => 'SETTOK01',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Santri Dynamic Settings',
        'nik' => '3201888899990000',
        'gender' => 'L',
        'birth_place' => 'Bogor',
        'birth_date' => '2014-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Bogor',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::PendingVerification,
        'application_status' => ApplicationStatus::Pending,
    ]);

    $pdfService = app(PdfService::class);
    $response = $pdfService->generateProof($applicant);

    expect($response->status())->toBe(200);
    expect($response->headers->get('Content-Type'))->toBe('application/pdf');

    // Also assert that the underlying Blade view incorporates dynamic settings and A4 styling
    $renderedView = view('psb.proof-pdf', [
        'applicant' => $applicant,
        'settings' => [
            'school_name' => SiteSetting::get('school_name'),
            'school_address' => SiteSetting::get('school_address', 'Bogor'),
            'school_phone' => SiteSetting::get('school_phone', '0812'),
            'bank_name' => SiteSetting::get('bank_name', 'BSI'),
            'bank_account_number' => SiteSetting::get('bank_account_number'),
            'bank_account_name' => SiteSetting::get('bank_account_name', 'PPMTQ'),
        ],
    ])->render();

    expect($renderedView)->toContain($customSchoolName);
    expect($renderedView)->toContain($customBankAcc);
    expect($renderedView)->toContain('size: A4 portrait;');
    expect($renderedView)->toContain("font-family: 'DejaVu Sans', sans-serif;");
    expect($renderedView)->toContain('border: 1px solid #084C27;');
});

test('challenge 5.3: proof download returns 404 for non-existent registration number', function () {
    $response = $this->get('/psb/bukti/PSB-9999-MTS-9999');
    $response->assertNotFound();
});
