<?php

use App\Forum\Domain\Models\Topic;
use App\Users\Domain\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Forum\Domain\Models\Post::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence,
        'topic_id' => factory(Topic::class)->create()->id,
        'user_id' => factory(User::class)->create()->id,
        'created_at' => Carbon::now()
    ];
});
