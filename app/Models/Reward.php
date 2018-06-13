<?php

namespace App\Models;

class Reward extends BaseModel
{
    protected $rules = [
        'id' => 'integer|min:0|unique:rewards,id,{id}',
        'amount' => 'required|integer|min:0',
        'wallet' => 'required|string|exists:reviews,wallet',
        'sent' => 'required|bool',
        'blockchain_block_id' => 'required|string',
        'blockchain_tx_id' => 'required|string',
        'review_id' => 'required|string|exists:reviews,id|unique:rewards,review_id,{review_id}'
    ];

    protected $fillable = [
        'amount', 'wallet', 'sent', 'blockchain_block_id', 'blockchain_tx_id', 'review_id'
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
