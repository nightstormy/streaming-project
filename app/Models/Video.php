<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $user_id
 */
class Video extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'videos';
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'channel_id',
        'title',
        'description',
        'uid',
        'path',
        'processed_file',
        'visibility',
        'processed',
        'allow_likes',
        'allow_comments',
        'processing_percentage'
    ];

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'channel_id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'uid' => 'string',
        'path' => 'string',
        'processed_file' => 'string',
        'visibility' => 'string',
        'processed' => 'boolean',
        'allow_likes' => 'boolean',
        'allow_comments' => 'boolean',
        'processing_percentage' => 'string'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'uid';
    }

    /**
     * @return BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
}
