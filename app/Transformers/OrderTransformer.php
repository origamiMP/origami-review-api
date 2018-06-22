<?php

namespace App\Transformers;

use App\Models\Order;

class OrderTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'marketplace', 'seller', 'customer', 'review', 'products'
    ];

    protected $defaultIncludes = [];

    /**
     * Turn this item object into a generic array
     *
     * @param Order $order
     * @return array
     */
    public function transform(Order $order)
    {
        return parent::meta([
            'id' => $order->id,
            'reference' => $order->reference,
            'review_delay' => $order->review_delay,
            'date' => $order->date,
            'created_at' => $order->created_at,
            'updated_at' => $order->updated_at
        ]);
    }

    public function includeMarketplace(Order $order)
    {
        return $this->item($order->marketplace, new MarketplaceTransformer(), 'marketplaces');
    }

    public function includeSeller(Order $order)
    {
        return $this->item($order->seller, new SellerTransformer());
    }

    public function includeCustomer(Order $order)
    {
        return $this->item($order->customer, new CustomerTransformer());
    }

    public function includeReview(Order $order)
    {
        return $this->item($order->review, new ReviewTransformer());
    }

    public function includeProducts(Order $order)
    {
        return $this->collection($order->products, new ProductTransformer(), 'products');
    }

}