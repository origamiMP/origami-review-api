<?php

namespace App\Models;
use App\Uuids;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $reference
 * @property int|null $review_delay
 * @property string $date
 * @property int $marketplace_id
 * @property int $seller_id
 * @property int $customer_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\Marketplace $marketplace
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read \App\Models\Review $review
 * @property-read \App\Models\Seller $seller
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereCustomerId($value)
 * @method static Builder|Order whereDate($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereMarketplaceId($value)
 * @method static Builder|Order whereReference($value)
 * @method static Builder|Order whereReviewDelay($value)
 * @method static Builder|Order whereSellerId($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Order extends BaseModel
{
    use Uuids;

    protected $rules = [
        'id' => 'string|unique:orders,id,{id}',
        'reference' => 'required|string',
        'review_delay' => 'nullable|integer|min:0',
        'date' => 'required|date',
        'marketplace_id' => 'required|integer|exists:marketplaces,id',
        'seller_id' => 'required|integer|exists:sellers,id',
        'customer_id' => 'required|integer|exists:customers,id',
    ];

    protected $fillable = [
        'reference', 'review_delay', 'date', 'marketplace_id', 'seller_id', 'customer_id'
    ];

    public function marketplace()
    {
        return $this->belongsTo(Marketplace::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
