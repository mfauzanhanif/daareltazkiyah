<?php

declare(strict_types=1);

namespace App\Enums;

enum PostStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Scheduled = 'scheduled';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Diterbitkan',
            self::Scheduled => 'Terjadwal',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Draft => 'zinc',
            self::Published => 'emerald',
            self::Scheduled => 'amber',
        };
    }

    public function isPublished(): bool
    {
        return $this === self::Published;
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $status): array => [$status->value => $status->label()])
            ->all();
    }
}
