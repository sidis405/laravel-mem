<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $category = ucfirst($faker->words(2, true));

    return [
        'name' => $category
    ];
});
