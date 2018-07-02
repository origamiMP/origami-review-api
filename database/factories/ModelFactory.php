<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\App\Models\Customer::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email
    ];
});

$factory->define(\App\Models\Marketplace::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'wallet' => $faker->text,
        'default_review_delay' => $faker->numberBetween(0, 48)
    ];
});

$factory->define(\App\Models\MarketplaceCriteria::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'weight' => $faker->randomFloat(6)
    ];
});

$factory->define(\App\Models\MarketplaceCriteriaRating::class, function(Faker\Generator $faker) {
    return [
        'rating' => $faker->numberBetween(0, 5)
    ];
});

$factory->define(\App\Models\Order::class, function(Faker\Generator $faker) {
    return [
        'reference' => $faker->text,
        'review_delay' => $faker->numberBetween(0, 48),
        'date' => $faker->date(),
    ];
});

$factory->define(\App\Models\Product::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->imageUrl(),
        'quantity' => $faker->randomNumber(),
        'price' => $faker->randomNumber(),
    ];
});

$factory->define(\App\Models\Review::class, function(Faker\Generator $faker) {
    return [
        'text' => $faker->text,
        'wallet' => $faker->text,
        'rating' => $faker->numberBetween(0, 5),
        'ddb_node_id' => $faker->uuid,
        'ddb_supplier' => "ipfs",
        'blockchain_block_id' => $faker->uuid,
        'blockchain_tx_id' => $faker->uuid,
        'blockchain_supplier' => 'ethereum',
        'certified' => true
    ];
});

$factory->define(\App\Models\ReviewComment::class, function(Faker\Generator $faker) {
    return [
        'text' => $faker->text,
        'author_ip' => $faker->ipv4
    ];
});

$factory->define(\App\Models\ReviewState::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(\App\Models\Reward::class, function(Faker\Generator $faker) {
    return [
        'amount' => $faker->randomNumber(),
        'sent' => $faker->boolean,
        'blockchain_block_id' => $faker->uuid,
        'blockchain_tx_id' => $faker->uuid,
    ];
});

$factory->define(\App\Models\Seller::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'uuid' => $faker->uuid,
        'verified_rating_count' => 10,
        'verified_rating_total' => $faker->numberBetween(10, 50),
        'unverified_rating_count' => 10,
        'unverified_rating_total' => $faker->numberBetween(10, 50),
    ];
});

$factory->define(\App\Models\User::class, function(Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'password' => $faker->password
    ];
});
