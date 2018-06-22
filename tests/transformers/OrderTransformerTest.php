<?php

class OrderTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());

        $data = (new \App\Transformers\OrderTransformer())->transform($m);

        $this->assertEquals([
            'id', 'reference', 'review_delay', 'date', 'created_at', 'updated_at'
        ], array_keys($data));
    }

    public function testIncludeMarketplace()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());

        $data = (new \App\Transformers\OrderTransformer())->includeMarketplace($m);

        $this->assertEquals($m->marketplace->id, $data->getData()->id);
    }

    public function testIncludeSeller()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());

        $data = (new \App\Transformers\OrderTransformer())->includeSeller($m);

        $this->assertEquals($m->seller->id, $data->getData()->id);
    }

    public function testIncludeCustomer()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());

        $data = (new \App\Transformers\OrderTransformer())->includeCustomer($m);

        $this->assertEquals($m->customer->id, $data->getData()->id);
    }

    public function testIncludeReview()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $this->mockReview($this->mockReviewState(), $m);

        $data = (new \App\Transformers\OrderTransformer())->includeReview($m);

        $this->assertEquals($m->review->id, $data->getData()->id);
    }

    public function testIncludeProducts()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $m->products->push($this->mockProduct($m, 4));

        $data = (new \App\Transformers\OrderTransformer())->includeProducts($m);

        $this->assertCount(count($m->products), $data->getData());
    }
}