<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('genre_id');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();


            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
