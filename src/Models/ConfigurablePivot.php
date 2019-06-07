<?php

namespace MannikJ\Laravel\ModelConfigs\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ConfigurablePivot extends Pivot
{
    protected $table = 'configurables';

    public function config()
    {
        return $this->belongsTo(config('model-configs.configs.model', Config::class));
    }

    public function configurable()
    {
        return $this->morphTo('configurable');
    }
}
