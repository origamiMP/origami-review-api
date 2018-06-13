<?php

use Illuminate\Database\Seeder;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Seller::firstOrCreate([
            'name' => 'Seller1',
            'uuid' => uniqid(),
            'verified_rating_total' => 0,
            'verified_rating_count' => 0,
            'unverified_rating_total' => 0,
            'unverified_rating_count' => 0,
        ]);
    }
}
