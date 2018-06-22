<?php

class AttributeTypeTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $m = $this->mockCustomer();

        $data = (new \App\Transformers\CustomerTransformer())->transform($m);

        $this->assertEquals([
            'id', 'email', 'name', 'created_at', 'updated_at'
        ], array_keys($data));
    }

    public function testIncludeOrders()
    {
        $m = $this->mockCustomer();
        $m->orders->push($this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer(), 3));
        $data = (new \App\Transformers\CustomerTransformer())->includeOrders($m);

        $this->assertCount(count($m->orders), $data->getData());
    }

    public function testIncludeReviewComments()
    {
        $marketplace = $this->mockMarketplace();
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockCustomer();

        $m->review_comments->push($this->mockReviewComment($review->id, $m->id, '\App\Models\Customer', 3));
        $data = (new \App\Transformers\CustomerTransformer())->includeReviewComments($m);

        $this->assertCount(count($m->review_comments), $data->getData());
    }
}