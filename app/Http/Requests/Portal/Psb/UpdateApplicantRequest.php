<?php

declare(strict_types=1);

namespace App\Http\Requests\Portal\Psb;

use App\Models\Applicant;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateApplicantRequest extends FormRequest
{
    public function authorize(): bool
    {
        $regNumber = (string) $this->route('registration_number');
        $token = (string) $this->input('access_token');
        $nik = (string) $this->input('nik');

        $query = Applicant::query()->where('registration_number', $regNumber);

        if (! empty($token)) {
            $query->where('access_token', $token);
        } elseif (! empty($nik)) {
            $query->where('nik', $nik);
        } else {
            return false;
        }

        $applicant = $query->first();

        if (! $applicant) {
            return false;
        }

        return $applicant->canBeEdited();
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'access_token' => ['nullable', 'string'],
            'nik' => ['nullable', 'string', 'max:30'],
            'full_name' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'in:L,P'],
            'birth_place' => ['nullable', 'string', 'max:100'],
            'birth_date' => ['nullable', 'date'],
            'child_order' => ['nullable', 'integer', 'min:1'],
            'previous_school' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'mother_name' => ['nullable', 'string', 'max:255'],
            'father_job' => ['nullable', 'string', 'max:100'],
            'mother_job' => ['nullable', 'string', 'max:100'],
            'parent_income' => ['nullable', 'string', 'max:100'],
            'parent_phone' => ['nullable', 'string', 'max:20'],
            'parent_address' => ['nullable', 'string'],
            'document_photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'document_kk' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_akta' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_payment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_ktp_ayah' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_ktp_ibu' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_ijazah' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'document_nisn' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ];
    }
}
