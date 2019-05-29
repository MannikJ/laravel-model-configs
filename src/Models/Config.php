<?php

namespace MannikJ\Laravel\ModelConfigs\Models;

use Illuminate\Database\Eloquent\Model;
use Rinvex\Categories\Traits\Categorizable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Versionable\VersionableTrait;

class Config extends Model
{
    use Categorizable;
    use SoftDeletes;
    use VersionableTrait;

    public function type()
    {
        return $this->morphOne(
            config('rinvex.categories.models.category'),
            'categorizable',
            config('rinvex.categories.tables.categorizables'),
            'categorizable_id',
            'category_id'
        )->whereHas('parent', function ($query) {
            $query->where('name->en', 'Config Type');
        })->withTimestamps();
    }

    public function getSchema()
    {
        return null;
    }
}
