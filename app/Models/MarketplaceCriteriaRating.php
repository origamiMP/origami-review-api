<?php

namespace App\Models;

/**
 * App\Models\MarketplaceCriteriaRating
 *
 * @property int $id
 * @property int $rating
 * @property int $marketplace_criteria_id
 * @property string $review_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\MarketplaceCriteria $marketplace_criteria
 * @property-read \App\Models\Review $review
 * @method static Builder|\App\Models\MarketplaceCriteriaRating whereCreatedAt($value)
 * @method static Builder|\App\Models\MarketplaceCriteriaRating whereId($value)
 * @method static Builder|\App\Models\MarketplaceCriteriaRating whereMarketplaceCriteriaId($value)
 * @method static Builder|\App\Models\MarketplaceCriteriaRating whereRating($value)
 * @method static Builder|\App\Models\MarketplaceCriteriaRating whereReviewId($value)
 * @method static Builder|\App\Models\MarketplaceCriteriaRating whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
