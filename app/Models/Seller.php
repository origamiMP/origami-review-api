<?php

namespace App\Models;

use App\Api\Core\Models\BaseModel;

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
