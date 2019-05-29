<?php

namespace MannikJ\Laravel\ModelConfigs\Models;

use Rinvex\Categories\Models\Category as VendorCategory;
use MannikJ\Laravel\ModelConfigs\Traits\HasConfigs;
use Illuminate\Support\Traits\ForwardsCalls;

class Category extends VendorCategory
{
    use HasConfigs;
    use ForwardsCalls;

    /**
     * Dynamically pass method calls to the service model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (!$this->handler_class) {
            return;
        }
        return $this->forwardCallTo(app($this->handler_class), $method, $parameters);
    }
}
