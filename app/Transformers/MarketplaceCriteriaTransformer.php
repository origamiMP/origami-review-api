<?php namespace App\Transformers;

use App\Models\MarketplaceCriteria;

class MarketplaceCriteriaTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'marketplace', 'marketplace_criteria_rating'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param MarketplaceCriteria $marketplaceCriteria
     * @return array
     */
    public function transform(MarketplaceCriteria $marketplaceCriteria)
    {
        return parent::meta([
            'id' => $marketplaceCriteria->id,
            'name' => $marketplaceCriteria->name,
            'weight' => $marketplaceCriteria->weight,
            'created_at' => $marketplaceCriteria->created_at,
            'updated_at' => $marketplaceCriteria->updated_at
        ]);
    }

    public function includeMarketplace(MarketplaceCriteria $marketplaceCriteria)
    {
        return $this->item($marketplaceCriteria->marketplace, new MarketplaceTransformer());
    }

    public function includeMarketplaceCriteriaRating(MarketplaceCriteria $marketplaceCriteria)
    {
        return $this->collection($marketplaceCriteria->marketplace_criteria_ratings, new MarketplaceCriteriaRatingTransformer());
    }
}