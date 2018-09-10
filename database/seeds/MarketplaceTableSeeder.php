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
        $this->createMarketplace(
            'Amazon',
            'Amazon.com, Inc., is an American electronic commerce and cloud computing company based in Seattle, Washington, that was founded by Jeff Bezos on July 5, 1994. The tech giant is the largest Internet retailer in the world as measured by revenue and market capitalization, and second largest after Alibaba Group in terms of total sales. The amazon.com website started as an online bookstore and later diversified to sell video downloads/streaming, MP3 downloads/streaming, audiobook downloads/streaming, software, video games, electronics, apparel, furniture, food, toys, and jewelry.',
            'https://www.amazon.com/',
            'Seattle, Washington, U.S.',
            env('API_URL') . 'images/couverture-amazon.jpg',
            env('API_URL') . 'images/logo-amazon.jpg'
        );

        $this->createMarketplace(
            'CDiscount',
            '"Cdiscount is a French e-commerce website with a broad offer: a wide range of products including, among others, cultural goods, high-tech, IT, household appliances, personal appliances and food. Historically Cdiscount has positioned itself as a discount online retailer. It is currently the most important French e-commerce website in terms of turnover with a growth superior to the market’s average in 2013."',
            'https://www.cdiscount.com/',
            'Bordeaux, France',
            env('API_URL') . 'images/couverture-cdiscount.jpg',
            env('API_URL') . 'images/logo-cdiscount.jpg'
        );

        $this->createMarketplace(
            'CommentSeRuiner',
            'Commentseruiner.com is a fun and geek specialized marketplace which offer its cutomer a lot of original and marvellous content. Launched in 2015 in Lille, North of France this marketplace is run by The Origami Marketplace solution.',
            'http://commentseruiner.com/',
            'Lille, France',
            env('API_URL') . 'images/couverture-csr.jpg',
            env('API_URL') . 'images/logo-csr.jpg'
        );

        $this->createMarketplace(
            'Rakuten',
            'Rakuten, Inc. is a Japanese electronic commerce and Internet company based in Tokyo and founded in 1997 by Hiroshi Mikitani. Its B2B2C e-commerce platform Rakuten Ichiba is the largest e-commerce site in Japan and among the world’s largest by sales. The company operates Japan\'s biggest Internet bank and third-largest credit card company (by transaction value). It also offers e-commerce, fintech, digital content and communications services to over 1 billion members around the world, and operates in 29 countries and regions.',
            'http://global.rakuten.com/group/',
            'Setagaya, Tokyo, Japan',
            env('API_URL') . 'images/couverture-rakuten-price-minister.jpg',
            env('API_URL') . 'images/logo-rakuten-price-minister.jpg'
        );

        $this->createMarketplace(
            'Fnac',
            'Fnac is a large French retail chain selling cultural and electronic products, founded by André Essel and Max Théret in 1954. Its head office is in Le Flavia in Ivry-sur-Seine near Paris. Fnac is an abbreviation of Fédération Nationale d’Achats des Cadres ("National Purchasing Federation for Cadres)',
            'https://www.fnac.com/',
            'Le Flavia, Ivry-sur-Seine, France',
            env('API_URL') . 'images/couverture-fnac.jpg',
            env('API_URL') . 'images/logo-fnac.jpg'
        );

    }

    public function createMarketplace(string $name, string $description, string $website_link, string $address, string $image_cover, string $image_profile)
    {
        $marketplace = \App\Models\Marketplace::firstOrCreate([
            'name' => $name,
            'image_cover' => $image_cover,
            'image_profile' => $image_profile,
            'description' => $description,
            'website_link' => $website_link,
            'phone' => 'O64242424242',
            'email' => 'contact@' . $name . '.com',
            'address' => $address,
            'verified_rating_total' => 0,
            'verified_rating_count' => 0,
            'unverified_rating_total' => 0,
            'unverified_rating_count' => 0,
        ]);

        \App\Models\User::firstOrCreate([
            'email' => 'admin-' . $name . '@origami-review.com',
            'password' => \Illuminate\Support\Facades\Hash::make(uniqid()),
            'organization_id' => $marketplace->id,
            'organization_type' => 'App\Models\Marketplace'
        ]);

        \App\Models\MarketplaceCriteria::firstOrCreate([
            'name' => 'Product quality',
            'weight' => 5,
            'marketplace_id' => $marketplace->id
        ]);
        \App\Models\MarketplaceCriteria::firstOrCreate([
            'name' => 'Shipping speed',
            'weight' => 5,
            'marketplace_id' => $marketplace->id
        ]);
    }
}
