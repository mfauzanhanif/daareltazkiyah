<?php

declare(strict_types=1);

namespace App\Enums;

enum ApplicationStatus: string
{
    case Pending = 'pending';
    case Verified = 'verified';
    case RevisionNeeded = 'revision_needed';
    case Accepted = 'accepted';
    case Reserve = 'reserve';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Menunggu Verifikasi',
            self::Verified => 'Terverifikasi',
            self::RevisionNeeded => 'Perlu Perbaikan / Revisi',
            self::Accepted => 'Diterima',
            self::Reserve => 'Cadangan',
            self::Rejected => 'Tidak Diterima / Ditolak',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Pending => 'amber',
            self::Verified => 'sky',
            self::RevisionNeeded => 'orange',
            self::Accepted => 'emerald',
            self::Reserve => 'purple',
            self::Rejected => 'rose',
        };
    }

    public function canBeEditedByApplicant(): bool
    {
        return match ($this) {
            self::Pending, self::RevisionNeeded => true,
            default => false,
        };
    }

    public function isAccepted(): bool
    {
        return $this === self::Accepted;
    }

    public function isRejected(): bool
    {
        return $this === self::Rejected;
    }

    public function isPending(): bool
    {
        return $this === self::Pending;
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
