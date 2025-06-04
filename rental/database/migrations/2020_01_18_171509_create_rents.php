<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_owner_id');
            $table->unsignedBigInteger('item_renter_id');
            $table->unsignedBigInteger('ad_id');
            $table->unsignedBigInteger('status_id');

            $table->date('date_rent_from');
            $table->date('date_rent_to');
            $table->float('one_day_price');
            $table->float('deposit')->nullable();
            $table->string('invoice_nr')->unique();
            $table->string('rent_item_title');

            $table->foreign('item_owner_id')->references("id")->on('users');
            $table->foreign('item_renter_id')->references("id")->on('users');
            $table->foreign('ad_id')->references("id")->on('ads');
            $table->foreign('status_id')->references("id")->on('rent_statuses');

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
        Schema::dropIfExists('rents');
    }
}
