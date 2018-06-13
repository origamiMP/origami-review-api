<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Barryvdh\LaravelIdeHelper\Eloquent;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReviewComment[] $review_comments
 * @method static Builder|Customer whereCreatedAt($value)
 * @method static Builder|Customer whereEmail($value)
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereName($value)
 * @method static Builder|Customer whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Customer extends BaseModel
{
    protected $rules = [
        'id' => 'integer|min:0|unique:customers,id,{id}',
        'name' => 'required|string',
        'email' => 'required|string|unique:customers,email,{email}',
    ];

    protected $fillable = [
        'name', 'email'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function review_comments()
    {
        return $this->morphMany(ReviewComment::class, 'author');
    }
}
