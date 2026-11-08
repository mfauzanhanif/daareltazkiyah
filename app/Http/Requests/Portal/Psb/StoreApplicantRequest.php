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
            'previous_school' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'father_name' => ['required', 'string', 'max:255'],
            'mother_name' => ['required', 'string', 'max:255'],
            'father_job' => ['nullable', 'string', 'max:100'],
            'mother_job' => ['nullable', 'string', 'max:100'],
            'parent_income' => ['nullable', 'string', 'max:100'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'parent_address' => ['nullable', 'string'],
            'document_photo' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'document_kk' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_akta' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_payment' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
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
