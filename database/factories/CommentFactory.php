<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'post_id' => $faker->numberBetween(1,100),
        'user_id' => $faker->randomDigitNotNull,
        'content' => $faker->sentence(5,true),
    ];
});
