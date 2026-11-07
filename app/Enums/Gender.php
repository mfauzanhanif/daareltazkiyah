<?php

declare(strict_types=1);

namespace App\Enums;

enum Gender: string
{
    case Male = 'L';
    case Female = 'P';

    public function label(): string
    {
        return match ($this) {
            self::Male => 'Laki-laki',
            self::Female => 'Perempuan',
        };
    }

    public function isMale(): bool
    {
        return $this === self::Male;
    }

    public function isFemale(): bool
    {
        return $this === self::Female;
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $gender): array => [$gender->value => $gender->label()])
            ->all();
    }
}
