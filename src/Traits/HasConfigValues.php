<?php

namespace MannikJ\Laravel\ModelConfigs\Traits;

use Rinvex\Categories\Traits\Categorizable;

trait HasConfigValues
{
    use Categorizable;

    public function model()
    {
        return $this->morphs('model');
    }

    public function category()
    {
        return $this->belongsTo('category');
    }
}
