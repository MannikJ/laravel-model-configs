<?php

namespace MannikJ\Laravel\ModelConfigs\Models\Categories;

use Rinvex\Categories\Models\Category as VendorCategory;
use MannikJ\Laravel\ModelConfigs\Traits\HasConfigs;
use MannikJ\Laravel\SingleTableInheritance\Traits\SingleTableInheritance;

class Category extends VendorCategory
{
    use HasConfigs;
    use SingleTableInheritance;

    public function scopeConfigTypes($query)
    {
        return $query->byParentName(\ModelConfigs::getConfigTypeCategory());
    }

    public function scopeByParentName($query, $name)
    {
        return $query->whereHas('parent', function ($query) use ($name) {
            $query->where('name->en', $name);
        });
    }
}
