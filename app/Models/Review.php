<?php

namespace App\Models;

use App\Uuids;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Review
 *
 * @property string $id
 * @property string $wallet
 * @property string $text
 * @property int $rating
 * @property string $ddb_node_id
 * @property string $ddb_supplier
 * @property string $blockchain_block_id
 * @property string $blockchain_tx_id
 * @property string $blockchain_supplier
 * @property int $review_state_id
 * @property int $order_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MarketplaceCriteriaRating[] $marketplace_criteria_ratings
 * @property-read \App\Models\Order $order
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReviewComment[] $review_comments
 * @property-read \App\Models\ReviewState $review_state
 * @property-read \App\Models\Reward $reward
 * @method static Builder|Review whereBlockchainBlockId($value)
 * @method static Builder|Review whereBlockchainSupplier($value)
 * @method static Builder|Review whereBlockchainTxId($value)
 * @method static Builder|Review whereCreatedAt($value)
 * @method static Builder|Review whereDdbNodeId($value)
 * @method static Builder|Review whereDdbSupplier($value)
 * @method static Builder|Review whereId($value)
 * @method static Builder|Review whereOrderId($value)
 * @method static Builder|Review whereRating($value)
 * @method static Builder|Review whereReviewStateId($value)
 * @method static Builder|Review whereText($value)
 * @method static Builder|Review whereUpdatedAt($value)
 * @method static Builder|Review whereWallet($value)
 * @mixin Eloquent
 */
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