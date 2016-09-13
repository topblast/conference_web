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

$factory->define(App\Models\Category::class, function ($faker) {
    return [
        'name' => $faker->name,
        'keywords' => $faker->sentence($nbWords = 8),
        'parent_id' => $faker->numberBetween($min=1, $max=20),
    ];
});