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
                'previous_school' => (string) $data['previous_school'],
                'address' => (string) $data['address'],
                'registration_fee' => $fee,
                'payment_status' => PaymentStatus::PendingVerification,
                'application_status' => ApplicationStatus::Pending,
            ]);

            ApplicantParent::create([
                'applicant_id' => $applicant->id,
                'father_name' => (string) $data['father_name'],
                'mother_name' => (string) $data['mother_name'],
                'father_job' => isset($data['father_job']) && $data['father_job'] !== '' ? (string) $data['father_job'] : null,
                'mother_job' => isset($data['mother_job']) && $data['mother_job'] !== '' ? (string) $data['mother_job'] : null,
                'parent_income' => isset($data['parent_income']) && $data['parent_income'] !== '' ? (string) $data['parent_income'] : null,
                'parent_phone' => (string) $data['parent_phone'],
                'parent_address' => ! empty($data['parent_address']) ? (string) $data['parent_address'] : (string) $data['address'],
            ]);

            return $applicant;
        }, 3);

        $disk = config('filesystems.disks.private') ? 'private' : 'local';
        $documentsMap = [
            'document_photo' => 'photo',
            'document_kk' => 'kk',
            'document_akta' => 'akta',
            'document_payment' => 'payment_proof',
        ];

        foreach ($documentsMap as $fileKey => $docType) {
            if (isset($files[$fileKey]) && $files[$fileKey] instanceof UploadedFile) {
                /** @var UploadedFile $file */
                $file = $files[$fileKey];
                $path = $file->store("applicants/{$applicant->id}", $disk);

                ApplicantDocument::create([
                    'applicant_id' => $applicant->id,
                    'document_type' => $docType,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return $applicant;
    }
}
