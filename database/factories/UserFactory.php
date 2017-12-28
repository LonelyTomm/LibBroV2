<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => 'mngr@jerh.com',
        'password' => bcrypt('123456'),
        'login'=>'manager',
        'phonenumber'=>'256854851245',
        'birth'=>'1998-10-15',
        'type'=>'M',
        'remember_token' => str_random(10),
    ];
});
