<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => factory(App\User::class)->create()->id,
        'channel_id' => factory(App\Channel::class)->create()->id,
    ];
});
