<?php

namespace App\Models;

use App\Exceptions\OrigamiException;
use App\Services\Blockchain\BlockchainDispatcher;
use App\Uuids;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Review
 *
 * @property string $id
 * @property string $wallet
 * @property string $hash
 * @property string $signed_hash
 * @property string $text
 * @property int $rating
 * @property bool $certified
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
        'text' => 'required|string',
        'rating' => 'required|integer|min:0|max:5',
        'wallet' => 'nullable|string',
        'review_state_id' => 'required|integer|exists:review_states,id',
        'order_id' => 'required|string|exists:orders,id|unique:reviews,order_id,{order_id}',
        'ddb_node_id' => 'nullable|string',
        'ddb_supplier' => 'nullable|string|in:ipfs',
        'blockchain_block_id' => 'nullable|string',
        'blockchain_tx_id' => 'nullable|string',
        'blockchain_supplier' => 'nullable|string|in:ethereum',
        'hash' => 'nullable|string',
        'signed_hash' => 'nullable|string',
    ];

    protected $fillable = [
        'wallet', 'text', 'rating', 'ddb_node_id', 'ddb_supplier', 'blockchain_block_id', 'blockchain_tx_id',
        'blockchain_supplier', 'review_state_id', 'order_id', 'hash', 'signed_hash'
    ];


    /**
     * Order relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * ReviewState relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review_state()
    {
        return $this->belongsTo(ReviewState::class);
    }

    /**
     * MarketplaceCriteriaRating relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marketplace_criteria_ratings()
    {
        return $this->hasMany(MarketplaceCriteriaRating::class);
    }

    /**
     * Reward relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reward()
    {
        return $this->hasOne(Reward::class);
    }

    /**
     * ReviewComment relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function review_comments()
    {
        return $this->hasMany(ReviewComment::class);
    }


    /**
     * Override of create model method
     *
     * @param array $attributes
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public static function create(array $attributes = [])
    {
        $attributes['rating'] = 0;
        $attributes['review_state_id'] = ReviewState::getCreatedReviewState()->id;
        $review = parent::create($attributes);
        $review->saveCriteria($attributes['criteria']);
        $review->save();

        //todo: send email to seller
        //todo: send email to marketplace
        //todo: send email to customer

        return $review;
    }

    /**
     * Override of save model method
     *
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $this->rating = $this->calculateAverageRatingFromCriteria();
        return parent::save($options);
    }

    /**
     * Save marketplace criteria rating relation
     *
     * @param $criteria
     */
    public function saveCriteria($criteria)
    {
        foreach ($criteria as $criterion)
            $this->marketplace_criteria_ratings()->save(new MarketplaceCriteriaRating($criterion));
    }

    /**
     * Increment global seller rating when new review
     */
    public function incrementGlobalSellerAndMarketplaceRating()
    {
        if ($this->wallet) {
            $this->order->seller->verified_rating_count++;
            $this->order->seller->verified_rating_total += $this->rating;
            $this->order->marketplace->verified_rating_count++;
            $this->order->marketplace->verified_rating_total += $this->rating;
        } else {
            $this->order->seller->verified_rating_count++;
            $this->order->seller->verified_rating_total += $this->rating;
            $this->order->marketplace->unverified_rating_count++;
            $this->order->marketplace->unverified_rating_total += $this->rating;
        }
        $this->order->seller->save();
        $this->order->marketplace->save();
    }


    /**
     * Calculate review average rating from criteria with weight
     *
     * @return float|int
     */
    public function calculateAverageRatingFromCriteria()
    {
        $totalWeight = $this->getCriteriaTotalWeight();
        $rating = 0;
        foreach ($this->marketplace_criteria_ratings()->get() as $marketplaceCriteriaRating)
            $rating += $marketplaceCriteriaRating->rating * $marketplaceCriteriaRating->marketplace_criteria->weight;

        return round($rating / $totalWeight);
    }

    /**
     * Get Criteria total weight
     *
     * @return float|int
     */
    public function getCriteriaTotalWeight()
    {
        $totalWeight = 0;

        foreach ($this->marketplace_criteria_ratings()->get() as $marketplaceCriteriaRating)
            $totalWeight += $marketplaceCriteriaRating->marketplace_criteria->weight;

        return $totalWeight != 0 ? $totalWeight : 1;
    }

    /**
     * Certify review on blockchain
     *
     */
    public function certify()
    {
        $dispatcher = new BlockchainDispatcher(BlockchainDispatcher::CERTIFY_REVIEW, $this);
        dispatch($dispatcher->onQueue('blockchains'));
    }

    public function refuse(string $text, string $ip)
    {
        $this->checkCurrentUserRight();
        $this->review_state_id = ReviewState::getRefusedReviewState()->id;
        $this->addComment($text, $ip);
        $this->save();

        //todo: send email to customer
    }

    public function accept()
    {
        $this->checkCurrentUserRight();
        $this->review_state_id = ReviewState::getAcceptedReviewState()->id;
        $this->save();

        if ($this->wallet) {
            $this->certify();
            //todo: send email to customer
            //todo: send reward to customer
        } else
            $this->incrementGlobalSellerAndMarketplaceRating();
    }

    public function addComment(string $text, string $ip)
    {
        return $this->review_comments()->save(new ReviewComment([
            'text' => $text,
            'author_ip' => $ip,
            'author_id' => currentUser() ? currentUser()->organization_id : $this->order->customer->id,
            'author_type' => currentUser() ? currentUser()->organization_type : 'App\Models\Customer'
        ]));
    }

    private function checkCurrentUserRight()
    {
        $currentUser = currentUser();

        if ($currentUser && !in_array($currentUser->organization_id, [$this->order->marketplace->id, $this->order->seller->id]))
            throw new OrigamiException('Access Denied', 'Access Denied', 403);

        return true;
    }
}