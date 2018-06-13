<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_criteria', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->decimal('weight', 20, 6);

            $table->integer('marketplace_id')->unsigned();
            $table->foreign('marketplace_id')->references('id')->on('marketplaces');

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
        Schema::dropIfExists('marketplace_criterias');
    }
}
