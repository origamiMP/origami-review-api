<?php

namespace App\Models;

use App\Uuids;

class Review extends BaseModel
{
    use Uuids;

    public $incrementing = false;

    protected $rules = [
        'id' => 'string|unique:reviews,id,{id}',
        'wallet' => 'required|string',
        'text' => 'required|string',
        'rating' => 'required|integer|min:0|max:5',
        'ddb_node_id' => 'required|string',
        'ddb_supplier' => 'required|string|in:ipfs',
        'blockchain_block_id' => 'required|string',
        'blockchain_tx_id' => 'required|string',
        'blockchain_supplier' => 'required|string|in:ethereum',
        'review_state_id' => 'required|integer|exists:review_states,id',
        'order_id' => 'required|integer|exists:orders,id|unique:reviews,order_id,{order_id}',
    ];

    protected $fillable = [
        'wallet', 'text', 'rating', 'ddb_node_id', 'ddb_supplier', 'blockchain_block_id', 'blockchain_tx_id',
        'blockchain_supplier', 'review_state_id', 'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function review_state()
    {
        return $this->belongsTo(ReviewState::class);
    }

    public function marketplace_criteria_ratings()
    {
        return $this->hasMany(MarketplaceCriteriaRating::class);
    }

    public function reward()
    {
        return $this->hasOne(Reward::class);
    }

    public function review_comments()
    {
        return $this->hasMany(ReviewComment::class);
    }
}