<?php

namespace App\Models;

class Product extends BaseModel
{
    protected $rules = [
        'id' => 'string|unique:reviews,id,{id}',
        'name' => 'required|string',
        'image' => 'required|string|url',
        'quantity' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'order_id' => 'required|integer|exists:orders,id',
    ];

    protected $fillable = [
        'name', 'image', 'quantity', 'price', 'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}