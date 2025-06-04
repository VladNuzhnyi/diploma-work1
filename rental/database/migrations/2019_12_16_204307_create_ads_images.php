<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img_name_hash');
            $table->unsignedBigInteger('ads_id');
            $table->foreign('ads_id')->references('id')->on('ads');
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
        Schema::dropIfExists('ads_images');
//        (new CreateAdStatistics())->down();
    }
}
