<?php

namespace MannikJ\Laravel\ModelConfigs\Models\Categories;

use Rinvex\Categories\Models\Category as VendorCategory;
use MannikJ\Laravel\ModelConfigs\Traits\HasConfigs;
use MannikJ\Laravel\SingleTableInheritance\Traits\SingleTableInheritance;
use Spatie\SchemalessAttributes\SchemalessAttributes;
use Illuminate\Database\Eloquent\Builder;

class Category extends VendorCategory
{
    use HasConfigs;
    use SingleTableInheritance;

    protected static $stiSubclasses = [
        ConfigType::class
    ];

    public $casts = [
        'meta' => 'array',
    ];

    public function getMetaAttribute(): SchemalessAttributes
    {
        return SchemalessAttributes::createForModel($this, 'meta');
    }

    public function scopeWithMeta(): Builder
    {
        return SchemalessAttributes::scopeWithSchemalessAttributes('meta');
    }

    public function scopeConfigTypes($query, $names = null)
    {
        $query->byParentName(\ModelConfigs::getConfigTypeRootCategoryName());
        if ($names) {
            $query->whereIn('name', $names);
        }
        return $query;
    }

    public function scopeByParentName($query, $name)
    {
        return $query->whereHas('parent', function ($query) use ($name) {
            $query->where('name->en', $name);
        });
    }
}
