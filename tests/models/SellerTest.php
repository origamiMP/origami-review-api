<?php

class SellerTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $m = $this->mockSeller();
        $this->assertEquals(['name', 'verified_rating_total', 'verified_rating_count', 'unverified_rating_total',
            'unverified_rating_count'], $m->getFillable());
    }

    public function testOrdersRelation()
    {
        $m = $this->mockSeller();
        $relation = $m->orders();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function testUsersRelation()
    {
        $m = $this->mockSeller();
        $relation = $m->users();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $relation);
    }

    public function testReviewCommentsRelation()
    {
        $m = $this->mockSeller();
        $relation = $m->review_comments();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $relation);
    }
}