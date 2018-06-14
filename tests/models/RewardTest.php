<?php

class RewardTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $marketplace = $this->mockMarketplace();
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockReward($review, $review->wallet);
        $this->assertEquals(['amount', 'wallet', 'sent', 'blockchain_block_id', 'blockchain_tx_id', 'review_id'], $m->getFillable());
    }

    public function testReviewRelation()
    {
        $marketplace = $this->mockMarketplace();
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockReward($review, $review->wallet);
        $relation = $m->review();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }
}