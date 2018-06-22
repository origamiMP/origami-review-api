<?php

class MarketplaceCriteriaRatingTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockMarketplaceCriteriaRating($this->mockMarketplaceCriteria($this->mockMarketplace()), $review);

        $data = (new \App\Transformers\MarketplaceCriteriaRatingTransformer())->transform($m);

        $this->assertEquals([
            'id', 'rating', 'created_at', 'updated_at'
        ], array_keys($data));
    }

    public function testIncludeMarketplaceCriteria()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockMarketplaceCriteriaRating($this->mockMarketplaceCriteria($this->mockMarketplace()), $review);

        $data = (new \App\Transformers\MarketplaceCriteriaRatingTransformer())->includeMarketplaceCriteria($m);

        $this->assertEquals($m->marketplace_criteria->id, $data->getData()->id);
    }

    public function testIncludeReview()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockMarketplaceCriteriaRating($this->mockMarketplaceCriteria($this->mockMarketplace()), $review);

        $data = (new \App\Transformers\MarketplaceCriteriaRatingTransformer())->includeReview($m);

        $this->assertEquals($m->review->id, $data->getData()->id);
    }
}