<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_title' => $faker->sentence(7, 12),
        'post_content' => $faker->sentence(7, 12),
        'image_path' => 'post_images/default_image.jpg',
    ];
});
