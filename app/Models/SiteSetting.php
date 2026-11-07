<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SettingGroup;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

/**
 * @property string $id
 * @property string $key
 * @property string|null $value
 * @property SettingGroup $group
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class SiteSetting extends Model
{
    use HasUlids;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * @return array<string, class-string>
     */
    protected function casts(): array
    {
        return [
            'group' => SettingGroup::class,
        ];
    }

    protected static function booted(): void
    {
        static::saved(function (self $setting): void {
            Cache::forget("site_setting.{$setting->key}");
            Cache::forget('site_settings.all');
        });

        static::deleted(function (self $setting): void {
            Cache::forget("site_setting.{$setting->key}");
            Cache::forget('site_settings.all');
        });
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("site_setting.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();

            return $setting !== null ? $setting->value : $default;
        });
    }

    public static function set(string $key, mixed $value, ?SettingGroup $group = null): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => (string) $value,
                'group' => $group ?? SettingGroup::General,
            ]
        );

        Cache::forget("site_setting.{$key}");
        Cache::forget('site_settings.all');

        return $setting;
    }
}
