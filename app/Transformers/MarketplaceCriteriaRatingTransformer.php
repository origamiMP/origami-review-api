<?php

namespace App\Transformers;

use App\Models\MarketplaceCriteriaRating;

class MarketplaceCriteriaRatingTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'marketplace_criteria', 'review'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param MarketplaceCriteriaRating $marketplaceCriteriaRating
     * @return array
     */
    public function transform(MarketplaceCriteriaRating $marketplaceCriteriaRating)
    {
        return parent::meta([
            'id' => $marketplaceCriteriaRating->id,
            'rating' => $marketplaceCriteriaRating->rating,
            'created_at' => $marketplaceCriteriaRating->created_at,
            'updated_at' => $marketplaceCriteriaRating->updated_at
        ]);
    }

    public function includeMarketplaceCriteria(MarketplaceCriteriaRating $marketplaceCriteriaRating)
    {
        return $this->item($marketplaceCriteriaRating->marketplace_criteria, new MarketplaceCriteriaTransformer());
    }

    public function includeReview(MarketplaceCriteriaRating $marketplaceCriteriaRating)
    {
        return $this->item($marketplaceCriteriaRating->review, new ReviewTransformer());
    }
}