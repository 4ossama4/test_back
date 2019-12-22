<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Course;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/



$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->slug
    ];
});


$factory->define(Course::class, function (Faker $faker) {


    return [
        'category_id' => $faker->numberBetween($min = 1,$max = 15),
        'name' => $faker->name,
        'description' => $faker->text(),
        'slug' => $faker->slug
    ];
});
