echo '' > ./database/testing/stubdb.sqlite
php artisan migrate:refresh --seed --database=setup --env=spec
phpunit