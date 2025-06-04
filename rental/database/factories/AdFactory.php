<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Http\DAL\Models\Ad::class, function (Faker $faker) {
    return [
        "item_title"=>"Drill ".$faker->domainWord,
        "min_rent_days"=>'1',
        "one_day_price"=>rand(20,300),
        "description"=> $faker->realText(),
        "region_id"=>'1',
        "address"=> $faker->address,
        "additional_parameters"=>'["param1","param1"]',
        "user_id"=> rand(1,30),
    ];
});

$factory->state(\App\Http\DAL\Models\Ad::class, 'instruments', function ($faker) {
    return [
        "item_title" => "Drill ".$faker->domainWord,
        "category_id" => '4'
    ];
});

$factory->state(\App\Http\DAL\Models\Ad::class, 'sport', function ($faker) {
    return [
        "item_title" => "Bicycle ".$faker->domainWord,
        "category_id" => '6'
    ];
});
