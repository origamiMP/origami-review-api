<?php

class AttributeTypeTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $m = $this->mockCustomer();
        $this->assertEquals(['name', 'email'], $m->getFillable());
    }

    public function testAttributeValuesRelation()
    {
        $m = $this->mockCustomer();
        $relation = $m->orders();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }

    public function testReviewComments()
    {
        $m = $this->mockCustomer();
        $relation = $m->review_comments();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $relation);
    }
}