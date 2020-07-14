<?php


$factory->define(App\Model\Menu::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    $menus = App\Model\Menu::all();
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'parent' => (count($menus) > 0) ? $faker->randomElement($menus->pluck('id')->toArray()) : 0,
        'order' => 0
    ];
});
