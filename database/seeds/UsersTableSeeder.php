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
            'name' => 'Admin1',
            'email' => 'admin1@origami-review.com',
            'password' => \Illuminate\Support\Facades\Hash::make('testdev')
        ]);
    }
}
