<?php

use Illuminate\Database\Seeder;

class ReviewStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ReviewState::firstOrCreate(['name' => 'CREATED']);
        \App\Models\ReviewState::firstOrCreate(['name' => 'ACCEPTED']);
        \App\Models\ReviewState::firstOrCreate(['name' => 'REFUSED']);
        \App\Models\ReviewState::firstOrCreate(['name' => 'CERTIFIED']);
    }
}
