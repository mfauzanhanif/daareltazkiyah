<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\ProgramType;
use App\Models\AdmissionWave;
use App\Models\Applicant;

final class RegistrationNumberService
{
    /**
     * Generate an atomic, sequential registration number: PSB-{YEAR}-{PROGRAM}-{0001}.
     */
    public function generate(ProgramType|string $program, ?AdmissionWave $wave = null, ?string $academicYear = null): string
    {
        $programCode = $program instanceof ProgramType ? $program->value : (string) $program;

        $yearStr = $academicYear
            ?? ($wave ? $wave->academic_year : AdmissionWave::currentActive()?->academic_year)
            ?? now()->format('Y');

        $year = substr((string) $yearStr, 0, 4);

        $latest = Applicant::withTrashed()
            ->where('registration_number', 'like', "PSB-{$year}-{$programCode}-%")
            ->lockForUpdate()
            ->orderByDesc('registration_number')
            ->value('registration_number');

        $nextSequence = 1;
        if ($latest !== null && preg_match('/-(\d{4})$/', (string) $latest, $matches)) {
            $nextSequence = ((int) $matches[1]) + 1;
        }

        return sprintf('PSB-%s-%s-%04d', $year, $programCode, $nextSequence);
    }
}
