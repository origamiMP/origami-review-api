<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call('MarketplaceTableSeeder');
         $this->call('SellerTableSeeder');
         $this->call('ReviewStateTableSeeder');
         $this->call('OrderTableSeeder');
    }
}
