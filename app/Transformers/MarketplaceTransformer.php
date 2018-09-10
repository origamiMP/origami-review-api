<?php

namespace App\Transformers;

use App\Models\Marketplace;

class MarketplaceTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'reviews', 'users', 'review_comments', 'orders', 'marketplace_criteria'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Marketplace $marketplace
     * @return array
     */
    public function transform(Marketplace $marketplace)
    {
        $reviews = $marketplace->reviews->whereIn('review_state_id', [2, 4]);
        $reviewCount = $reviews->count();

        $fiveRatingRatio = $reviewCount == 0 ? 0 : round($reviews->where('rating', 5)->count() / $reviewCount * 100);
        $fourRatingRatio = $reviewCount == 0 ? 0 : round($reviews->where('rating', 4)->count() / $reviewCount * 100);
        $threeRatingRatio = $reviewCount == 0 ? 0 : round($reviews->where('rating', 3)->count() / $reviewCount * 100);
        $twoRatingRatio = $reviewCount == 0 ? 0 : round($reviews->where('rating', 2)->count() / $reviewCount * 100);
        $oneRatingRatio = $reviewCount == 0 ? 0 : round($reviews->where('rating', 1)->count() / $reviewCount * 100);

        return parent::meta([
            'id' => $marketplace->id,
            'type' => "marketplace",

            'name' => $marketplace->name,
            'verified_rating_count' => $marketplace->verified_rating_count,
            'verified_rating_total' => $marketplace->verified_rating_total,
            'unverified_rating_count' => $marketplace->unverified_rating_count,
            'unverified_rating_total' => $marketplace->unverified_rating_total,
            'average_verified_rating' => $marketplace->verified_rating_count == 0 ? 0 : round($marketplace->verified_rating_total / $marketplace->verified_rating_count),
            'average_rating' => $marketplace->unverified_rating_count + $marketplace->verified_rating_count == 0 ? 0 : round(($marketplace->verified_rating_total + $marketplace->unverified_rating_total) / ($marketplace->unverified_rating_count + $marketplace->verified_rating_count)),

            'image_cover' => $marketplace->image_cover,
            'image_profile' => $marketplace->image_profile,
            'description' => $marketplace->description,
            'website_link' => $marketplace->website_link,
            'email' => $marketplace->email,
            'phone' => $marketplace->phone,
            'address' => $marketplace->address,

            'five_rating_reviews_ratio' => $fiveRatingRatio,
            'four_rating_reviews_ratio' => $fourRatingRatio,
            'three_rating_reviews_ratio' => $threeRatingRatio,
            'two_rating_reviews_ratio' => $twoRatingRatio,
            'one_rating_reviews_ratio' => $oneRatingRatio,

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

    public function includeReviews(Marketplace $marketplace)
    {
        return $this->collection($marketplace->reviews->whereIn('review_state_id', [2, 4])->sortByDesc('created_at'), new ReviewTransformer(), 'reviews');
    }


}