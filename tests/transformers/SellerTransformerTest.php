<?php

class SellerTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $m = $this->mockSeller();

        $data = (new \App\Transformers\SellerTransformer())->transform($m);

        $this->assertEquals([
            'id', 'type', 'name', 'verified_rating_count', 'verified_rating_total', 'unverified_rating_count',
            'unverified_rating_total', 'average_verified_rating', 'image_cover', 'image_profile', 'description',
            'website_link', 'email', 'phone', 'address', 'five_rating_reviews_ratio', 'four_rating_reviews_ratio',
            'three_rating_reviews_ratio', 'two_rating_reviews_ratio', 'one_rating_reviews_ratio', 'created_at',
            'updated_at'
        ], array_keys($data));
    }

    public function testIncludeUsers()
    {
        $m = $this->mockSeller();

        $m->users->push($this->mockUser($m, 'App\Models\Seller', 3));

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

        $m->review_comments->push($this->mockReviewComment($review, $m, 'App\Models\Seller', 3));

        $data = (new \App\Transformers\SellerTransformer())->includeReviewComments($m);

        $this->assertCount(count($m->review_comments), $data->getData());
    }
}