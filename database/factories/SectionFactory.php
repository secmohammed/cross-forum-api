<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Forum\Domain\Models\Section::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,
        'slug' => Str::uuid(),
        'description' => $faker->sentence,
    ];
});
