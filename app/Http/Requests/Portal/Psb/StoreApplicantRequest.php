<?php

declare(strict_types=1);

namespace App\Http\Requests\Portal\Psb;

use App\Enums\ProgramType;
use App\Models\AdmissionWave;
use App\Rules\UniqueNikPerAcademicYear;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

final class StoreApplicantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'admission_wave_id' => ['required', 'exists:admission_waves,id'],
            'program_type' => ['required', 'in:MTS,MDTA'],
            'full_name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'digits:16', new UniqueNikPerAcademicYear((string) $this->input('admission_wave_id'))],
            'nisn' => ['nullable', 'string', 'max:10'],
            'gender' => ['required', 'in:L,P'],
            'birth_place' => ['required', 'string', 'max:100'],
            'birth_date' => ['required', 'date'],
            'child_order' => ['required', 'integer', 'min:1'],
            'total_siblings' => ['nullable', 'integer', 'min:1'],
            'previous_school' => ['required', 'string', 'max:255'],
            'school_level' => ['nullable', 'string', 'max:50'],
            'school_address' => ['nullable', 'string'],
            'address' => ['required', 'string'],
            'province' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'district' => ['nullable', 'string', 'max:100'],
            'village' => ['nullable', 'string', 'max:100'],
            'father_name' => ['required', 'string', 'max:255'],
            'father_status' => ['nullable', 'string', 'max:50'],
            'father_nik' => ['nullable', 'string', 'max:16'],
            'father_birth' => ['nullable', 'string', 'max:100'],
            'father_education' => ['nullable', 'string', 'max:100'],
            'father_pesantren' => ['nullable', 'boolean'],
            'father_job' => ['nullable', 'string', 'max:100'],
            'father_no_wa' => ['nullable', 'boolean'],
            'mother_name' => ['required', 'string', 'max:255'],
            'mother_status' => ['nullable', 'string', 'max:50'],
            'mother_nik' => ['nullable', 'string', 'max:16'],
            'mother_birth' => ['nullable', 'string', 'max:100'],
            'mother_education' => ['nullable', 'string', 'max:100'],
            'mother_pesantren' => ['nullable', 'boolean'],
            'mother_job' => ['nullable', 'string', 'max:100'],
            'mother_income' => ['nullable', 'string', 'max:100'],
            'mother_no_wa' => ['nullable', 'boolean'],
            'mother_phone' => ['nullable', 'string', 'max:20'],
            'parent_income' => ['nullable', 'string', 'max:100'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'parent_address' => ['nullable', 'string'],
            'guardian_type' => ['nullable', 'in:ayah,ibu,lainnya'],
            'guardian_name' => ['nullable', 'string', 'max:255'],
            'guardian_relation' => ['nullable', 'string', 'max:100'],
            'guardian_nik' => ['nullable', 'string', 'max:16'],
            'guardian_phone' => ['nullable', 'string', 'max:20'],
            'guardian_job' => ['nullable', 'string', 'max:100'],
            'document_photo' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'document_kk' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_akta' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_payment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_ktp_ayah' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_ktp_ibu' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_ijazah' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_nisn' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $waveId = (string) $this->input('admission_wave_id');
            $programType = (string) $this->input('program_type');

            if (! $waveId || ! $programType) {
                return;
            }

            $wave = AdmissionWave::find($waveId);
            if (! $wave || ! $wave->isOpen()) {
                $validator->errors()->add('admission_wave_id', 'Gelombang pendaftaran yang dipilih sedang ditutup atau tidak aktif.');

                return;
            }

            $program = ProgramType::tryFrom($programType);
            if ($program && ! $wave->hasQuotaFor($program)) {
                $validator->errors()->add('program_type', "Kuota pendaftaran untuk program {$program->value} pada gelombang ini telah penuh.");
            }
        });
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nik.digits' => 'NIK harus berjumlah tepat 16 digit angka.',
            'admission_wave_id.required' => 'Gelombang pendaftaran wajib dipilih.',
            'admission_wave_id.exists' => 'Gelombang pendaftaran tidak ditemukan.',
            'program_type.required' => 'Jenjang program pendidikan wajib dipilih.',
            'program_type.in' => 'Program pendidikan harus MTS atau MDTA.',
            'document_photo.max' => 'Ukuran pasfoto tidak boleh melebihi 2MB.',
            'document_kk.max' => 'Ukuran berkas Kartu Keluarga tidak boleh melebihi 2MB.',
            'document_akta.max' => 'Ukuran berkas Akta Kelahiran tidak boleh melebihi 2MB.',
            'document_payment.max' => 'Ukuran bukti pembayaran tidak boleh melebihi 2MB.',
        ];
    }
}
