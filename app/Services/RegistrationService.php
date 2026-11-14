<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Enums\PaymentStatus;
use App\Enums\ProgramType;
use App\Models\AdmissionWave;
use App\Models\Applicant;
use App\Models\ApplicantDocument;
use App\Models\ApplicantParent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

final class RegistrationService
{
    public function __construct(
        private readonly RegistrationNumberService $numberService,
        private readonly TokenService $tokenService
    ) {}

    /**
     * Atomically register a new applicant inside a database transaction.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $files
     */
    public function register(array $data, array $files = []): Applicant
    {
        /** @var Applicant $applicant */
        $applicant = DB::transaction(function () use ($data): Applicant {
            /** @var AdmissionWave|null $wave */
            $wave = AdmissionWave::where('id', $data['admission_wave_id'])
                ->lockForUpdate()
                ->first();

            if (! $wave || ! $wave->isOpen()) {
                throw ValidationException::withMessages([
                    'admission_wave_id' => 'Gelombang pendaftaran yang dipilih sedang ditutup atau tidak aktif.',
                ]);
            }

            $program = ProgramType::from((string) $data['program_type']);
            if (! $wave->hasQuotaFor($program)) {
                throw ValidationException::withMessages([
                    'program_type' => "Kuota pendaftaran untuk program {$program->value} pada gelombang ini telah penuh.",
                ]);
            }

            $academicYear = $wave->academic_year;
            $nik = (string) $data['nik'];

            $duplicateNik = Applicant::query()
                ->where('nik', $nik)
                ->whereHas('admissionWave', function ($query) use ($academicYear): void {
                    $query->where('academic_year', $academicYear);
                })
                ->exists();

            if ($duplicateNik) {
                throw ValidationException::withMessages([
                    'nik' => "NIK ini telah terdaftar pada Tahun Ajaran {$academicYear}.",
                ]);
            }

            $regNumber = $this->numberService->generate($program, $wave);
            $accessToken = $this->tokenService->generate();
            $fee = $wave->feeFor($program);

            $applicant = Applicant::create([
                'admission_wave_id' => $wave->id,
                'registration_number' => $regNumber,
                'access_token' => $accessToken,
                'program_type' => $program,
                'full_name' => (string) $data['full_name'],
                'nik' => $nik,
                'nisn' => isset($data['nisn']) && $data['nisn'] !== '' ? (string) $data['nisn'] : null,
                'gender' => (string) $data['gender'],
                'birth_place' => (string) $data['birth_place'],
                'birth_date' => (string) $data['birth_date'],
                'child_order' => (int) $data['child_order'],
                'total_siblings' => isset($data['total_siblings']) && $data['total_siblings'] !== '' ? (int) $data['total_siblings'] : null,
                'previous_school' => (string) $data['previous_school'],
                'school_level' => isset($data['school_level']) && $data['school_level'] !== '' ? (string) $data['school_level'] : null,
                'school_address' => isset($data['school_address']) && $data['school_address'] !== '' ? (string) $data['school_address'] : null,
                'address' => (string) $data['address'],
                'province' => isset($data['province']) && $data['province'] !== '' ? (string) $data['province'] : null,
                'province_code' => isset($data['province_code']) && $data['province_code'] !== '' ? (string) $data['province_code'] : null,
                'city' => isset($data['city']) && $data['city'] !== '' ? (string) $data['city'] : null,
                'city_code' => isset($data['city_code']) && $data['city_code'] !== '' ? (string) $data['city_code'] : null,
                'district' => isset($data['district']) && $data['district'] !== '' ? (string) $data['district'] : null,
                'district_code' => isset($data['district_code']) && $data['district_code'] !== '' ? (string) $data['district_code'] : null,
                'village' => isset($data['village']) && $data['village'] !== '' ? (string) $data['village'] : null,
                'village_code' => isset($data['village_code']) && $data['village_code'] !== '' ? (string) $data['village_code'] : null,
                'registration_fee' => $fee,
                'payment_status' => PaymentStatus::PendingVerification,
                'application_status' => ApplicationStatus::Pending,
            ]);

            ApplicantParent::create([
                'applicant_id' => $applicant->id,
                'father_name' => (string) $data['father_name'],
                'father_status' => isset($data['father_status']) && $data['father_status'] !== '' ? (string) $data['father_status'] : null,
                'father_nik' => isset($data['father_nik']) && $data['father_nik'] !== '' ? (string) $data['father_nik'] : null,
                'father_birth' => isset($data['father_birth']) && $data['father_birth'] !== '' ? (string) $data['father_birth'] : null,
                'father_education' => isset($data['father_education']) && $data['father_education'] !== '' ? (string) $data['father_education'] : null,
                'father_pesantren' => ! empty($data['father_pesantren']),
                'father_job' => isset($data['father_job']) && $data['father_job'] !== '' ? (string) $data['father_job'] : null,
                'father_no_wa' => ! empty($data['father_no_wa']),
                'mother_name' => (string) $data['mother_name'],
                'mother_status' => isset($data['mother_status']) && $data['mother_status'] !== '' ? (string) $data['mother_status'] : null,
                'mother_nik' => isset($data['mother_nik']) && $data['mother_nik'] !== '' ? (string) $data['mother_nik'] : null,
                'mother_birth' => isset($data['mother_birth']) && $data['mother_birth'] !== '' ? (string) $data['mother_birth'] : null,
                'mother_education' => isset($data['mother_education']) && $data['mother_education'] !== '' ? (string) $data['mother_education'] : null,
                'mother_pesantren' => ! empty($data['mother_pesantren']),
                'mother_job' => isset($data['mother_job']) && $data['mother_job'] !== '' ? (string) $data['mother_job'] : null,
                'mother_no_wa' => ! empty($data['mother_no_wa']),
                'mother_phone' => isset($data['mother_phone']) && $data['mother_phone'] !== '' ? (string) $data['mother_phone'] : null,
                'parent_income' => isset($data['parent_income']) && $data['parent_income'] !== '' ? (string) $data['parent_income'] : null,
                'parent_phone' => (string) $data['parent_phone'],
                'parent_address' => ! empty($data['parent_address']) ? (string) $data['parent_address'] : (string) $data['address'],
                'guardian_type' => isset($data['guardian_type']) && $data['guardian_type'] !== '' ? (string) $data['guardian_type'] : 'ayah',
                'guardian_name' => isset($data['guardian_name']) && $data['guardian_name'] !== '' ? (string) $data['guardian_name'] : null,
                'guardian_relation' => isset($data['guardian_relation']) && $data['guardian_relation'] !== '' ? (string) $data['guardian_relation'] : null,
                'guardian_nik' => isset($data['guardian_nik']) && $data['guardian_nik'] !== '' ? (string) $data['guardian_nik'] : null,
                'guardian_phone' => isset($data['guardian_phone']) && $data['guardian_phone'] !== '' ? (string) $data['guardian_phone'] : null,
                'guardian_job' => isset($data['guardian_job']) && $data['guardian_job'] !== '' ? (string) $data['guardian_job'] : null,
            ]);

            return $applicant;
        }, 3);

        $disk = config('filesystems.disks.private') ? 'private' : 'local';
        $documentsMap = [
            'document_photo' => 'photo',
            'document_kk' => 'kk',
            'document_akta' => 'akta',
            'document_payment' => 'payment_proof',
            'document_ktp_ayah' => 'ktp_father',
            'document_ktp_father' => 'ktp_father',
            'document_ktp_ibu' => 'ktp_mother',
            'document_ktp_mother' => 'ktp_mother',
            'document_ijazah' => 'ijazah',
            'document_nisn' => 'print_nisn',
            'document_print_nisn' => 'print_nisn',
        ];

        foreach ($documentsMap as $fileKey => $docType) {
            if (isset($files[$fileKey]) && $files[$fileKey] instanceof UploadedFile) {
                /** @var UploadedFile $file */
                $file = $files[$fileKey];
                $path = $file->store("applicants/{$applicant->id}", $disk);

                $doc = ApplicantDocument::create([
                    'applicant_id' => $applicant->id,
                    'document_type' => $docType,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);

                try {
                    $doc->addMediaFromDisk($path, $disk)
                        ->preservingOriginal()
                        ->toMediaCollection('document');
                } catch (\Throwable) {
                    // Fallback if media-library background conversion or disk mock
                }
            }
        }

        return $applicant;
    }
}
