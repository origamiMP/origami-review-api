<?php

namespace App\Models;

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
