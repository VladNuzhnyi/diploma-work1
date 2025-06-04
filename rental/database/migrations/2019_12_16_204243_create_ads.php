<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_title');
            $table->integer('min_rent_days');
            $table->float('one_day_price');
            $table->string('description');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('category_id');
            $table->string('address');
            $table->json('additional_parameters');
            $table->float('deposit')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references("id")->on("users");
            $table->foreign('region_id')->references("id")->on("regions");
            $table->foreign('category_id')->references("id")->on("category");

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
        Schema::dropIfExists('ads');
    }
}
