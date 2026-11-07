<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ApplicationStatus;
use App\Enums\ProgramType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $academic_year
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property int $fee_mts
 * @property int $fee_mdta
 * @property int|null $max_quota_mts
 * @property int|null $max_quota_mdta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class AdmissionWave extends Model
{
    use HasUlids;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'academic_year',
        'start_date',
        'end_date',
        'fee_mts',
        'fee_mdta',
        'max_quota_mts',
        'max_quota_mdta',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'fee_mts' => 'integer',
            'fee_mdta' => 'integer',
            'max_quota_mts' => 'integer',
            'max_quota_mdta' => 'integer',
        ];
    }

    /**
     * @return HasMany<Applicant, $this>
     */
    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }

    /**
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeActive(Builder $query, ?Carbon $date = null): Builder
    {
        $targetDate = ($date ?? now())->toDateString();

        return $query->whereDate('start_date', '<=', $targetDate)
            ->whereDate('end_date', '>=', $targetDate);
    }

    public static function currentActive(?Carbon $date = null): ?self
    {
        return static::query()->active($date)->first();
    }

    public function isOpen(?Carbon $date = null): bool
    {
        $targetDate = ($date ?? now())->toDateString();

        return $this->start_date->toDateString() <= $targetDate
            && $this->end_date->toDateString() >= $targetDate;
    }

    public function countApplicants(ProgramType $program): int
    {
        return $this->applicants()
            ->where('program_type', $program->value)
            ->where('application_status', '!=', ApplicationStatus::Rejected->value)
            ->count();
    }

    public function hasQuotaFor(ProgramType $program): bool
    {
        $maxQuota = $program === ProgramType::Mts ? $this->max_quota_mts : $this->max_quota_mdta;

        if ($maxQuota === null || $maxQuota === 0) {
            return true;
        }

        return $this->countApplicants($program) < $maxQuota;
    }

    public function remainingQuotaFor(ProgramType $program): ?int
    {
        $maxQuota = $program === ProgramType::Mts ? $this->max_quota_mts : $this->max_quota_mdta;

        if ($maxQuota === null || $maxQuota === 0) {
            return null;
        }

        return max(0, $maxQuota - $this->countApplicants($program));
    }

    public function feeFor(ProgramType $program): int
    {
        return $program === ProgramType::Mts ? $this->fee_mts : $this->fee_mdta;
    }
}
