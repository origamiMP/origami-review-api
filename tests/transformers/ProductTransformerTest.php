<?php

class ProductTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockProduct($order);

        $data = (new \App\Transformers\ProductTransformer())->transform($m);

        $this->assertEquals([
            'id', 'name', 'image', 'quantity', 'price', 'created_at', 'updated_at', 'meta'
        ], array_keys($data));
    }

    public function testIncludeOrder()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockProduct($order);

        $data = (new \App\Transformers\ProductTransformer())->includeOrder($m);

        $this->assertEquals($m->order->id, $data->getData()->id);
    }
}