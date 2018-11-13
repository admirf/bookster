<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function(Faker $faker) {
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'category_id' => App\Category::inRandomOrder()->first()->id,
        'title' => $faker->title,
        'price' => $faker->numberBetween(0, 100),
        'edition' => $faker->title,
        'num_of_pages' => $faker->numberBetween(100, 500),
        'isbn' => $faker->isbn10
    ];
});