<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Zan;
use Faker\Generator as Faker;

$factory->define(Zan::class, function (Faker $faker) {
    return [
        //
        'post_id' => $faker->numberBetween(1,100),
        'user_id' => $faker->numberBetween(1,9),
    ];
});
