<?php

class ReviewTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);

        $data = (new \App\Transformers\ReviewTransformer())->transform($m);

        $this->assertEquals([
            'id', 'wallet', 'text', 'rating', 'ddb_node_id', 'ddb_supplier', 'blockchain_block_id', 'blockchain_tx_id',
            'blockchain_supplier', 'created_at', 'updated_at'
        ], array_keys($data));
    }

    public function testIncludeOrder()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);

        $data = (new \App\Transformers\ReviewTransformer())->includeOrder($m);

        $this->assertEquals($m->order->id, $data->getData()->id);
    }

    public function testIncludeReviewState()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);

        $data = (new \App\Transformers\ReviewTransformer())->includeReviewState($m);

        $this->assertEquals($m->review_state->id, $data->getData()->id);
    }

    public function testIncludeReward()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);
        $this->mockReward($m, $m->wallet);

        $data = (new \App\Transformers\ReviewTransformer())->includeReward($m);

        $this->assertEquals($m->reward->id, $data->getData()->id);
    }

    public function testIncludeReviewComments()
    {
        $customer = $this->mockCustomer();
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $customer);
        $m = $this->mockReview($this->mockReviewState(), $order);

        $m->review_comments->push($this->mockReviewComment($m, $customer, '\App\Models\Customer', 3));

        $data = (new \App\Transformers\ReviewTransformer())->includeReviewComments($m);

        $this->assertCount(count($m->review_comments), $data->getData());
    }

    public function testIncludeMarketplaceCriteriaRating()
    {
        $marketplace = $this->mockMarketplace();
        $order = $this->mockOrder($marketplace, $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockReview($this->mockReviewState(), $order);

        $m->review_comments->push($this->mockMarketplaceCriteriaRating($this->mockMarketplaceCriteria($marketplace), $m, 3));

        $data = (new \App\Transformers\ReviewTransformer())->includeMarketplaceCriteriaRatings($m);

        $this->assertCount(count($m->marketplace_criteria_ratings), $data->getData());
    }
}