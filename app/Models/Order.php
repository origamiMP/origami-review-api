<?php

namespace App\Models;

class Order extends BaseModel
{
    protected $rules = [
        'id' => 'integer|min:0|unique:orders,id,{id}',
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
