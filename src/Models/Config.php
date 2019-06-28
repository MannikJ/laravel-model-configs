<?php

namespace MannikJ\Laravel\ModelConfigs\Models;

use Illuminate\Database\Eloquent\Model;
use Rinvex\Categories\Traits\Categorizable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Versionable\VersionableTrait;
use MannikJ\Laravel\SingleTableInheritance\Traits\SingleTableInheritance;
use Spatie\SchemalessAttributes\SchemalessAttributes;
use Illuminate\Database\Eloquent\Builder;

class Config extends Model
{
    use Categorizable;
    use SoftDeletes;
    use VersionableTrait;
    use SingleTableInheritance;

    protected $fillable = [
        'name'
    ];

    public $casts = [
        'data' => 'array',
    ];

    public function getDataAttribute(): SchemalessAttributes
    {
        return SchemalessAttributes::createForModel($this, 'data');
    }

    public function scopeWithData(): Builder
    {
        return SchemalessAttributes::scopeWithSchemalessAttributes('data');
    }

    public function typeCategory()
    {
        return $this->categories()->configTypes()
            ->limit(1);
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->ensureTypeCharacteristics();
        });
    }

    public function resolveTypeViaAttributes($attributes = [])
    {
        if ($typeCategory = $this->typeCategory()->first()) {
            return $typeCategory->meta->config_class;
        }
    }

    public function applyTypeCharacteristics($type)
    {
        if (!$this->exists) {
            return;
        }
        $typeCategory = \ModelConfigs::getCategoryModel()::withMeta(['config_class' => $type])->first();
        \Log::debug($typeCategory);
        $this->typeCategory()->attach($typeCategory);
        $this->unsetRelation('typeCategory');
    }

    public function scopeSti(Builder $builder)
    {
        $builder->whereHas('typeCategory', function ($query) use ($builder) {
            $query->withMeta(['config_class' => static::class]);
        });
    }

    public function configurablePivots()
    {
        return $this->hasMany(\ModelConfig::getConfigurableModel());
    }
}
