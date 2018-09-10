<?php

namespace App\Transformers;

use App\Models\Seller;

class SellerTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'users', 'orders', 'review_comments', 'reviews'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Seller $seller
     * @return array
     */
    public function transform(Seller $seller)
    {
        $reviewCount = $seller->reviews->count();

        $fiveRatingRatio = $reviewCount == 0 ? 0 : $seller->reviews->where('rating', 5)->count();
        $fourRatingRatio = $reviewCount == 0 ? 0 : $seller->reviews->where('rating', 4)->count();
        $threeRatingRatio = $reviewCount == 0 ? 0 : $seller->reviews->where('rating', 3)->count();
        $twoRatingRatio = $reviewCount == 0 ? 0 : $seller->reviews->where('rating', 2)->count();
        $oneRatingRatio = $reviewCount == 0 ? 0 : $seller->reviews->where('rating', 1)->count();

        return parent::meta([
            'id' => $seller->id,
            'type' => "seller",
            'name' => $seller->name,
            'verified_rating_count' => $seller->verified_rating_count,
            'verified_rating_total' => $seller->verified_rating_total,
            'unverified_rating_count' => $seller->unverified_rating_count,
            'unverified_rating_total' => $seller->unverified_rating_total,
            'average_verified_rating' => $seller->verified_rating_count == 0 ? 0 : round($seller->verified_rating_total / $seller->verified_rating_count),
            'average_rating' => $seller->unverified_rating_count + $seller->verified_rating_count == 0 ? 0 : round(($seller->verified_rating_total + $seller->unverified_rating_total) / ($seller->unverified_rating_count + $seller->verified_rating_count)),

            'image_cover' => $seller->image_cover,
            'image_profile' => $seller->image_profile,
            'description' => $seller->description,
            'website_link' => $seller->website_link,
            'email' => $seller->email,
            'phone' => $seller->phone,
            'address' => $seller->address,

            'five_rating_reviews_ratio' => $fiveRatingRatio,
            'four_rating_reviews_ratio' => $fourRatingRatio,
            'three_rating_reviews_ratio' => $threeRatingRatio,
            'two_rating_reviews_ratio' => $twoRatingRatio,
            'one_rating_reviews_ratio' => $oneRatingRatio,

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
        return $this->collection($seller->reviews, new ReviewTransformer(), 'reviews');
    }
}