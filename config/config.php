<?php
use MannikJ\Laravel\ModelConfigs\Models\Config;
use MannikJ\Laravel\ModelConfigs\Models\ConfigurablePivot;

/*
 * You can place your custom package configuration in here.
 */

return [
    'autoload_migrations' => true,
    'configs' => [
        'table' => 'configs',
        'model' => Config::class,
        'type_category' => 'Config Types'

    ],
    'configurables' => [
        'table' => 'configurables',
        'model' => ConfigurablePivot::class,
    ],
];
