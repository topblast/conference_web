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

$factory->define(App\Models\Client::class, function ($faker) {
    return [
        'contact_name' => $faker->name,
        'email' => $faker->email,
        'password' => $faker->password,
        'organisation' => $faker->company,
        'address1' => $faker->address,
        'address2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'country' => $faker->country,
        
    ];
});