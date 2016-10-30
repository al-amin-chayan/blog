<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Profile::class, function (Faker\Generator $faker) {
    return [
        'picture' => $faker->image(public_path('uploads/profile-picture'), 200, 300, 'people', false),
        'bio' => $faker->paragraph(5),
        'web' => $faker->url,
        'facebook' => 'https://www.facebook.com/' . $faker->unique()->firstName,
        'twitter' => 'https://www.twitter.com/' . $faker->unique()->firstName,
        'github' => 'https://www.github.com/' . $faker->unique()->lastName,
    ];
});
