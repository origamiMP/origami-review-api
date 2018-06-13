<?php

use Illuminate\Database\Seeder;

class MarketplaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Marketplace::firstOrCreate([
            'name' => 'Marketplace1',
            'wallet' => '0x123456789',
            'default_review_delay' => 1
        ]);
    }
}
