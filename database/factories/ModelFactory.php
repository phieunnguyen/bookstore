<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'order' => rand(-100,100), // secret
        'parent' => 0,
    ];
});


$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => strtoupper(str_random(6)),
        'summary' => $faker->text,
        'regular_price' => rand(1,1000),
        'sale_price' => rand(1001,2000),
        'original_price' => rand(1,1000),
        'quantity' => rand(1,100),
        'attributes' => '',
        'image' => '',
        'user_id' => rand(1,50),
        'category_id' => rand(1,50),
    ];
});

$factory->define(App\Tag::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => str_slug($name),
    ];
});

$factory->define(App\Order::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'user_id' => rand(1,50),
        'address' => $faker->text(80),
        'email' => $faker->email, 
        'phone' => $faker->phoneNumber,
    ];
});
