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

$factory->define(App\Models\Presentation::class, function ($faker) {
    return [
        'room_id' => $faker->numberBetween($min=1, $max=20),
        'conference_id' => $faker->numberBetween($min=1, $max=20),
        'title' => $faker->catchPhrase,
        'start_time' => $faker->time,
        'end_time' => $faker->time,
        'abstract' => $faker->sentence($nbWords=30),
        'keywords' => $faker->sentence($nbWords=10),
                
    ];
});