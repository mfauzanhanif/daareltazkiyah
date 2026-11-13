<?php

declare(strict_types=1);

namespace App\Http\Requests\Portal\Psb;

use Illuminate\Foundation\Http\FormRequest;

final class CheckStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'registration_number' => ['required', 'string', 'max:50'],
            'nik' => ['required_without:access_token', 'nullable', 'string', 'max:30'],
            'access_token' => ['nullable', 'string', 'max:16'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'registration_number' => trim((string) $this->input('registration_number')),
            'nik' => $this->filled('nik') ? trim((string) $this->input('nik')) : null,
            'access_token' => $this->filled('access_token') ? trim((string) $this->input('access_token')) : null,
        ]);
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'registration_number.required' => 'Nomor pendaftaran wajib diisi.',
            'nik.required_without' => 'NIK calon santri wajib diisi.',
            'access_token.required' => 'Token akses wajib diisi.',
        ];
    }
}
