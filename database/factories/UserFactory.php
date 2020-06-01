<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {

    return [
        'name' => $faker->title,
        'email' => 'damilareanjorin@gmail.com',
        'isAdmin' => 1,
        'verified' => 1,
        'password' => Hash::make('damilare001'),
        'created_at' => now()
    ];
});
