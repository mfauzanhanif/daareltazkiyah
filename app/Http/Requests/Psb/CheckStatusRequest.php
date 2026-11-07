<?php

declare(strict_types=1);

namespace App\Http\Requests\Psb;

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
            'access_token' => ['required', 'string', 'max:16'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'registration_number' => trim((string) $this->input('registration_number')),
            'access_token' => trim((string) $this->input('access_token')),
        ]);
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'registration_number.required' => 'Nomor registrasi wajib diisi.',
            'access_token.required' => 'Token akses wajib diisi.',
        ];
    }
}
