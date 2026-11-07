<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentStatus: string
{
    case Unpaid = 'unpaid';
    case PendingVerification = 'pending_verification';
    case Paid = 'paid';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Unpaid => 'Belum Dibayar',
            self::PendingVerification => 'Menunggu Verifikasi Pembayaran',
            self::Paid => 'Lunas / Terverifikasi',
            self::Rejected => 'Pembayaran Ditolak',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Unpaid => 'zinc',
            self::PendingVerification => 'amber',
            self::Paid => 'emerald',
            self::Rejected => 'rose',
        };
    }

    public function isPaid(): bool
    {
        return $this === self::Paid;
    }

    public function isPending(): bool
    {
        return $this === self::PendingVerification;
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
