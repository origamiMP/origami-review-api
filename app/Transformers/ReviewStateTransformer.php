<?php namespace App\Transformers;

use App\Models\ReviewState;

class ReviewStateTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'reviews'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param ReviewState $reviewState
     * @return array
     */
    public function transform(ReviewState $reviewState)
    {
        return parent::meta([
            'id' => $reviewState->id,
            'name' => $reviewState->name,
            'created_at' => $reviewState->created_at,
            'updated_at' => $reviewState->updated_at
        ]);
    }

    public function includeReviews(ReviewState $reviewState)
    {
        return $this->collection($reviewState->reviews, new ReviewTransformer());
    }
}