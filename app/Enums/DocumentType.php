<?php

declare(strict_types=1);

namespace App\Enums;

enum DocumentType: string
{
    case Photo = 'photo';
    case Kk = 'kk';
    case Akta = 'akta';
    case PaymentProof = 'payment_proof';
    case KtpFather = 'ktp_father';
    case KtpMother = 'ktp_mother';
    case Ijazah = 'ijazah';
    case PrintNisn = 'print_nisn';

    public function label(): string
    {
        return match ($this) {
            self::Photo => 'Pas Foto Santri (3x4 Resmi)',
            self::Kk => 'Kartu Keluarga (KK)',
            self::Akta => 'Akta Kelahiran',
            self::PaymentProof => 'Bukti Transfer Biaya Pendaftaran',
            self::KtpFather => 'KTP Ayah Kandung',
            self::KtpMother => 'KTP Ibu Kandung',
            self::Ijazah => 'Ijazah / SKL SD/MI',
            self::PrintNisn => 'Print Out NISN Resmi',
        };
    }

    public function maxSizeBytes(): int
    {
        return 5 * 1024 * 1024; // 5MB
    }

    /**
     * @return list<string>
     */
    public function allowedExtensions(): array
    {
        return match ($this) {
            self::Photo => ['jpg', 'jpeg', 'png'],
            self::Kk, self::Akta, self::PaymentProof, self::KtpFather, self::KtpMother, self::Ijazah, self::PrintNisn => ['jpg', 'jpeg', 'png', 'pdf'],
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $doc): array => [$doc->value => $doc->label()])
            ->all();
    }
}
