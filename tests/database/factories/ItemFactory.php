<?php

use Faker\Generator as Faker;
use MannikJ\Laravel\ModelConfigs\Tests\Models\Item;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->name()
    ];
});
