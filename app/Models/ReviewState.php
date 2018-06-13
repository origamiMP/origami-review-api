<?php

namespace App\Models;

use App\Api\Core\Models\BaseModel;

class ReviewState extends BaseModel
{
    protected $rules = [
        'id' => 'integer|min:0|unique:review_states,id,{id}',
        'name' => 'required|string'
    ];

    protected $fillable = [
        'name'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
