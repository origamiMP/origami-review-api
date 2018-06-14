<?php

class SellerTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $m = $this->mockSeller();

        $data = (new \App\Transformers\SellerTransformer())->transform($m);

        $this->assertEquals([
            'id', 'name', 'uuid', 'verified_rating_count', 'verified_rating_total', 'unverified_rating_count',
            'unverified_rating_total', 'created_at', 'updated_at', 'meta'
        ], array_keys($data));
    }

    public function testIncludeUsers()
    {
        $m = $this->mockSeller();

        $m->users->push($this->mockUser($m, '\App\Models\Seller', 3));

        $data = (new \App\Transformers\SellerTransformer())->includeUsers($m);

        $this->assertCount(count($m->users), $data->getData());
    }

    public function testIncludeOrders()
    {
        $m = $this->mockSeller();

        $m->orders->push($this->mockOrder($this->mockMarketplace(), $m, $this->mockCustomer(), 3));

        $data = (new \App\Transformers\SellerTransformer())->includeOrders($m);

        $this->assertCount(count($m->orders), $data->getData());
    }

    public function testIncludeReviewComments()
    {
        $m = $this->mockSeller();
        $order = $this->mockOrder($this->mockMarketplace(), $m, $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);

        $m->review_comments->push($this->mockReviewComment($review, $m, '\App\Models\Seller', 3));

        $data = (new \App\Transformers\SellerTransformer())->includeReviewComments($m);

        $this->assertCount(count($m->review_comments), $data->getData());
    }
}