<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function(Faker $faker) {
    return [
        'buyer_id' => App\User::inRandomOrder()->first()->id,
        // 'book_id' => App\Book::inRandomOrder()->first()->id,
        'credits' => $faker->numberBetween(10, 100),
        'completed' => $faker->boolean,
        'completed_at' => \Carbon\Carbon::now()
    ];
});