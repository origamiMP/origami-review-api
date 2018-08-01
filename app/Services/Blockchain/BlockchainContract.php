<?php

namespace App\Services\Blockchain;

use App\Models\Review;

abstract class BlockchainContract
{
    public function certifyReview(Review $review)
    {
        return true;
    }

    public function certifyReviewNodeId(Review $review)
    {
        return true;
    }
}