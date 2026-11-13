<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Enums\ApplicationStatus;
use App\Models\Applicant;
use App\Models\ApplicantDocument;
use Illuminate\Contracts\View\View;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

final class PsbCheckStatus extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:50')]
    public string $registration_number = '';

    public string $nik = '';

    public string $access_token = '';

    public ?Applicant $applicant = null;

    public bool $hasSearched = false;

    // Editable fields
    public string $full_name = '';

    public string $birth_place = '';

    public string $birth_date = '';

    public int $child_order = 1;

    public string $previous_school = '';

    public string $address = '';

    public string $father_name = '';

    public string $mother_name = '';

    public ?string $father_job = null;

    public ?string $mother_job = null;

    public ?string $parent_income = null;

    public string $parent_phone = '';

    // Re-upload files
    public mixed $document_photo = null;

    public mixed $document_kk = null;

    public mixed $document_akta = null;

    public mixed $document_payment = null;

    public function mount(string $reg = '', string $token = '', string $nik = ''): void
    {
        if (! empty($reg)) {
            $this->registration_number = $reg;
        }
        if (! empty($nik)) {
            $this->nik = $nik;
            $this->checkStatus();
        } elseif (! empty($token)) {
            $this->access_token = $token;
            $this->checkStatus();
        }
    }

    public function checkStatus(): void
    {
        $this->registration_number = trim($this->registration_number);
        $this->nik = trim($this->nik);
        $this->access_token = trim($this->access_token);

        $reg = $this->registration_number;
        $nik = $this->nik;
        $tok = $this->access_token;

        if (! empty($nik) || empty($tok)) {
            $this->validate([
                'registration_number' => ['required', 'string'],
                'nik' => ['required', 'string', 'max:30'],
            ], [
                'registration_number.required' => 'Nomor pendaftaran wajib diisi.',
                'nik.required' => 'NIK calon santri wajib diisi.',
            ]);
        } else {
            $this->validate([
                'registration_number' => ['required', 'string'],
                'access_token' => ['required', 'string'],
            ]);
        }

        $ip = request()->ip() ?? '127.0.0.1';
        $rateKey = "psb-status-check:{$ip}";

        if (RateLimiter::tooManyAttempts($rateKey, 10)) {
            $seconds = RateLimiter::availableIn($rateKey);
            $this->addError('registration_number', "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik.");

            return;
        }

        RateLimiter::hit($rateKey, 3600);

        $query = Applicant::query();

        // Support exact match, YYNNNN shorthand (e.g. 260001 -> PSB-2026-%-0001), and full PSB format
        if (preg_match('/^(\d{2})(\d{4})$/', $reg, $m)) {
            $fullYear = '20'.$m[1];
            $seq = $m[2];
            $query->where(function ($q) use ($reg, $fullYear, $seq): void {
                $q->where('registration_number', $reg)
                    ->orWhere('registration_number', 'like', "PSB-{$fullYear}-%-{$seq}");
            });
        } elseif (preg_match('/^PSB-(\d{4})-[A-Z]+-(\d{4})$/', $reg, $m)) {
            $shortReg = substr($m[1], -2).$m[2];
            $query->where(function ($q) use ($reg, $shortReg): void {
                $q->where('registration_number', $reg)
                    ->orWhere('registration_number', $shortReg);
            });
        } else {
            $query->where('registration_number', $reg);
        }

        if (! empty($nik)) {
            $digitsNik = preg_replace('/[^0-9]/', '', $nik);
            $query->where(function ($q) use ($nik, $digitsNik): void {
                $q->where('nik', $nik);
                if (! empty($digitsNik) && $digitsNik !== $nik) {
                    $q->orWhere('nik', $digitsNik);
                }
            });
        } else {
            $query->where('access_token', $tok);
        }

        /** @var Applicant|null $applicant */
        $applicant = $query->with(['admissionWave', 'parent', 'documents'])->first();

        if (! $applicant) {
            $this->applicant = null;
            $this->hasSearched = true;
            $msg = ! empty($nik)
                ? 'Kombinasi Nomor Pendaftaran dan NIK tidak ditemukan.'
                : 'Nomor registrasi atau token akses tidak valid.';
            $this->addError('registration_number', $msg);

            return;
        }

        $this->applicant = $applicant;
        $this->hasSearched = true;
        $this->loadEditableData();
    }

    protected function loadEditableData(): void
    {
        if (! $this->applicant) {
            return;
        }

        $this->full_name = (string) $this->applicant->full_name;
        $this->birth_place = (string) $this->applicant->birth_place;
        $this->birth_date = $this->applicant->birth_date->format('Y-m-d');
        $this->child_order = (int) $this->applicant->child_order;
        $this->previous_school = (string) $this->applicant->previous_school;
        $this->address = (string) $this->applicant->address;

        if ($this->applicant->parent) {
            $this->father_name = (string) $this->applicant->parent->father_name;
            $this->mother_name = (string) $this->applicant->parent->mother_name;
            $this->father_job = $this->applicant->parent->father_job;
            $this->mother_job = $this->applicant->parent->mother_job;
            $this->parent_income = $this->applicant->parent->parent_income;
            $this->parent_phone = (string) $this->applicant->parent->parent_phone;
        }
    }

    public function saveChanges(): void
    {
        if (! $this->applicant || ! $this->applicant->canBeEdited()) {
            $this->addError('edit_error', 'Data pendaftaran sudah dikunci dan tidak dapat diubah.');

            return;
        }

        $this->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:100'],
            'birth_date' => ['required', 'date'],
            'child_order' => ['required', 'integer', 'min:1'],
            'previous_school' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'mother_name' => ['nullable', 'string', 'max:255'],
            'parent_phone' => ['nullable', 'string', 'max:20'],
            'document_photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'document_kk' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_akta' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_payment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ]);

        DB::transaction(function (): void {
            if (! $this->applicant) {
                return;
            }

            $this->applicant->update([
                'full_name' => $this->full_name,
                'birth_place' => $this->birth_place,
                'birth_date' => $this->birth_date,
                'child_order' => $this->child_order,
                'previous_school' => $this->previous_school,
                'address' => $this->address,
            ]);

            if ($this->applicant->parent) {
                $this->applicant->parent->update([
                    'father_name' => $this->father_name ?: $this->applicant->parent->father_name,
                    'mother_name' => $this->mother_name ?: $this->applicant->parent->mother_name,
                    'parent_phone' => $this->parent_phone ?: $this->applicant->parent->parent_phone,
                    'father_job' => $this->father_job,
                    'mother_job' => $this->mother_job,
                    'parent_income' => $this->parent_income,
                ]);
            }

            $disk = config('filesystems.disks.private') ? 'private' : 'local';
            $files = [
                'document_photo' => 'photo',
                'document_kk' => 'kk',
                'document_akta' => 'akta',
                'document_payment' => 'payment_proof',
            ];

            foreach ($files as $property => $docType) {
                if ($this->{$property} && $this->{$property} instanceof UploadedFile) {
                    $path = $this->{$property}->store("applicants/{$this->applicant->id}", $disk);
                    ApplicantDocument::updateOrCreate(
                        ['applicant_id' => $this->applicant->id, 'document_type' => $docType],
                        [
                            'file_path' => $path,
                            'original_name' => $this->{$property}->getClientOriginalName(),
                        ]
                    );
                }
            }

            if ($this->applicant->application_status === ApplicationStatus::RevisionNeeded) {
                $this->applicant->application_status = ApplicationStatus::Pending;
                $this->applicant->save();

                activity('psb_applicant')
                    ->performedOn($this->applicant)
                    ->log("Pendaftar {$this->applicant->registration_number} telah mengunggah perbaikan data/berkas melalui layanan mandiri. Status otomatis kembali ke pending.");
            }
        });

        $this->applicant->refresh();
        $this->reset(['document_photo', 'document_kk', 'document_akta', 'document_payment']);
        session()->flash('success', 'Data pendaftaran dan berkas perbaikan berhasil disimpan.');
    }

    public function render(): View
    {
        return view('livewire.public.psb-check-status');
    }
}
