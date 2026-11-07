<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\AdmissionWave;
use App\Models\Applicant;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class UniqueNikPerAcademicYear implements ValidationRule
{
    public function __construct(
        private readonly ?string $waveId = null,
        private readonly ?string $ignoreApplicantId = null
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $nik = (string) $value;

        $wave = $this->waveId
            ? AdmissionWave::find($this->waveId)
            : AdmissionWave::currentActive();

        if (! $wave) {
            return;
        }

        $academicYear = $wave->academic_year;

        $exists = Applicant::query()
            ->where('nik', $nik)
            ->whereHas('admissionWave', function ($query) use ($academicYear): void {
                $query->where('academic_year', $academicYear);
            })
            ->when($this->ignoreApplicantId, function ($query, string $id): void {
                $query->where('id', '!=', $id);
            })
            ->exists();

        if ($exists) {
            $fail("NIK ini telah terdaftar pada Tahun Ajaran {$academicYear}.");
        }
    }
}
