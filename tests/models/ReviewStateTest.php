<?php

class ReviewStateTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $m = $this->mockReviewState();
        $this->assertEquals(['name'], $m->getFillable());
    }

    public function testReviewsRelation()
    {
        $m = $this->mockReviewState();
        $relation = $m->reviews();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }
}