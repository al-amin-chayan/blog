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
$factory->define(App\Models\Article::class, function (Faker\Generator $faker) {
    $placeholders = ['abstract', 'animals', 'business', 'cats', 'city', 'food', 
        'nightlife', 'fashion', 'people', 'nature', 'sports', 'technics', 'transport'];
    
    $img_type = $faker->randomElement($placeholders);
    return [
        'subject_id' => $faker->randomElement(App\Models\Subject::pluck('id')->toArray()),
        'title' => $faker->text(120),//$maxNbChars = 120
        'sub_title' => $faker->sentence(5),
        'summary' => $faker->paragraph(4),//$nbSentences = 4, $variableNbSentences = true
        'details' => $faker->paragraph(20),//$nbSentences = 4, $variableNbSentences = true
        'image' => $faker->image(public_path('uploads/article-image'), 900, 300, $img_type, false),
        'display' => 'Y',
        'created_at' => $faker->dateTimeThisYear()
    ];
});
