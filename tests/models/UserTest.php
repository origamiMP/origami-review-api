<?php

class UserTest extends TestCase
{
    public function testContainsValidFillableProperties()
    {
        $m = $this->mockUser($this->mockSeller(), 'App\Models\Seller');
        $this->assertEquals(['id', 'name', 'email', 'organization_id', 'organization_type', 'remember_token', 'password'], $m->getFillable());
    }

    public function testOrganizationRelation()
    {
        $m = $this->mockUser($this->mockSeller(), 'App\Models\Seller');
        $relation = $m->organization();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphTo::class, $relation);
    }
}