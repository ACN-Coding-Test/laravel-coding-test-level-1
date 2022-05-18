<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Event::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'id' => Str::uuid(),
        'name' => $name,
        'slug'=>Str::slug($name),
        'startAt'=>now(),
        'endAt'=>now()->addDay(1)

    ];
});
