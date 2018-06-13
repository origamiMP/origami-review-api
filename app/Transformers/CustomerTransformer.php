<?php namespace App\Transformers;

use App\Models\Customer;

class CustomerTransformer extends BaseTransformer
{

    protected $availableIncludes = [
        'orders', 'review_comments'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Customer $customer
     * @return array
     */
    public function transform(Customer $customer)
    {
        return parent::meta([
            'id' => $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            'created_at' => $customer->created_at,
            'updated_at' => $customer->updated_at
        ]);
    }

    public function includeOrders(Customer $customer)
    {
        return $this->collection($customer->orders, new OrderTransformer());
    }

    public function includeReviewComments(Customer $customer)
    {
        return $this->collection($customer->review_comments, new ReviewCommentTransformer());
    }

}