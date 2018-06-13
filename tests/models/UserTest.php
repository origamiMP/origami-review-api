<?php

class UserTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $m = $this->mockUser($this->mockSeller(), '\App\Models\Seller');
        $this->assertEquals(['name', 'email', 'organization_id', 'organization_type', 'remember_token'], $m->getFillable());
    }

    public function testOrganizationRelation()
    {
        $m = $this->mockUser($this->mockSeller(), '\App\Models\Seller');
        $relation = $m->organization();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphTo::class, $relation);
    }
}