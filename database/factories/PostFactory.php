<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,5),
        'category_id' => $faker->numberBetween(1,5),
        'title' => $faker->realText(20),
        'content' => $faker->realText(80),
        'thumbnail_path' => $faker->imageUrl(),
        'status' => 'publish'
    ];
});
