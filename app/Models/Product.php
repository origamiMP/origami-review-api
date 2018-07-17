<?php

namespace App\Models;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $quantity
 * @property float $price
 * @property int $order_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereOrderId($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereQuantity($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Product extends BaseModel
{
    protected $rules = [
        'id' => 'string|unique:reviews,id,{id}',
        'name' => 'required|string',
        'image' => 'required|string|url',
        'quantity' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'order_id' => 'required|string|exists:orders,id',
    ];

    protected $fillable = [
        'name', 'image', 'quantity', 'price', 'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}