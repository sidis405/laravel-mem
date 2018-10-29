<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'preview' => $faker->paragraph,
        'body' => $faker->paragraphs(6, true),
        'user_id' => factory(App\User::class),
        'category_id' => factory(App\Category::class)
    ];
});
