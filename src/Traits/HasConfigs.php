<?php

namespace MannikJ\Laravel\ModelConfigs\Traits;

use MannikJ\Laravel\ModelConfigs\Models\Config;

trait HasConfigs
{
    public function configs()
    {
        return $this->morphToMany(config('model-configs.configs.model', Config::class), 'configurable');
    }
}
