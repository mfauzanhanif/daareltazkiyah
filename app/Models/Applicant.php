<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ApplicationStatus;
use App\Enums\DocumentType;
use App\Enums\Gender;
use App\Enums\PaymentStatus;
use App\Enums\ProgramType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Models\Concerns\HasActivity;
use Spatie\Activitylog\Support\LogOptions;

/**
 * @property string $id
 * @property string $admission_wave_id
 * @property string $registration_number
 * @property string $access_token
 * @property ProgramType $program_type
 * @property string $full_name
 * @property string $nik
 * @property string|null $nisn
 * @property Gender $gender
 * @property string $birth_place
 * @property Carbon $birth_date
 * @property int $child_order
 * @property string $previous_school
 * @property string $address
 * @property int $registration_fee
 * @property PaymentStatus $payment_status
 * @property ApplicationStatus $application_status
 * @property string|null $admin_notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Applicant extends Model
{
    use HasActivity, HasUlids, SoftDeletes;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'admission_wave_id',
        'registration_number',
        'access_token',
        'program_type',
        'full_name',
        'nik',
        'nisn',
        'gender',
        'birth_place',
        'birth_date',
        'child_order',
        'previous_school',
        'address',
        'registration_fee',
        'payment_status',
        'application_status',
        'admin_notes',
    ];

    /**
     * @return array<string, string|class-string>
     */
    protected function casts(): array
    {
        return [
            'program_type' => ProgramType::class,
            'gender' => Gender::class,
            'birth_date' => 'date',
            'child_order' => 'integer',
            'registration_fee' => 'integer',
            'payment_status' => PaymentStatus::class,
            'application_status' => ApplicationStatus::class,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'application_status',
                'payment_status',
                'admin_notes',
                'program_type',
                'full_name',
                'nik',
            ])
            ->logOnlyDirty()
            ->dontLogEmptyChanges()
            ->useLogName('psb_applicant')
            ->setDescriptionForEvent(fn (string $eventName): string => "Pendaftar {$this->registration_number} ({$this->full_name}) di-{$eventName}");
    }

    public function beforeActivityLogged(mixed $activity, string $event = ''): void
    {
        /** @var array<string, mixed> $properties */
        $properties = $activity->properties instanceof Collection ? $activity->properties->toArray() : [];
        $statusVal = $this->application_status->value;
        $paymentVal = $this->payment_status->value;

        $properties['application_status'] = $statusVal;
        $properties['payment_status'] = $paymentVal;
        $properties['admin_notes'] = $this->admin_notes;
        $properties['attributes'] = array_merge(
            is_array($properties['attributes'] ?? null) ? $properties['attributes'] : [],
            [
                'application_status' => $statusVal,
                'payment_status' => $paymentVal,
                'admin_notes' => $this->admin_notes,
            ]
        );

        $activity->properties = new Collection($properties);
    }

    /**
     * @return BelongsTo<AdmissionWave, $this>
     */
    public function admissionWave(): BelongsTo
    {
        return $this->belongsTo(AdmissionWave::class);
    }

    /**
     * @return HasOne<ApplicantParent, $this>
     */
    public function parent(): HasOne
    {
        return $this->hasOne(ApplicantParent::class);
    }

    /**
     * @return HasMany<ApplicantDocument, $this>
     */
    public function documents(): HasMany
    {
        return $this->hasMany(ApplicantDocument::class);
    }

    /**
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeProgram(Builder $query, ProgramType|string $program): Builder
    {
        $val = $program instanceof ProgramType ? $program->value : $program;

        return $query->where('program_type', $val);
    }

    /**
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeStatus(Builder $query, ApplicationStatus|string $status): Builder
    {
        $val = $status instanceof ApplicationStatus ? $status->value : $status;

        return $query->where('application_status', $val);
    }

    /**
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopePaymentStatus(Builder $query, PaymentStatus|string $status): Builder
    {
        $val = $status instanceof PaymentStatus ? $status->value : $status;

        return $query->where('payment_status', $val);
    }

    /**
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query->where(function (Builder $q) use ($term): void {
            $q->where('registration_number', 'like', "%{$term}%")
                ->orWhere('full_name', 'like', "%{$term}%")
                ->orWhere('nik', 'like', "%{$term}%")
                ->orWhere('nisn', 'like', "%{$term}%");
        });
    }

    public function canBeEdited(): bool
    {
        return $this->application_status->canBeEditedByApplicant();
    }

    public function document(DocumentType $type): ?ApplicantDocument
    {
        if ($this->relationLoaded('documents')) {
            return $this->documents->first(fn (ApplicantDocument $doc): bool => $doc->document_type === $type);
        }

        return $this->documents()->where('document_type', $type->value)->first();
    }

    public function updateStatus(ApplicationStatus $status, ?string $notes = null): void
    {
        $this->application_status = $status;
        if ($notes !== null) {
            $this->admin_notes = $notes;
        }
        $this->save();
    }

    public function updatePaymentStatus(PaymentStatus $status, ?string $notes = null): void
    {
        $this->payment_status = $status;
        if ($notes !== null) {
            $this->admin_notes = $notes;
        }
        $this->save();
    }
}
