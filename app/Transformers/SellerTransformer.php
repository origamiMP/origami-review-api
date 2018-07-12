<?php

namespace App\Transformers;

use App\Models\Seller;

class SellerTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'users', 'orders', 'review_comments'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Seller $seller
     * @return array
     */
    public function transform(Seller $seller)
    {
        return parent::meta([
            'id' => $seller->id,
            'name' => $seller->name,
            'verified_rating_count' => $seller->verified_rating_count,
            'verified_rating_total' => $seller->verified_rating_total,
            'unverified_rating_count' => $seller->unverified_rating_count,
            'unverified_rating_total' => $seller->unverified_rating_total,
            'average_verified_rating' => $seller->verified_rating_count == 0 ? 0 : $seller->verified_rating_total / $seller->verified_rating_count,
            'image_cover' => $seller->image_cover,
            'image_profile' => $seller->image_profile,
            'created_at' => $seller->created_at,
            'updated_at' => $seller->updated_at
        ]);
    }

    public function includeUsers(Seller $seller)
    {
        return $this->item($seller->users, new UserTransformer());
    }

    public function includeOrders(Seller $seller)
    {
        return $this->item($seller->orders, new OrderTransformer());
    }

    public function includeReviewComments(Seller $seller)
    {
        return $this->item($seller->review_comments, new ReviewCommentTransformer());
    }

    public function includeReviews(Seller $seller)
    {
        return $this->collection($seller->reviews, new ReviewTransformer());
    }
}