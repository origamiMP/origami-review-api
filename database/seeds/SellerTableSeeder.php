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
        $this->createSeller('Cuteland', 'https://cute.land/img/cute-land-logo-1447340489.jpg', 'https://pbs.twimg.com/profile_images/659387979081871360/BYKlTWqh.jpg');
        $this->createSeller('Geekstore', 'https://www.geekstore.fr/c/10000130-category_default/exclusivit%C3%A9-geek-store.jpg', 'https://www.myfrenchstartup.com/logo/geekstore.png');
        $this->createSeller('Nodshop', 'https://nodshop.com/img/cadeau-original-et-idee-cadeaux-nodshop-logo-14840666411.jpg', 'https://ideecadeaufrance.com/wp-content/themes/idee-cadeau-theme/img/partenaires/icf/nodshop-logo.jpg');
        $this->createSeller('SuperInsolite', 'http://touteslesbox.fr/wp-content/uploads/2017/10/super-insolite-350x185.jpg', 'https://www.super-insolite.com/wp-content/themes/super-insolite/assets/img/logo/s.png');
        $this->createSeller('Disney', 'https://upload.wikimedia.org/wikipedia/fr/8/86/Logo_DisneyStore.png', 'https://res.cloudinary.com/goodsearch/image/upload/v1506656074/hi_resolution_merchant_logos/disney-store_coupons.jpg');
        $this->createSeller('CoinDuGeek', 'https://www.coindugeek.com/modules/nq_social/images/1/fr/social.jpg', 'https://image.noelshack.com/fichiers/2018/33/1/1534169056-download.png');
    }

    public function createSeller(string $name, string $image_cover, string $image_profile)
    {
        $seller = \App\Models\Seller::firstOrCreate([
            'name' => $name,
            'image_cover' => $image_cover,
            'image_profile' => $image_profile,
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            'website_link' => "cute.land",
            'phone' => 'O64242424242',
            'email' => 'contact@'.$name.'.com',
            'address' => '165 avenue de Bretagne 59000 Lille',
            'verified_rating_total' => 0,
            'verified_rating_count' => 0,
            'unverified_rating_total' => 0,
            'unverified_rating_count' => 0,
        ]);

        \App\Models\User::firstOrCreate([
            'email' => 'admin-'.$name.'@origami-review.com',
            'password' => \Illuminate\Support\Facades\Hash::make('testdev'),
            'organization_id' => $seller->id,
            'organization_type' => 'App\Models\Seller'
        ]);

    }
}
