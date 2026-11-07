<?php

declare(strict_types=1);

namespace App\Enums;

enum SettingGroup: string
{
    case General = 'general';
    case Psb = 'psb';
    case SocialMedia = 'social_media';
    case Billing = 'billing';

    public function label(): string
    {
        return match ($this) {
            self::General => 'Informasi Umum & Kontak',
            self::Psb => 'Informasi PSB & WhatsApp',
            self::SocialMedia => 'Media Sosial',
            self::Billing => 'Rekening & Biaya Pendidikan',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $group): array => [$group->value => $group->label()])
            ->all();
    }
}
