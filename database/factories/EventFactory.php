<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->name(),
        'slug' => Str::slug($name),
        'startAt' => $faker->dateTimeBetween('now', '+01 days'),
        'endAt' => $faker->dateTimeBetween('now', '+30 days')
    ];
});


