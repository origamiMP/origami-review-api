<?php

class RewardTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockReward($review, $review->wallet);

        $data = (new \App\Transformers\RewardTransformer())->transform($m);

        $this->assertEquals([
            'id', 'amount', 'wallet', 'sent', 'blockchain_block_id', 'blockchain_tx_id', 'created_at', 'updated_at', 'meta'
        ], array_keys($data));
    }

    public function testIncludeReview()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $review = $this->mockReview($this->mockReviewState(), $order);
        $m = $this->mockReward($review, $review->wallet);

        $data = (new \App\Transformers\RewardTransformer())->includeReview($m);

        $this->assertEquals($m->review->id, $data->getData()->id);
    }
}