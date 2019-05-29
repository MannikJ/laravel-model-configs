<?php
use MannikJ\Laravel\ModelConfigs\Models\Config;
use MannikJ\Laravel\ModelConfigs\Models\ConfigKey;
use MannikJ\Laravel\ModelConfigs\Models\ConfigValue;

/*
 * You can place your custom package configuration in here.
 */

return [
    'autoload_migrations' => true,
    'configs' => [
        'table' => 'configs',
        'model' => Config::class,

    ],
    'configurables' => [
        'table' => 'configurables',
    ],
];
