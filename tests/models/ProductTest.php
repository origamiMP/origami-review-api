<?php

class ProductTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockProduct($order->id);

        $this->assertEquals(['name', 'image', 'quantity', 'price', 'order_id'], $m->getFillable());
    }

    public function testOrderRelation()
    {
        $order = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $m = $this->mockProduct($order->id);
        $relation = $m->order();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }
}