<?php

class MarketplaceCriteriaRatingTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $marketplace = $this->mockMarketplace();
        $marketplace_criteria = $this->mockMarketplaceCriteria($marketplace);
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockMarketplaceCriteriaRating($marketplace_criteria, $review);
        $this->assertEquals(['rating', 'marketplace_criteria_id', 'review_id'], $m->getFillable());
    }

    public function testMarketplaceCriteriaRelation()
    {
        $marketplace = $this->mockMarketplace();
        $marketplace_criteria = $this->mockMarketplaceCriteria($marketplace);
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockMarketplaceCriteriaRating($marketplace_criteria, $review);
        $relation = $m->marketplace_criteria();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function testReviewRelation()
    {
        $marketplace = $this->mockMarketplace();
        $marketplace_criteria = $this->mockMarketplaceCriteria($marketplace);
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockMarketplaceCriteriaRating($marketplace_criteria, $review);
        $relation = $m->review();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }
}