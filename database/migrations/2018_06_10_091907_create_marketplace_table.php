<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplaces', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->string('name');
            $table->integer('verified_rating_total')->default(0);
            $table->integer('verified_rating_count')->default(0);
            $table->integer('unverified_rating_total')->default(0);
            $table->integer('unverified_rating_count')->default(0);

            $table->string('image_cover')->nullable();
            $table->string('image_profile')->nullable();
            $table->text('description')->nullable();
            $table->string('website_link')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            $table->string('wallet')->nullable();
            $table->integer('default_review_delay')->default(48);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketplaces');
    }
}
