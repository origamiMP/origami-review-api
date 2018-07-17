<?php

namespace App\Models;
use App\Uuids;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Reward
 *
 * @property int $id
 * @property int $amount
 * @property string $wallet
 * @property int $sent
 * @property string $blockchain_block_id
 * @property string $blockchain_tx_id
 * @property string $review_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Review $review
 * @method static Builder|Reward whereAmount($value)
 * @method static Builder|Reward whereBlockchainBlockId($value)
 * @method static Builder|Reward whereBlockchainTxId($value)
 * @method static Builder|Reward whereCreatedAt($value)
 * @method static Builder|Reward whereId($value)
 * @method static Builder|Reward whereReviewId($value)
 * @method static Builder|Reward whereSent($value)
 * @method static Builder|Reward whereUpdatedAt($value)
 * @method static Builder|Reward whereWallet($value)
 * @mixin Eloquent
 */
class Reward extends BaseModel
{
    use Uuids;

    public $incrementing = false;

    protected $rules = [
        'id' => 'string|unique:rewards,id,{id}',
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
