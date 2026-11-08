<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $post_id
 * @property Carbon $viewed_at
 * @property int $count
 */
class PostView extends Model
{
    use HasUlids;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'post_id',
        'viewed_at',
        'count',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'viewed_at' => 'date',
            'count' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<Post, $this>
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public static function recordView(string $postId, ?Carbon $date = null): self
    {
        $viewDate = ($date ?? now())->toDateString();

        try {
            /** @var self $record */
            $record = static::firstOrCreate(
                ['post_id' => $postId, 'viewed_at' => $viewDate],
                ['count' => 0]
            );

            $record->increment('count');

            return $record;
        } catch (QueryException) {
            /** @var self $record */
            $record = static::where('post_id', $postId)
                ->where('viewed_at', $viewDate)
                ->firstOrFail();

            $record->increment('count');

            return $record;
        }
    }
}
