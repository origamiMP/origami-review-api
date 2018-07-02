<?php

namespace App\Services\Blockchain;

use App\Models\Review;

abstract class BlockchainContract
{
    public function certifyReview(Review $review, string $wallet, string $hash, string $signedHash)
    {
        return true;
    }

    public function certifyReviewNodeId(Review $review)
    {
        return true;
    }
}