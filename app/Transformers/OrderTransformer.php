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
        if (!$order->marketplace)
            return null;

        return $this->item($order->marketplace, new MarketplaceTransformer(), 'marketplaces');
    }

    public function includeSeller(Order $order)
    {
        if (!$order->seller)
            return null;

        return $this->item($order->seller, new SellerTransformer(), 'sellers');
    }

    public function includeCustomer(Order $order)
    {
        if (!$order->customer)
            return null;

        return $this->item($order->customer, new CustomerTransformer(), 'customers');
    }

    public function includeReview(Order $order)
    {
        if (!$order->review)
            return null;

        return $this->item($order->review, new ReviewTransformer(), 'reviews');
    }

    public function includeProducts(Order $order)
    {
        return $this->collection($order->products, new ProductTransformer(), 'products');
    }

}