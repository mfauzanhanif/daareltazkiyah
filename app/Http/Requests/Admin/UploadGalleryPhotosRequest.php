<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

final class UploadGalleryPhotosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage-cms') ?? false;
    }

    /**
     * @return array<string, list<mixed>>
     */
    public function rules(): array
    {
        return [
            'photos' => ['required', 'array'],
            'photos.*' => ['required', 'image', 'max:4096'],
            'caption' => ['nullable', 'string', 'max:255'],
        ];
    }
}
