<?php

use Faker\Generator as Faker;
use MannikJ\Laravel\ModelConfigs\Models\Config;

$factory->define(Config::class, function (Faker $faker) {
    return [
        'name' => implode(' ', $faker->words($faker->numberBetween(1, 5))),
    ];
});
