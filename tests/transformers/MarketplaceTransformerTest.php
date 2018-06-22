<?php

class MarketplaceTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $m = $this->mockMarketplace();

        $data = (new \App\Transformers\MarketplaceTransformer())->transform($m);

        $this->assertEquals([
            'id', 'name', 'wallet', 'default_review_delay', 'created_at', 'updated_at'
        ], array_keys($data));
    }

    public function testIncludeUsers()
    {
        $m = $this->mockMarketplace();
        $m->users->push($this->mockUser($m->id, '\App\Models\Marketplace', 3));
        $data = (new \App\Transformers\MarketplaceTransformer())->includeUsers($m);

        $this->assertCount(count($m->users), $data->getData());
    }

    public function testIncludeOrders()
    {
        $m = $this->mockMarketplace();
        $m->orders->push($this->mockOrder($m->id, $this->mockSeller(), $this->mockCustomer(), 3));
        $data = (new \App\Transformers\MarketplaceTransformer())->includeOrders($m);

        $this->assertCount(count($m->orders), $data->getData());
    }

    public function testIncludeReviewComments()
    {
        $m = $this->mockMarketplace();
        $customer = $this->mockCustomer();
        $order = $this->mockOrder($m, $this->mockSeller(), $customer);
        $review = $this->mockReview($this->mockReviewState(), $order);

        $m->review_comments->push($this->mockReviewComment($review->id, $m->id, '\App\Models\Marketplace', 3));
        $data = (new \App\Transformers\MarketplaceTransformer())->includeReviewComments($m);

        $this->assertCount(count($m->review_comments), $data->getData());
    }

    public function testIncludeMarketplaceCriteria()
    {
        $m = $this->mockMarketplace();

        $m->marketplace_criteria->push($this->mockMarketplaceCriteria($m->id, 3));
        $data = (new \App\Transformers\MarketplaceTransformer())->includeMarketplaceCriteria($m);

        $this->assertCount(count($m->marketplace_criteria), $data->getData());
    }

}