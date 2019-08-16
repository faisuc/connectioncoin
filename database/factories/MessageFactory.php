<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {

    do {
        $from = rand(1, 3);
        $to = rand(1, 3);
    } while ($from == $to);

    return [
        'from_user_id' => $from,
        'to_user_id' => $to,
        'text' => $faker->sentence
    ];
});
