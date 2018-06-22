<?php

class ReviewStateTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $m = $this->mockReviewState();

        $data = (new \App\Transformers\ReviewStateTransformer())->transform($m);

        $this->assertEquals([
            'id', 'name', 'created_at', 'updated_at'
        ], array_keys($data));
    }

    public function testIncludeReviews()
    {
        $customer = $this->mockCustomer();
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $customer);
        $m = $this->mockReviewState();

        $m->reviews->push($this->mockReview($m, $order, 1));

        $data = (new \App\Transformers\ReviewStateTransformer())->includeReviews($m);

        $this->assertCount(count($m->reviews), $data->getData());
    }
}