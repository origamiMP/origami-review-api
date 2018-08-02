<?php

class ReviewTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $marketplace = $this->mockMarketplace();
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);
        $this->assertEquals(['wallet', 'text', 'rating', 'ddb_node_id', 'ddb_supplier', 'blockchain_block_id',
            'blockchain_tx_id', 'blockchain_supplier', 'review_state_id', 'order_id', 'hash', 'signed_hash'], $m->getFillable());
    }

    public function testOrderRelation()
    {
        $marketplace = $this->mockMarketplace();
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);
        $relation = $m->order();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function testReviewStateRelation()
    {
        $marketplace = $this->mockMarketplace();
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);
        $relation = $m->review_state();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function testMarketplaceCriteriaRatingRelation()
    {
        $marketplace = $this->mockMarketplace();
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);
        $relation = $m->marketplace_criteria_ratings();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function testRewardRelation()
    {
        $marketplace = $this->mockMarketplace();
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);
        $relation = $m->reward();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $relation);
    }

    public function testReviewCommentRelation()
    {
        $marketplace = $this->mockMarketplace();
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);
        $relation = $m->review_comments();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }
}