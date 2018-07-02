<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\ReviewComment
 *
 * @property int $id
 * @property string $text
 * @property string $author_ip
 * @property string $review_id
 * @property int $author_id
 * @property string $author_type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|Eloquent $author
 * @property-read \App\Models\Review $review
 * @method static Builder|ReviewComment whereAuthorId($value)
 * @method static Builder|ReviewComment whereAuthorIp($value)
 * @method static Builder|ReviewComment whereAuthorType($value)
 * @method static Builder|ReviewComment whereCreatedAt($value)
 * @method static Builder|ReviewComment whereId($value)
 * @method static Builder|ReviewComment whereReviewId($value)
 * @method static Builder|ReviewComment whereText($value)
 * @method static Builder|ReviewComment whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ReviewComment extends BaseModel
{
    protected $rules = [
        'id' => 'integer|min:0|unique:review_states,id,{id}',
        'text' => 'required|string',
        'review_id' => 'required|string|exists:reviews,id',
        'author_id' => 'required|integer|min:0',
        'author_type' => 'required|string|in:\App\Models\Customer,\App\Models\Marketplace,\App\Models\Seller',
        'author_ip' => 'required|ip'
    ];

    protected $fillable = [
        'text', 'review_id', 'author_id', 'author_type', 'author_ip'
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function author()
    {
        return $this->morphTo();
    }
}
