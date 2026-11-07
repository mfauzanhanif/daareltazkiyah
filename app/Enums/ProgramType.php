<?php

declare(strict_types=1);

namespace App\Enums;

enum ProgramType: string
{
    case Mts = 'MTS';
    case Mdta = 'MDTA';

    public function label(): string
    {
        return match ($this) {
            self::Mts => 'Madrasah Tsanawiyah (MTS - Mukim 24 Jam)',
            self::Mdta => 'Madrasah Diniyah Takmiliyah Awaliyah (MDTA - Sekolah Sore)',
        };
    }

    public function shortLabel(): string
    {
        return match ($this) {
            self::Mts => 'MTS (Mukim)',
            self::Mdta => 'MDTA (Sore)',
        };
    }

    public function prefix(): string
    {
        return $this->value;
    }

    public function isMts(): bool
    {
        return $this === self::Mts;
    }

    public function isMdta(): bool
    {
        return $this === self::Mdta;
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Mts => 'emerald',
            self::Mdta => 'amber',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $program): array => [$program->value => $program->label()])
            ->all();
    }
}
