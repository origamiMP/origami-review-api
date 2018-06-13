<?php

namespace App\Models;

class MarketplaceCriteriaRating extends BaseModel
{
    protected $rules = [
        'id' => 'integer|min:0|unique:marketplace_criteria_ratings,id,{id}',
        'rating' => 'required|integer|min:0|max:5',
        'marketplace_criteria_id' => 'required|integer|min:0|exists:marketplace_criteria,id',
        'review_id' => 'required|string|exists:reviews,id'
    ];

    protected $fillable = [
        'rating', 'marketplace_criteria_id', 'review_id'
    ];

    public function marketplace_criteria()
    {
        return $this->belongsTo(MarketplaceCriteria::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
