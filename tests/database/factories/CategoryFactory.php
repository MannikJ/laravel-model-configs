<?php

use Faker\Generator as Faker;
use MannikJ\Laravel\ModelConfigs\Models\Categories\Category;
use Illuminate\Support\Str;
use MannikJ\Laravel\ModelConfigs\Models\Categories\ConfigType;

$class = config('rinvex.categories.models.categories', Category::class);
$factory->define($class, function (Faker $faker) {
    return ['name' => 'TEST'];
});

$subclasses = [ConfigType::class];

foreach ($subclasses as $subclass) {
    $function = function (Faker $faker) use ($subclass) {
        return [
            'type' => $subclass,
            'name' => $faker->name(),
        ];
    };

    $factory->state($class, $subclass, $function);
    $factory->state($class, Str::kebab(class_basename($subclass)), $function);
    $factory->define($subclass, $function);
}
