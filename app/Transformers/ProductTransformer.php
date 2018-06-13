<?php namespace App\Transformers;

use App\Models\Product;

class ProductTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'order'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Product $product
     * @return array
     */
    public function transform(Product $product)
    {
        return parent::meta([
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'quantity' => $product->quantity,
            'price' => $product->price,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at
        ]);
    }

    public function includeOrder(Product $product)
    {
        return $this->item($product->order, new OrderTransformer());
    }

}