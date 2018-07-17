<?php

class UserTransformerTest extends TestCase
{

    public function testOutputContainsValidStructure()
    {
        $m = $this->mockUser($this->mockSeller(), 'App\Models\Seller');

        $data = (new \App\Transformers\UserTransformer())->transform($m);

        $this->assertEquals([
            'id', 'email', 'remember_token', 'created_at', 'updated_at'
        ], array_keys($data));
    }

    public function testIncludeAuthor()
    {
        $m = $this->mockUser($this->mockSeller(), 'App\Models\Seller');

        $data = (new \App\Transformers\UserTransformer())->includeOrganization($m);

        $this->assertEquals($m->organization->id, $data->getData()->id);
    }
}