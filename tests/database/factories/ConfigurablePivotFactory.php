<?php

use Faker\Generator as Faker;
use MannikJ\Laravel\ModelConfigs\Models\ConfigurablePivot;
use MannikJ\Laravel\ModelConfigs\Tests\Models\Item;

$class = config('model-configs.configurables.model', ConfigurablePivot::class);
$factory->define($class, function (Faker $faker) {
    return [
        'config_id' => function () {
            return factory(Config::class)->create()->id;
        }
    ];
});

$factory->afterMaking($class, function ($configurablePivot) {
    if (!$configurablePivot->configurable) {
        $item = factory(Item::class)->create();
        $configurablePivot->configurable()->associate($item);
    }
});
