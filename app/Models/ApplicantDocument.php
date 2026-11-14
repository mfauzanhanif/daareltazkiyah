<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\DocumentType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property string $id
 * @property string $applicant_id
 * @property DocumentType $document_type
 * @property string $file_path
 * @property string $original_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ApplicantDocument extends Model implements HasMedia
{
    use HasUlids, InteractsWithMedia;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'applicant_id',
        'document_type',
        'file_path',
        'original_name',
    ];

    /**
     * @return array<string, class-string>
     */
    protected function casts(): array
    {
        return [
            'document_type' => DocumentType::class,
        ];
    }

    /**
     * @return BelongsTo<Applicant, $this>
     */
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    public function temporarySignedUrl(int $minutes = 5): string
    {
        return URL::temporarySignedRoute(
            'admin.psb.document.download',
            now()->addMinutes($minutes),
            ['document' => $this->id]
        );
    }

    public function registerMediaCollections(): void
    {
        $disk = config('filesystems.disks.private') ? 'private' : (config('filesystems.default') ?: 'local');

        $this->addMediaCollection('document')
            ->useDisk($disk)
            ->singleFile();
    }
}
