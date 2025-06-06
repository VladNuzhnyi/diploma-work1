<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\DAL\Models\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'second_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '12345678', // password
        'address' => $faker->address,
        'city' => $faker->city,
        'is_verified' => 0,

    ];
});

