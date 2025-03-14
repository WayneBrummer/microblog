<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $user_id
 * @property string $body
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 *
 * @method static PostFactory factory($count = null, $state = [])
 * @method static Builder<static>|Post newModelQuery()
 * @method static Builder<static>|Post newQuery()
 * @method static Builder<static>|Post query()
 * @method static Builder<static>|Post whereBody($value)
 * @method static Builder<static>|Post whereCreatedAt($value)
 * @method static Builder<static>|Post whereId($value)
 * @method static Builder<static>|Post whereUpdatedAt($value)
 * @method static Builder<static>|Post whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
