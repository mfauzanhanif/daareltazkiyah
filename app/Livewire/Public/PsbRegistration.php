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

    // --- STEP 1: DATA CALON SANTRI ---
    public string $full_name = '';

    public string $nik = '';

    public ?string $nisn = null;

    public string $gender = 'L';

    public string $birth_place = '';

    public string $birth_date = '';

    public int $child_order = 1;

    public ?int $total_siblings = 1;

    public string $address = '';

    public ?string $province_code = null;

    public ?string $city_code = null;

    public ?string $district_code = null;

    public ?string $village_code = null;

    public string $province = 'Banten';

    public string $city = 'Serang';

    public string $district = 'Petir';

    public string $village = 'Mekar Baru';

    // --- STEP 2: DATA ORANG TUA / WALI ---
    // Ayah Kandung
    public string $father_name = '';

    public string $father_status = 'Hidup';

    public ?string $father_nik = null;

    public ?string $father_birth = null;

    public ?string $father_education = 'SMA / Sederajat';

    public bool $father_pesantren = false;

    public ?string $father_job = null;

    public ?string $parent_income = '2-5 Juta';

    public bool $father_no_wa = false;

    public string $parent_phone = '';

    // Ibu Kandung
    public string $mother_name = '';

    public string $mother_status = 'Hidup';

    public ?string $mother_nik = null;

    public ?string $mother_birth = null;

    public ?string $mother_education = 'SMA / Sederajat';

    public bool $mother_pesantren = false;

    public ?string $mother_job = null;

    public ?string $mother_income = null;

    public bool $mother_no_wa = false;

    public ?string $mother_phone = null;

    // Wali
    public string $guardian_type = 'ayah'; // 'ayah', 'ibu', 'lainnya'

    public ?string $guardian_name = null;

    public ?string $guardian_relation = null;

    public ?string $guardian_nik = null;

    public ?string $guardian_phone = null;

    public ?string $guardian_job = null;

    // --- STEP 3: SEKOLAH ASAL & PILIHAN PROGRAM ---
    public string $school_level = 'SD'; // 'SD', 'MI', 'Paket A', 'Lainnya'

    public string $previous_school = '';

    public ?string $school_address = null;

    public string $program_type = 'MTS'; // 'MTS' atau 'MDTA'

    // --- STEP 4: DOKUMEN ---
    public mixed $document_kk = null;

    public mixed $document_akta = null;

    public mixed $document_ktp_ayah = null;

    public mixed $document_ktp_ibu = null;

    public mixed $document_ijazah = null;

    public mixed $document_nisn = null;

    public mixed $document_photo = null;

    public mixed $document_payment = null;

    // --- STEP 5: REVIEW & PERSETUJUAN ---
    public bool $agreement = false;

    public function mount(?string $selectedProgram = null): void
    {
        $this->wave = AdmissionWave::currentActive();

        if ($selectedProgram && in_array($selectedProgram, ['MTS', 'MDTA'], true)) {
            $this->program_type = $selectedProgram;
        }

        try {
            if (class_exists(\Aliziodev\Wilayah\Models\Province::class) && \Aliziodev\Wilayah\Models\Province::exists()) {
                $this->province_code = '36';
                $this->province = 'Banten';

                $this->city_code = '36.04';
                $this->city = 'Kabupaten Serang';

                $this->district_code = '36.04.19';
                $this->district = 'Petir';

                $this->village_code = '36.04.19.2012';
                $this->village = 'Mekar Baru';
            }
        } catch (\Throwable) {
            // Keep fallback string defaults
        }
    }

    public function updatedProvinceCode(?string $value): void
    {
        $this->city_code = null;
        $this->city = '';
        $this->district_code = null;
        $this->district = '';
        $this->village_code = null;
        $this->village = '';

        if ($value) {
            $this->province = \Aliziodev\Wilayah\Models\Province::where('code', $value)->value('name') ?? '';
        } else {
            $this->province = '';
        }
    }

    public function updatedCityCode(?string $value): void
    {
        $this->district_code = null;
        $this->district = '';
        $this->village_code = null;
        $this->village = '';

        if ($value) {
            $this->city = \Aliziodev\Wilayah\Models\Regency::where('code', $value)->value('name') ?? '';
        } else {
            $this->city = '';
        }
    }

    public function updatedDistrictCode(?string $value): void
    {
        $this->village_code = null;
        $this->village = '';

        if ($value) {
            $this->district = \Aliziodev\Wilayah\Models\District::where('code', $value)->value('name') ?? '';
        } else {
            $this->district = '';
        }
    }

    public function updatedVillageCode(?string $value): void
    {
        if ($value) {
            $this->village = \Aliziodev\Wilayah\Models\Village::where('code', $value)->value('name') ?? '';
        } else {
            $this->village = '';
        }
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public function getProvincesProperty(): array
    {
        try {
            if (class_exists(\Aliziodev\Wilayah\Facades\Wilayah::class)) {
                return \Aliziodev\Wilayah\Facades\Wilayah::forSelect('provinces');
            }
        } catch (\Throwable) {
        }

        return [];
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public function getRegenciesProperty(): array
    {
        if (! $this->province_code) {
            return [];
        }

        try {
            if (class_exists(\Aliziodev\Wilayah\Facades\Wilayah::class)) {
                return \Aliziodev\Wilayah\Facades\Wilayah::forSelect('regencies', province: $this->province_code);
            }
        } catch (\Throwable) {
        }

        return [];
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public function getDistrictsProperty(): array
    {
        if (! $this->city_code) {
            return [];
        }

        try {
            if (class_exists(\Aliziodev\Wilayah\Facades\Wilayah::class)) {
                return \Aliziodev\Wilayah\Facades\Wilayah::forSelect('districts', regency: $this->city_code);
            }
        } catch (\Throwable) {
        }

        return [];
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public function getVillagesProperty(): array
    {
        if (! $this->district_code) {
            return [];
        }

        try {
            if (class_exists(\Aliziodev\Wilayah\Facades\Wilayah::class)) {
                return \Aliziodev\Wilayah\Facades\Wilayah::forSelect('villages', district: $this->district_code);
            }
        } catch (\Throwable) {
        }

        return [];
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
        $this->step = min(5, $this->step + 1);
    }

    public function previousStep(): void
    {
        $this->step = max(1, $this->step - 1);
    }

    public function goToStep(int $target): void
    {
        if ($target < $this->step) {
            $this->step = max(1, $target);
        }
    }

    public function validateStep(int $step): void
    {
        if ($step === 1) {
            $this->validate([
                'full_name' => ['required', 'string', 'max:255'],
                'nik' => ['required', 'digits:16', new UniqueNikPerAcademicYear($this->wave?->id)],
                'nisn' => ['nullable', 'string', 'max:10'],
                'gender' => ['required', 'in:L,P'],
                'birth_place' => ['required', 'string', 'max:100'],
                'birth_date' => ['required', 'date'],
                'child_order' => ['required', 'integer', 'min:1'],
                'total_siblings' => ['nullable', 'integer', 'min:1'],
                'province' => ['nullable', 'string', 'max:100'],
                'province_code' => ['nullable', 'string', 'max:10'],
                'city' => ['nullable', 'string', 'max:100'],
                'city_code' => ['nullable', 'string', 'max:10'],
                'district' => ['nullable', 'string', 'max:100'],
                'district_code' => ['nullable', 'string', 'max:10'],
                'village' => ['nullable', 'string', 'max:100'],
                'village_code' => ['nullable', 'string', 'max:20'],
                'address' => ['required', 'string'],
            ], [
                'full_name.required' => 'Nama lengkap santri wajib diisi.',
                'nik.required' => 'NIK 16 digit wajib diisi.',
                'nik.digits' => 'NIK harus berjumlah tepat 16 digit angka.',
                'birth_place.required' => 'Tempat lahir wajib diisi.',
                'birth_date.required' => 'Tanggal lahir wajib diisi.',
                'child_order.required' => 'Anak ke- wajib diisi.',
                'address.required' => 'Detail alamat domisili wajib diisi.',
            ]);
        } elseif ($step === 2) {
            $rules = [
                'father_name' => ['required', 'string', 'max:255'],
                'father_status' => ['required', 'string'],
                'father_nik' => ['nullable', 'string', 'max:16'],
                'father_birth' => ['nullable', 'string', 'max:100'],
                'father_education' => ['nullable', 'string', 'max:100'],
                'father_job' => ['nullable', 'string', 'max:100'],
                'parent_income' => ['nullable', 'string', 'max:100'],
                'mother_name' => ['required', 'string', 'max:255'],
                'mother_status' => ['required', 'string'],
                'mother_nik' => ['nullable', 'string', 'max:16'],
                'mother_birth' => ['nullable', 'string', 'max:100'],
                'mother_education' => ['nullable', 'string', 'max:100'],
                'mother_job' => ['nullable', 'string', 'max:100'],
                'mother_phone' => ['nullable', 'string', 'max:20'],
                'guardian_type' => ['required', 'in:ayah,ibu,lainnya'],
            ];

            if ($this->father_no_wa) {
                $rules['parent_phone'] = ['nullable', 'string', 'max:20'];
                if ($this->guardian_type === 'lainnya') {
                    $rules['guardian_phone'] = ['required', 'string', 'max:20'];
                } else {
                    $rules['mother_phone'] = ['required', 'string', 'max:20'];
                }
            } else {
                $rules['parent_phone'] = ['required', 'string', 'max:20'];
            }

            if ($this->guardian_type === 'lainnya') {
                $rules['guardian_name'] = ['required', 'string', 'max:255'];
                $rules['guardian_relation'] = ['required', 'string', 'max:100'];
                $rules['guardian_phone'] = ['required', 'string', 'max:20'];
            }

            $this->validate($rules, [
                'father_name.required' => 'Nama ayah kandung wajib diisi.',
                'mother_name.required' => 'Nama ibu kandung wajib diisi.',
                'parent_phone.required' => 'Nomor WhatsApp orang tua wajib diisi.',
                'mother_phone.required' => 'Nomor WhatsApp ibu wajib diisi jika ayah tidak memiliki WhatsApp.',
                'guardian_name.required' => 'Nama wali santri wajib diisi.',
                'guardian_relation.required' => 'Hubungan wali dengan santri wajib diisi.',
                'guardian_phone.required' => 'Nomor WhatsApp wali wajib diisi.',
            ]);
        } elseif ($step === 3) {
            $this->validate([
                'previous_school' => ['required', 'string', 'max:255'],
                'school_level' => ['nullable', 'string', 'max:50'],
                'school_address' => ['nullable', 'string'],
                'program_type' => ['required', 'in:MTS,MDTA'],
            ], [
                'previous_school.required' => 'Nama sekolah asal wajib diisi.',
                'program_type.required' => 'Pilihan jenjang program tujuan wajib dipilih.',
            ]);

            $program = ProgramType::from($this->program_type);
            if (! $this->wave?->hasQuotaFor($program)) {
                $this->addError('program_type', "Kuota pendaftaran untuk program {$program->value} pada gelombang ini telah penuh.");
                throw ValidationException::withMessages([
                    'program_type' => "Kuota pendaftaran untuk program {$program->value} pada gelombang ini telah penuh.",
                ]);
            }
        } elseif ($step === 4) {
            $this->validate([
                'document_photo' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
                'document_kk' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
                'document_akta' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
                'document_ktp_ayah' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
                'document_ktp_ibu' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
                'document_ijazah' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
                'document_nisn' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
                'document_payment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            ], [
                'document_photo.required' => 'Pas foto resmi santri wajib diunggah.',
                'document_kk.required' => 'Scan Kartu Keluarga (KK) wajib diunggah.',
                'document_photo.max' => 'Ukuran pas foto maksimal 5MB.',
                'document_kk.max' => 'Ukuran berkas KK maksimal 5MB.',
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
            'agreement' => ['accepted'],
        ], [
            'agreement.accepted' => 'Anda harus menyetujui pernyataan kebenaran data sebelum mengirim pendaftaran.',
        ]);

        if ($this->province_code && empty($this->province)) {
            $this->province = \Aliziodev\Wilayah\Models\Province::where('code', $this->province_code)->value('name') ?? $this->province_code;
        }
        if ($this->city_code && empty($this->city)) {
            $this->city = \Aliziodev\Wilayah\Models\Regency::where('code', $this->city_code)->value('name') ?? $this->city_code;
        }
        if ($this->district_code && empty($this->district)) {
            $this->district = \Aliziodev\Wilayah\Models\District::where('code', $this->district_code)->value('name') ?? $this->district_code;
        }
        if ($this->village_code && empty($this->village)) {
            $this->village = \Aliziodev\Wilayah\Models\Village::where('code', $this->village_code)->value('name') ?? $this->village_code;
        }

        $fullAddress = trim(sprintf(
            '%s, Desa/Kel. %s, Kec. %s, %s, %s',
            $this->address,
            $this->village ?: '-',
            $this->district ?: '-',
            $this->city ?: '-',
            $this->province ?: '-'
        ));

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
            'total_siblings' => $this->total_siblings,
            'province' => $this->province,
            'province_code' => $this->province_code,
            'city' => $this->city,
            'city_code' => $this->city_code,
            'district' => $this->district,
            'district_code' => $this->district_code,
            'village' => $this->village,
            'village_code' => $this->village_code,
            'address' => $fullAddress,
            'previous_school' => $this->previous_school,
            'school_level' => $this->school_level,
            'school_address' => $this->school_address,
            'father_name' => $this->father_name,
            'father_status' => $this->father_status,
            'father_nik' => $this->father_nik,
            'father_birth' => $this->father_birth,
            'father_education' => $this->father_education,
            'father_pesantren' => $this->father_pesantren,
            'father_job' => $this->father_job,
            'father_no_wa' => $this->father_no_wa,
            'mother_name' => $this->mother_name,
            'mother_status' => $this->mother_status,
            'mother_nik' => $this->mother_nik,
            'mother_birth' => $this->mother_birth,
            'mother_education' => $this->mother_education,
            'mother_pesantren' => $this->mother_pesantren,
            'mother_job' => $this->mother_job,
            'mother_income' => $this->mother_income,
            'mother_no_wa' => $this->mother_no_wa,
            'mother_phone' => $this->mother_phone,
            'parent_income' => $this->parent_income,
            'parent_phone' => ! empty($this->parent_phone) ? $this->parent_phone : (! empty($this->mother_phone) ? $this->mother_phone : (! empty($this->guardian_phone) ? $this->guardian_phone : '-')),
            'parent_address' => $fullAddress,
            'guardian_type' => $this->guardian_type,
            'guardian_name' => $this->guardian_type === 'lainnya' ? $this->guardian_name : null,
            'guardian_relation' => $this->guardian_type === 'lainnya' ? $this->guardian_relation : null,
            'guardian_nik' => $this->guardian_type === 'lainnya' ? $this->guardian_nik : null,
            'guardian_phone' => $this->guardian_type === 'lainnya' ? $this->guardian_phone : null,
            'guardian_job' => $this->guardian_type === 'lainnya' ? $this->guardian_job : null,
        ];

        $files = [
            'document_photo' => $this->document_photo,
            'document_kk' => $this->document_kk,
            'document_akta' => $this->document_akta,
            'document_ktp_ayah' => $this->document_ktp_ayah,
            'document_ktp_ibu' => $this->document_ktp_ibu,
            'document_ijazah' => $this->document_ijazah,
            'document_nisn' => $this->document_nisn,
            'document_payment' => $this->document_payment,
        ];

        $applicant = $service->register($data, array_filter($files));

        return redirect()->route('psb.success', $applicant->registration_number);
    }

    public function render(): View
    {
        return view('livewire.public.psb-registration');
    }
}
