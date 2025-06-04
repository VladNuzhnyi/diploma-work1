<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("email")->unique();
            $table->string("password");
            $table->string("jwt_token")->nullable();
            $table->string("name")->nullable();
            $table->string("second_name")->nullable();
            $table->string("phone", 12)->nullable();
            $table->string("address")->nullable();
            $table->string("city")->nullable();
            $table->boolean("is_verified")->default(false);
            $table->string("image_base64")->nullable();
            $table->boolean("two_factor_auth")->default(false);
            $table->float('rating', 2,1)->nullable();
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
        Schema::dropIfExists('users');
    }
}
