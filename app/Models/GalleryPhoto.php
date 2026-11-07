<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $gallery_id
 * @property string $file_path
 * @property string|null $caption
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class GalleryPhoto extends Model
{
    use HasUlids;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'gallery_id',
        'file_path',
        'caption',
        'sort_order',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<Gallery, $this>
     */
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
