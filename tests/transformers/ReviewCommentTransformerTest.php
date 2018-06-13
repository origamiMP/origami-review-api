<?php

class ReviewCommentTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $customer = $this->mockCustomer();
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $customer);
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockReviewComment($review, $customer, '\App\Models\Customer');

        $data = (new \App\Transformers\ReviewCommentTransformer())->transform($m);

        $this->assertEquals([
            'id', 'text', 'created_at', 'updated_at', 'meta'
        ], array_keys($data));
    }

    public function testIncludeReview()
    {
        $customer = $this->mockCustomer();
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $customer);
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockReviewComment($review, $customer, '\App\Models\Customer');

        $data = (new \App\Transformers\ReviewCommentTransformer())->includeReview($m);

        $this->assertEquals($m->review->id, $data->getData()->id);
    }

    public function testIncludeAuthor()
    {
        $customer = $this->mockCustomer();
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $customer);
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockReviewComment($review, $customer, '\App\Models\Customer');

        $data = (new \App\Transformers\ReviewCommentTransformer())->includeAuthor($m);

        $this->assertEquals($m->author->id, $data->getData()->id);
    }
}