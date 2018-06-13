<?php

class ReviewCommentTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockReviewComment($review, $this->mockCustomer(), '\App\Models\Customer');
        $this->assertEquals(['text', 'review_id', 'author_id', 'author_type', 'author_ip'], $m->getFillable());
    }

    public function testReviewRelation()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockReviewComment($review, $this->mockCustomer(), '\App\Models\Customer');
        $relation = $m->review();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function testAuthorRelation()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockReviewComment($review, $this->mockCustomer(), '\App\Models\Customer');
        $relation = $m->author();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphTo::class, $relation);
    }
}