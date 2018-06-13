<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->string('wallet');
            $table->text('text');
            $table->integer('rating');
            $table->string('ddb_node_id');
            $table->string('ddb_supplier');
            $table->string('blockchain_block_id');
            $table->string('blockchain_tx_id');
            $table->string('blockchain_supplier');

            $table->integer('review_state_id')->unsigned();
            $table->foreign('review_state_id')->references('id')->on('review_states');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');

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
        Schema::dropIfExists('reviews');
    }
}
