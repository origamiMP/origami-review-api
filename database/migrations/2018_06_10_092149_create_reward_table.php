<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->integer('amount');
            $table->string('wallet');
            $table->boolean('sent');
            $table->string('blockchain_block_id');
            $table->string('blockchain_tx_id');

            $table->uuid('review_id');
            $table->foreign('review_id')->references('id')->on('reviews');

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
        Schema::dropIfExists('rewards');
    }
}
