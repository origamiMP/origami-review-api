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
            $table->increments('id');
            $table->string('reference');
            $table->integer('review_delay')->nullable();
            $table->dateTime('date');

            $table->integer('marketplace_id')->unsigned();
            $table->foreign('marketplace_id')->references('id')->on('marketplaces');

            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('sellers');

            $table->integer('customer_id')->unsigned();
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
