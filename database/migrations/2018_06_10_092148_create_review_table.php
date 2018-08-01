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

            $table->text('text');
            $table->integer('rating');
            $table->integer('review_state_id')->unsigned();
            $table->foreign('review_state_id')->references('id')->on('review_states');

            $table->uuid('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->string('ddb_node_id')->nullable();
            $table->string('ddb_supplier')->nullable();
            $table->string('blockchain_block_id')->nullable();
            $table->string('blockchain_tx_id')->nullable();
            $table->string('blockchain_supplier')->nullable();
            $table->string('wallet')->nullable();
            $table->string('hash')->nullable();
            $table->string('signed_hash')->nullable();

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
