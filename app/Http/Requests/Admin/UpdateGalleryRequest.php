<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateGalleryRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('galleries', 'slug')->ignore($this->route('id')),
            ],
            'description' => ['nullable', 'string'],
            'event_date' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
