<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::firstOrCreate([
            'email' => 'admin-marketplace1@origami-review.com',
            'password' => \Illuminate\Support\Facades\Hash::make('testdev'),
            'organization_id' => \App\Models\Marketplace::where('name', 'Marketplace1')->first()->id,
            'organization_type' => '\App\Models\Marketplace'
        ]);

        \App\Models\User::firstOrCreate([
            'email' => 'admin-seller1@origami-review.com',
            'password' => \Illuminate\Support\Facades\Hash::make('testdev'),
            'organization_id' => \App\Models\Seller::where('name', 'Seller1')->first()->id,
            'organization_type' => '\App\Models\Seller'
        ]);
    }
}
