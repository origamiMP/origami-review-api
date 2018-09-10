<?php

namespace App\Models;

use App\Uuids;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Marketplace
 *
 * @property int $id
 * @property string $name
 * @property string $image_cover
 * @property string $image_profile
 * @property string $description
 * @property string $website_link
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property int $verified_rating_total
 * @property int $verified_rating_count
 * @property int $unverified_rating_total
 * @property int $unverified_rating_count
 * @property string $wallet
 * @property int $default_review_delay
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Marketplace[] $marketplace_criteria
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReviewComment[] $review_comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @method static Builder|Marketplace whereCreatedAt($value)
 * @method static Builder|Marketplace whereDefaultReviewDelay($value)
 * @method static Builder|Marketplace whereId($value)
 * @method static Builder|Marketplace whereName($value)
 * @method static Builder|Marketplace whereUpdatedAt($value)
 * @method static Builder|Marketplace whereWallet($value)
 * @mixin Eloquent
 */
class Marketplace extends BaseModel
{
    use Uuids;

    public $incrementing = false;

    protected $rules = [
        'id' => 'string|unique:marketplaces,id,{id}',
        'name' => 'required|string',
        'verified_rating_total' => 'integer|min:0',
        'verified_rating_count' => 'integer|min:0',
        'unverified_rating_total' => 'integer|min:0',
        'unverified_rating_count' => 'integer|min:0',
        'wallet' => 'nullable|string|unique:marketplaces,wallet,{wallet}',
        'default_review_delay' => 'integer|min:0'
    ];

    protected $fillable = [
        'name', 'wallet', 'default_review_delay'
    ];

    public function users()
    {
        return $this->morphMany(User::class, 'organization');
    }

    public function review_comments()
    {
        return $this->morphMany(ReviewComment::class, 'author');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function marketplace_criteria()
    {
        return $this->hasMany(MarketplaceCriteria::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(Review::class, Order::class);
    }

    public function waiting_reviews()
    {
        return $this->reviews->where('review_state_id', ReviewState::getCreatedReviewState()->id);
    }
}
