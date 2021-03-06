<?php

namespace App\Models;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Seller
 *
 * @property int $id
 * @property string $name
 * @property string $uuid
 * @property int $verified_rating_total
 * @property int $verified_rating_count
 * @property int $unverified_rating_total
 * @property int $unverified_rating_count
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReviewComment[] $review_comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static Builder|Seller whereCreatedAt($value)
 * @method static Builder|Seller whereId($value)
 * @method static Builder|Seller whereName($value)
 * @method static Builder|Seller whereUnverifiedRatingCount($value)
 * @method static Builder|Seller whereUnverifiedRatingTotal($value)
 * @method static Builder|Seller whereUpdatedAt($value)
 * @method static Builder|Seller whereUuid($value)
 * @method static Builder|Seller whereVerifiedRatingCount($value)
 * @method static Builder|Seller whereVerifiedRatingTotal($value)
 * @mixin Eloquent
 */
class Seller extends BaseModel
{
    protected $rules = [
        'id' => 'integer|min:0|unique:sellers,id,{id}',
        'name' => 'required|string|unique:sellers,name,{name}',
        'uuid' => 'required|string|unique:sellers,uuid,{uuid}',
        'verified_rating_total' => 'required|integer|min:0',
        'verified_rating_count' => 'required|integer|min:0',
        'unverified_rating_total' => 'required|integer|min:0',
        'unverified_rating_count' => 'required|integer|min:0',
    ];

    protected $fillable = [
        'name', 'uuid', 'verified_rating_total', 'verified_rating_count', 'unverified_rating_total',
        'unverified_rating_count'
    ];

    public function users()
    {
        return $this->morphMany(User::class, 'organization');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function review_comments()
    {
        return $this->morphMany(ReviewComment::class, 'author');
    }
}
