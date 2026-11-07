<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Enums\ProgramType;
use App\Models\AdmissionWave;
use App\Rules\UniqueNikPerAcademicYear;
use App\Services\RegistrationService;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

final class PsbRegistration extends Component
{
    use WithFileUploads;

    public int $step = 1;

    public ?AdmissionWave $wave = null;

    public string $program_type = 'MTS';

    // Step 2: Student Data
    public string $full_name = '';

    public string $nik = '';

    public ?string $nisn = null;

    public string $gender = 'L';

    public string $birth_place = '';

    public string $birth_date = '';

    public int $child_order = 1;

    public string $previous_school = '';

    public string $address = '';

    // Step 3: Parent Data
    public string $father_name = '';

    public string $mother_name = '';

    public ?string $father_job = null;

    public ?string $mother_job = null;

    public ?string $parent_income = '2-5 Juta';

    public string $parent_phone = '';

    public ?string $parent_address = null;

    // Step 4: Documents
    public mixed $document_photo = null;

    public mixed $document_kk = null;

    public mixed $document_akta = null;

    public mixed $document_payment = null;

    public function mount(?string $selectedProgram = null): void
    {
        $this->wave = AdmissionWave::currentActive();

        if ($selectedProgram && in_array($selectedProgram, ['MTS', 'MDTA'], true)) {
            $this->program_type = $selectedProgram;
        }
    }

    public function updatedNik(): void
    {
        $this->validateOnly('nik');
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'nik' => ['required', 'digits:16', new UniqueNikPerAcademicYear($this->wave?->id)],
        ];
    }

    public function nextStep(): void
    {
        $this->validateStep($this->step);
        $this->step++;
    }

    public function previousStep(): void
    {
        $this->step = max(1, $this->step - 1);
    }

    public function validateStep(int $step): void
    {
        if ($step === 1) {
            $this->validate([
                'program_type' => ['required', 'in:MTS,MDTA'],
            ]);

            $program = ProgramType::from($this->program_type);
            if (! $this->wave?->hasQuotaFor($program)) {
                $this->addError('program_type', "Kuota pendaftaran untuk program {$program->value} pada gelombang ini telah penuh.");
                throw ValidationException::withMessages([
                    'program_type' => "Kuota pendaftaran untuk program {$program->value} pada gelombang ini telah penuh.",
                ]);
            }
        } elseif ($step === 2) {
            $this->validate([
                'full_name' => ['required', 'string', 'max:255'],
                'nik' => ['required', 'digits:16', new UniqueNikPerAcademicYear($this->wave?->id)],
                'nisn' => ['nullable', 'string', 'max:10'],
                'gender' => ['required', 'in:L,P'],
                'birth_place' => ['required', 'string', 'max:100'],
                'birth_date' => ['required', 'date'],
                'child_order' => ['required', 'integer', 'min:1'],
                'previous_school' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string'],
            ]);
        } elseif ($step === 3) {
            $this->validate([
                'father_name' => ['required', 'string', 'max:255'],
                'mother_name' => ['required', 'string', 'max:255'],
                'father_job' => ['nullable', 'string', 'max:100'],
                'mother_job' => ['nullable', 'string', 'max:100'],
                'parent_income' => ['nullable', 'string', 'max:100'],
                'parent_phone' => ['required', 'string', 'max:20'],
                'parent_address' => ['nullable', 'string'],
            ]);
        }
    }

    public function submit(RegistrationService $service): mixed
    {
        if (! $this->wave) {
            $this->addError('general', 'Tidak ada gelombang pendaftaran yang aktif.');

            return null;
        }

        $this->validate([
            'document_photo' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'document_kk' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_akta' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_payment' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ]);

        $data = [
            'admission_wave_id' => $this->wave->id,
            'program_type' => $this->program_type,
            'full_name' => $this->full_name,
            'nik' => $this->nik,
            'nisn' => $this->nisn,
            'gender' => $this->gender,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date,
            'child_order' => $this->child_order,
            'previous_school' => $this->previous_school,
            'address' => $this->address,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'father_job' => $this->father_job,
            'mother_job' => $this->mother_job,
            'parent_income' => $this->parent_income,
            'parent_phone' => $this->parent_phone,
            'parent_address' => $this->parent_address ?: $this->address,
        ];

        $files = [
            'document_photo' => $this->document_photo,
            'document_kk' => $this->document_kk,
            'document_akta' => $this->document_akta,
            'document_payment' => $this->document_payment,
        ];

        $applicant = $service->register($data, $files);

        return redirect()->route('psb.success', $applicant->registration_number);
    }

    public function render(): View
    {
        return view('livewire.public.psb-registration');
    }
}
