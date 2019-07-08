<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Movie;
use Faker\Generator as Faker;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->sentences(1,true),
        'director' => $faker->name(),
        'imageUrl' => $faker->imageUrl(),
        'duration' => $faker->numberBetween(60,180),
        'releaseDate' => $faker->date(),
        'genre' => $faker->sentences(1,true),
    ];
});