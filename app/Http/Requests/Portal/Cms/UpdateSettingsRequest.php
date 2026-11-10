<?php

declare(strict_types=1);

namespace App\Http\Requests\Portal\Cms;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->can('manage-settings');
    }

    /**
     * @return array<string, list<mixed>>
     */
    public function rules(): array
    {
        return [
            'psb_whatsapp_number' => ['nullable', 'string', 'max:25'],
            'school_name' => ['nullable', 'string', 'max:255'],
            'school_tagline' => ['nullable', 'string', 'max:255'],
            'school_address' => ['nullable', 'string'],
            'school_phone' => ['nullable', 'string', 'max:25'],
            'school_email' => ['nullable', 'string', 'max:255'],
            'maps_embed_url' => ['nullable', 'string'],
            'bank_name' => ['nullable', 'string', 'max:100'],
            'bank_account_number' => ['nullable', 'string', 'max:50'],
            'bank_account_name' => ['nullable', 'string', 'max:100'],
            'monthly_fee_mts' => ['nullable'],
            'monthly_fee_mdta' => ['nullable'],
            'psb_whatsapp_greeting' => ['nullable', 'string'],
            'psb_contact_person' => ['nullable', 'string', 'max:100'],
            'facebook_url' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'string', 'max:255'],
            'tiktok_url' => ['nullable', 'string', 'max:255'],
        ];
    }
}
