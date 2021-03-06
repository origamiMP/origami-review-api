<?php

namespace App\Models;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;


/**
 * App\Models\Marketplace
 *
 * @property int $id
 * @property string $name
 * @property string $wallet
 * @property int $default_review_delay
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Marketplace[] $marketplace_criteria
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReviewComment[] $review_comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
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
    protected $rules = [
        'id' => 'integer|min:0|unique:marketplaces,id,{id}',
        'name' => 'required|string|unique:marketplaces,name,{name}',
        'wallet' => 'required|string|unique:marketplaces,wallet,{wallet}',
        'default_review_delay' => 'required|integer|min:0'
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
}
