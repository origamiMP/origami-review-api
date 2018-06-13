<?php

namespace App\Models;

class ReviewComment extends BaseModel
{
    protected $rules = [
        'id' => 'integer|min:0|unique:review_states,id,{id}',
        'text' => 'required|string',
        'review_id' => 'required|string|exists:reviews,id',
        'author_id' => 'required|integer|min:0',
        'author_type' => 'required|string|in:customers,sellers,marketplaces',
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
