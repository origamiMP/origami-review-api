<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->integer('review_delay')->nullable();
            $table->dateTime('date');

            $table->uuid('marketplace_id');
            $table->foreign('marketplace_id')->references('id')->on('marketplaces');

            $table->uuid('seller_id');
            $table->foreign('seller_id')->references('id')->on('sellers');

            $table->uuid('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');

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
        Schema::dropIfExists('orders');
    }
}
