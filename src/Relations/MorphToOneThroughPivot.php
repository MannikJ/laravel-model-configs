<?php

namespace MannikJ\Laravel\ModelConfigs\Relations;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

class MorphToOneThroughPivot extends MorphToMany
{

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults()
    {
        if (is_null($this->getParentKey())) {
            return null;
        }

        return $this->query->first();
    }
}
