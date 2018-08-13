<?php

namespace App\Transformers;

use App\Models\Marketplace;

class MarketplaceTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'users', 'review_comments', 'orders', 'marketplace_criteria'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Marketplace $marketplace
     * @return array
     */
    public function transform(Marketplace $marketplace)
    {
        return parent::meta([
            'id' => $marketplace->id,
            'type' => "marketplace",
            'name' => $marketplace->name,
            'wallet' => $marketplace->wallet,
            'default_review_delay' => $marketplace->default_review_delay,
            'created_at' => $marketplace->created_at,
            'updated_at' => $marketplace->updated_at
        ]);
    }

    public function includeUsers(Marketplace $marketplace)
    {
        return $this->collection($marketplace->users, new UserTransformer());
    }

    public function includeOrders(Marketplace $marketplace)
    {
        return $this->collection($marketplace->orders, new OrderTransformer());
    }

    public function includeReviewComments(Marketplace $marketplace)
    {
        return $this->collection($marketplace->review_comments, new ReviewCommentTransformer());
    }

    public function includeMarketplaceCriteria(Marketplace $marketplace)
    {
        return $this->collection($marketplace->marketplace_criteria, new MarketplaceCriteriaTransformer(), 'marketplace_criteria');
    }

}