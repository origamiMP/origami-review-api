<?php

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    protected static $migrationRun = false;

    public function createApplication()
    {
        putenv('DB_DEFAULT=sqlite_testing');

        ini_set('memory_limit', '-1');

        $app = require __DIR__ . '/../bootstrap/app.php';

        return $app;
    }

    public function setUp()
    {
        parent::setUp();

        exec('rm ' . __DIR__ . '/../database/testing/testdb.sqlite');
        exec('cp ' . __DIR__ . '/../database/testing/stubdb.sqlite ' . __DIR__ . '/../database/testing/testdb.sqlite');
    }

    protected function mockCustomer($nb = null)
    {
        return factory(\App\Models\Customer::class, $nb)->create();
    }

    protected function mockMarketplace($nb = null)
    {
        return factory(\App\Models\Marketplace::class, $nb)->create();
    }

    protected function mockMarketplaceCriteria($marketplaceId, $nb = null)
    {
        return factory(\App\Models\MarketplaceCriteria::class, $nb)->create([
            'marketplace_id' => $marketplaceId
        ]);
    }

    protected function mockMarketplaceCriteriaRating($marketplaceCriteriaId, $nb = null)
    {
        return factory(\App\Models\MarketplaceCriteriaRating::class, $nb)->create([
            'marketplace_criteria_id' => $marketplaceCriteriaId
        ]);
    }

    protected function mockOrders($marketplaceId, $sellerId, $customerId, $nb = null)
    {
        return factory(\App\Models\Order::class, $nb)->create([
            'marketplace_id' => $marketplaceId,
            'seller_id' => $sellerId,
            'customer_id' => $customerId
        ]);
    }

    protected function mockProduct($orderId, $nb = null)
    {
        return factory(\App\Models\Product::class, $nb)->create([
            'order_id' => $orderId
        ]);
    }

    protected function mockReview($reviewStateId, $orderId, $nb = null)
    {
        return factory(\App\Models\Review::class, $nb)->create([
            'review_state_id' => $reviewStateId,
            'order_id' => $orderId
        ]);
    }

    protected function mockReviewComment($authorId, $authorType, $nb = null)
    {
        return factory(\App\Models\ReviewComment::class, $nb)->create([
            'author_id' => $authorId,
            'author_type' => $authorType
        ]);
    }

    protected function mockReviewState($nb = null)
    {
        return factory(\App\Models\ReviewState::class, $nb)->create();
    }

    protected function mockReward($reviewId, $nb = null)
    {
        return factory(\App\Models\Reward::class, $nb)->create([
            'review_id' => $reviewId
        ]);
    }

    protected function mockSeller($nb = null)
    {
        return factory(\App\Models\Seller::class, $nb)->create();
    }

    protected function mockUser($organizationId, $organizationType, $nb = null)
    {
        return factory(\App\Models\User::class, $nb)->create([
            'organization_id' => $organizationId,
            'organization_type' => $organizationType
        ]);
    }
}
