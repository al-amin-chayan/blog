<?php

/*
|--------------------------------------------------------------------------
| Article Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomElement(App\Models\User::pluck('id')->toArray()),
        'details' => $faker->text(220),
        'created_at' => $faker->dateTimeThisYear()
    ];
});
