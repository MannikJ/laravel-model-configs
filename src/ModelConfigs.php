<?php

namespace MannikJ\Laravel\ModelConfigs;

use MannikJ\Laravel\ModelConfigs\Models\Categories\Category;
use MannikJ\Laravel\ModelConfigs\Models\ConfigurablePivot;

class ModelConfigs
{

    protected $configTypeRootCategory;

    public function getCategoryModel()
    {
        return config('rinvex.categories.models.category', Category::class);
    }

    public function getConfigurableModel()
    {
        return config('model-configs.configurables.model', ConfigurablePivot::class);
    }

    public function getConfigTypeRootCategoryName()
    {
        return config('model-configs.configs.type_category', 'Config Types');
    }

    public function createConfigTypeRootCategory(): Category
    {
        $this->configTypeRootCategory = Category::make();
        $this->configTypeRootCategory->name = $this->getConfigTypeRootCategoryName();
        $this->configTypeRootCategory->save();
        return $this->configTypeRootCategory;
    }

    public function getConfigTypeRootCategory($createIfNotExists = false): ?Category
    {
        if ($this->configTypeRootCategory) {
            return $this->configTypeRootCategory;
        }

        if ($this->configTypeRootCategory = Category::where('name->en', $this->getConfigTypeRootCategoryName())->first()) {
            return $this->configTypeRootCategory;
        }

        if ($createIfNotExists) {
            return $this->createConfigTypeRootCategory();
        }

        return $this->configTypeRootCategory;
    }

    public function createConfigType($name, $configClass = null)
    {
        $configType = $this->getConfigTypeRootCategory(true)->children()
            ->make(['name' => $name]);
        $configType->meta->config_class = $configClass;
        $configType->save();
        return $configType;
    }

    public function createConfigTypes(...$types)
    {
        $configTypes = collect();
        foreach ($types as $key => $value) {
            $configClass = null;
            $name = $value;
            if (is_array($value)) {
                $name = array_keys($value)[0];
                $configClass = $value[$name];
            }
            $configTypes->push($this->createConfigType($name, $configClass));
        }
        return $configTypes;
    }
}
