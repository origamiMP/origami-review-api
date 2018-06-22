<?php

class MarketplaceCriteriaTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $m = $this->mockMarketplaceCriteria($this->mockMarketplace());

        $data = (new \App\Transformers\MarketplaceCriteriaTransformer())->transform($m);

        $this->assertEquals([
            'id', 'name', 'weight', 'created_at', 'updated_at'
        ], array_keys($data));
    }

    public function testIncludeMarketplace()
    {
        $m = $this->mockMarketplaceCriteria($this->mockMarketplace());

        $data = (new \App\Transformers\MarketplaceCriteriaTransformer())->includeMarketplace($m);

        $this->assertEquals($m->marketplace->id, $data->getData()->id);
    }

    public function testIncludeMarketplaceCriteriaRatings()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockMarketplaceCriteria($this->mockMarketplace());

        $m->marketplace_criteria_ratings->push($this->mockMarketplaceCriteriaRating($m, $review, 3));

        $data = (new \App\Transformers\MarketplaceCriteriaTransformer())->includeMarketplaceCriteriaRating($m);

        $this->assertCount(count($m->marketplace_criteria_ratings), $data->getData());
    }
}