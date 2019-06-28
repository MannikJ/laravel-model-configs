<?php

namespace MannikJ\Laravel\ModelConfigs;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MannikJ\Laravel\ModelConfigs\Skeleton\SkeletonClass
 */
class ModelConfigsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'model-configs';
    }
}
