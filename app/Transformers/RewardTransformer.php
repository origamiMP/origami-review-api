<?php namespace App\Transformers;

use App\Models\Reward;

class RewardTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'review'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Reward $reward
     * @return array
     */
    public function transform(Reward $reward)
    {
        return parent::meta([
            'id' => $reward->id,
            'amount' => $reward->amount,
            'wallet' => $reward->wallet,
            'sent' => $reward->sent,
            'blockchain_block_id' => $reward->blockchain_block_id,
            'blockchain_tx_id' => $reward->blockchain_tx_id,
            'created_at' => $reward->created_at,
            'updated_at' => $reward->updated_at
        ]);
    }

    public function includeReview(Reward $reward)
    {
        return $this->item($reward->review, new ReviewTransformer());
    }
}