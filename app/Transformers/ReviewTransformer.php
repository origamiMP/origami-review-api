<?php

namespace App\Transformers;

use App\Models\Review;

class ReviewTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'order', 'review_state', 'review_comments', 'marketplace_criteria_ratings', 'reward'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Review $review
     * @return array
     */
    public function transform(Review $review)
    {
        return parent::meta([
            'id' => $review->id,
            'wallet' => $review->wallet,
            'text' => $review->text,
            'rating' => $review->rating,
            'ddb_node_id' => $review->ddb_node_id,
            'ddb_supplier' => $review->ddb_supplier,
            'blockchain_block_id' => $review->blockchain_block_id,
            'blockchain_tx_id' => $review->blockchain_tx_id,
            'blockchain_supplier' => $review->blockchain_supplier,
            'created_at' => $review->created_at->toDateTimeString(),
            'updated_at' => $review->updated_at
        ]);
    }

    public function includeOrder(Review $review)
    {
        return $this->item($review->order, new OrderTransformer(), 'orders');
    }

    public function includeReviewComments(Review $review)
    {
        return $this->collection($review->review_comments, new ReviewCommentTransformer(), "review_comments");
    }

    public function includeReviewState(Review $review)
    {
        return $this->item($review->review_state, new ReviewStateTransformer(), 'review_states');
    }

    public function includeReward(Review $review)
    {
        return $this->item($review->reward, new RewardTransformer(), 'rewards');
    }

    public function includeMarketplaceCriteriaRatings(Review $review)
    {
        return $this->item($review->marketplace_criteria_ratings, new MarketplaceCriteriaRatingTransformer());
    }

}