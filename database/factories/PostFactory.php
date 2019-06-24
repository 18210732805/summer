<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5,true),
        'content' => $faker->paragraph(10,true),
        'user_id' => $faker->randomDigitNotNull,
    ];
});
