<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    $tag = ucfirst($faker->word);

    return [
        'name' => $tag,
        'slug' => str_slug($tag)
    ];
});
