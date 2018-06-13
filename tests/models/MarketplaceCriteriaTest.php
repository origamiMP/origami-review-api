<?php

class MarketplaceCriteriaTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $m = $this->mockMarketplaceCriteria($this->mockMarketplace());
        $this->assertEquals(['name', 'weight', 'marketplace_id'], $m->getFillable());
    }

    public function testMarketplaceRelation()
    {
        $m = $this->mockMarketplaceCriteria($this->mockMarketplace());
        $relation = $m->marketplace();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
    }

    public function testMarketplaceCriteriaRatingComments()
    {
        $m = $this->mockMarketplaceCriteria($this->mockMarketplace());
        $relation = $m->marketplace_criteria_ratings();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }
}