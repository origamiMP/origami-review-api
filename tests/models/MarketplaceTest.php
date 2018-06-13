<?php

class MarketplaceTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $m = $this->mockMarketplace();
        $this->assertEquals([ 'name', 'wallet', 'default_review_delay'], $m->getFillable());
    }

    public function testUsersRelation()
    {
        $m = $this->mockMarketplace();
        $relation = $m->users();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $relation);
    }

    public function testReviewComments()
    {
        $m = $this->mockMarketplace();
        $relation = $m->review_comments();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $relation);
    }

    public function testOrdersRelation()
    {
        $m = $this->mockMarketplace();
        $relation = $m->orders();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function testMarketplaceCriteriaRelation()
    {
        $m = $this->mockMarketplace();
        $relation = $m->marketplace_criteria();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

}