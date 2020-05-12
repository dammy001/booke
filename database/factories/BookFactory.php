<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'author' => $faker->word,
        'type' => $faker->word,
        'pages' => $faker->word,
        'description' => $faker->word,
        'released' => $faker->word,
        'image' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'user_id' => $faker->word,
        'category_id' => $faker->word
    ];
});
