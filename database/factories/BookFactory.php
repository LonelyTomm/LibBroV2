<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'author'=>$faker->name,
        'publisher'=>$faker->name,
        'title'=>$faker->name,
        'genre'=>'history;thriller;horror;',
        'quantity'=>$faker->randomDigitNotNull,
        'imgpath'=>'oblozhka-0001.jpg',
        'description'=>$faker->text($maxNbChars=200),
    ];
});
