<?php

/** @var Factory $factory */

use App\Models\Todo;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        Todo::COLUMN_NAME => $faker->sentence(3),
        Todo::COLUMN_DESCRIPTION => $faker->realText(),
        Todo::COLUMN_DATE => $faker->dateTimeThisMonth->modify('+1 month'),
        Todo::COLUMN_STATUS => Todo::STATUS_LIST[array_rand(Todo::STATUS_LIST)]
    ];
});
