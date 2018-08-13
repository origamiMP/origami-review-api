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
        $this->createMarketplace('CDiscount');
        $this->createMarketplace('Amazon');
        $this->createMarketplace('Mendity');
        $this->createMarketplace('MinisMoi');
        $this->createMarketplace('CommentSeRuiner');
    }

    public function createMarketplace(string $name)
    {
        $marketplace = \App\Models\Marketplace::firstOrCreate([
            'name' => $name
        ]);

        \App\Models\User::firstOrCreate([
            'email' => 'admin-'.$name.'@origami-review.com',
            'password' => \Illuminate\Support\Facades\Hash::make('testdev'),
            'organization_id' => $marketplace->id,
            'organization_type' => 'App\Models\Marketplace'
        ]);

        \App\Models\MarketplaceCriteria::firstOrCreate([
            'name' => 'Qualité du produit',
            'weight' => 5,
            'marketplace_id' => $marketplace->id
        ]);
        \App\Models\MarketplaceCriteria::firstOrCreate([
            'name' => 'Vitesse de livraison',
            'weight' => 5,
            'marketplace_id' => $marketplace->id
        ]);
    }
}
