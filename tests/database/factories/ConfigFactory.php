<?php

use Faker\Generator as Faker;
use MannikJ\Laravel\ModelConfigs\Models\Config;

$class = config('model-configs.config.model', Config::class);

$factory->define($class, function (Faker $faker) {
    return [
        'name' => implode(' ', $faker->words($faker->numberBetween(1, 5))),
    ];
});

$factory->state($class, 'data', function ($faker) {
    return [
        'attributes' => [
            'AA' => [
                'price' => 7.50
            ],
            'A' => [
                'price' => 8.00
            ],
            'B' => [
                'price' => 13
            ],
            'C' => [
                'price' => 18
            ],
            'D' => [
                'price' => 23
            ],
            'E' => [
                'price' => 28
            ],
            'F' => [
                'price' => 33
            ],
            'G' => [
                'price' => 38
            ],
            'H' => [
                'price' => 43
            ],
            'I' => [
                'price' => 48
            ],
            'J' => [
                'price' => 53
            ],
            'K' => [
                'price' => 58
            ],
            'L' => [
                'price' => 63
            ],
            'M' => [
                'price' => 68
            ],
            'N' => [
                'price' => 73
            ]
        ]
    ];
});
