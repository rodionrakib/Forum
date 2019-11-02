<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => factory(\App\User::class)->create()->id,
       'thread_id' => factory(\App\Thread::class)->create()->id
    ];
});
