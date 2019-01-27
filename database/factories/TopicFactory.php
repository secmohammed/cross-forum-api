<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Forum\Domain\Models\Topic::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,
        'slug' => Str::uuid(),
        'body' => $faker->sentence,
        'section_id' => factory(App\Forum\Domain\Models\Section::class)->create()->id,
        'user_id' => factory(App\Users\Domain\Models\User::class)->create()->id,
        'created_at' => Carbon::now()
    ];
});
