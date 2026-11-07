<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $applicant_id
 * @property string $father_name
 * @property string $mother_name
 * @property string|null $father_job
 * @property string|null $mother_job
 * @property string|null $parent_income
 * @property string $parent_phone
 * @property string $parent_address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ApplicantParent extends Model
{
    use HasUlids;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'applicant_id',
        'father_name',
        'mother_name',
        'father_job',
        'mother_job',
        'parent_income',
        'parent_phone',
        'parent_address',
    ];

    /**
     * @return BelongsTo<Applicant, $this>
     */
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }
}
