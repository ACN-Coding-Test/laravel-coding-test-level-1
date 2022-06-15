<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


$factory->define(Event::class, function (Faker $faker) {
    $slug_string=$faker->unique()->text($maxNbChars = 50);
    $startAt = Carbon::now()->subDays(rand(0, 3))->format('Y-m-d');
    $endAt = Carbon::parse($startAt)->addDays(rand(0, 7))->format('Y-m-d');
    return [
        'name' =>$faker->unique()->text($maxNbChars = 20),
        'slug'=>Str::of($slug_string)->slug('-'),
        'startAt'=>$startAt,
        'endAt'=>$endAt,
    ];
});
