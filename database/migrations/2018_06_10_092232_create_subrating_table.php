<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubratingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_criteria_ratings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('rating');

            $table->integer('marketplace_criteria_id')->unsigned();
            $table->foreign('marketplace_criteria_id')->references('id')->on('marketplace_criteria');

            $table->uuid('review_id');
            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');

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
        Schema::dropIfExists('marketplace_criteria_ratings');
    }
}
