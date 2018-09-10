<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = \App\Models\Customer::firstOrCreate([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com'
        ]);

//        $seller = \App\Models\Seller::whereName('Cuteland')->first();
//
//        $this->createOrder($customer, $seller, \App\Models\Marketplace::inRandomOrder()->first());
//        $this->createOrder($customer, $seller, \App\Models\Marketplace::inRandomOrder()->first());
//        $this->createOrder($customer, $seller, \App\Models\Marketplace::inRandomOrder()->first());
//        $this->createOrder($customer, $seller, \App\Models\Marketplace::inRandomOrder()->first());
//        $this->createOrder($customer, $seller, \App\Models\Marketplace::inRandomOrder()->first());
    }

    public function createOrder(\App\Models\Customer $customer, \App\Models\Seller $seller, \App\Models\Marketplace $marketplace)
    {
        $order = \App\Models\Order::firstOrCreate([
            'reference' => str_random(8),
            'date' => \Carbon\Carbon::now()->toDateTimeString(),
            'customer_id' => $customer->id,
            'seller_id' => $seller->id,
            'marketplace_id' => $marketplace->id
        ]);

        \App\Models\Product::firstOrCreate([
            'order_id' => $order->id,
            'name' => 'Bouée Licorne',
            'quantity' => 2,
            'price' => 69,
            'image' => 'https://udevys.com/wp-content/uploads/2018/06/38-1q-020_1.jpg',
        ]);
        \App\Models\Product::firstOrCreate([
            'order_id' => $order->id,
            'name' => 'Chausson Licorne',
            'quantity' => 2,
            'price' => 29.99,
            'image' => 'http://cdn1.commentseruiner.net/19417-large_default/chaussons-licorne-lumineux.jpg',
        ]);
    }
}
