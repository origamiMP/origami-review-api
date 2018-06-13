<?php

namespace App\Models;

use App\Api\Core\Models\BaseModel;

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
        return $this->hasMany(Marketplace::class);
    }
}
