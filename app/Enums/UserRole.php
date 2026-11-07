<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case AdminCms = 'admin_cms';
    case AdminPsb = 'admin_psb';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Administrator',
            self::AdminCms => 'Admin CMS & Berita',
            self::AdminPsb => 'Panitia PSB',
        };
    }

    public function isSuperAdmin(): bool
    {
        return $this === self::SuperAdmin;
    }

    public function isAdminCms(): bool
    {
        return $this === self::AdminCms;
    }

    public function isAdminPsb(): bool
    {
        return $this === self::AdminPsb;
    }

    public function canManageCms(): bool
    {
        return match ($this) {
            self::SuperAdmin, self::AdminCms => true,
            default => false,
        };
    }

    public function canManagePsb(): bool
    {
        return match ($this) {
            self::SuperAdmin, self::AdminPsb => true,
            default => false,
        };
    }

    public function canManageSettings(): bool
    {
        return $this === self::SuperAdmin;
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $role): array => [$role->value => $role->label()])
            ->all();
    }
}
