<?php

namespace MannikJ\Laravel\ModelConfigs\Traits;

trait HasConfigs
{
    public function configs()
    {
        return $this->morphToMany('configurable');
    }
}
