<?php

class OrderTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $this->assertEquals(['reference', 'review_delay', 'date', 'marketplace_id', 'seller_id', 'customer_id'], $m->getFillable());
    }

    public function testMarketplaceRelation()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $relation = $m->marketplace();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function testSellerRelation()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $relation = $m->seller();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function testCustomerRelation()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $relation = $m->customer();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function testReviewRelation()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $relation = $m->review();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $relation);
    }

    public function testProductRelation()
    {
        $m = $this->mockOrder($this->mockMarketplace(), $this->mockSeller(), $this->mockCustomer());
        $relation = $m->products();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }
}