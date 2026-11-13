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
        'father_status',
        'father_nik',
        'father_birth',
        'father_education',
        'father_pesantren',
        'father_job',
        'father_no_wa',
        'mother_name',
        'mother_status',
        'mother_nik',
        'mother_birth',
        'mother_education',
        'mother_pesantren',
        'mother_job',
        'mother_no_wa',
        'mother_phone',
        'parent_income',
        'parent_phone',
        'parent_address',
        'guardian_type',
        'guardian_name',
        'guardian_relation',
        'guardian_nik',
        'guardian_phone',
        'guardian_job',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'father_pesantren' => 'boolean',
            'father_no_wa' => 'boolean',
            'mother_pesantren' => 'boolean',
            'mother_no_wa' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Applicant, $this>
     */
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }
}
