<?php

namespace MannikJ\Laravel\ModelConfigs\Tests;

use MannikJ\Laravel\ModelConfigs\Models\Categories\Category;
use Illuminate\Database\Eloquent\Collection;

class ModelConfigsTest extends LaravelTest
{
    /** @test */
    public function default_config_type_category_name()
    {
        $this->assertEquals('Config Types', \ModelConfigs::getConfigTypeRootCategoryName());
    }

    /** @test */
    public function create_config_rype_root_category()
    {
        $this->assertNull(\ModelConfigs::getConfigTypeRootCategory());
        $category = \ModelConfigs::createConfigTypeRootCategory();
        $this->assertNotNull($category);
        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals(\ModelConfigs::getConfigTypeRootCategoryName(), $category->name);
    }

    /** @test */
    public function get_config_type_root_category()
    {
        \ModelConfigs::createConfigTypeRootCategory();
        $category = \ModelConfigs::getConfigTypeRootCategory();
        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals(\ModelConfigs::getConfigTypeRootCategoryName(), $category->name);
    }

    /** @test */
    public function create_config_type()
    {
        $configType = \ModelConfigs::createConfigType('Priorities');
        $this->assertInstanceOf(Category::class, $configType);
        $this->assertInstanceOf(Category::class, $configType->parent);
        $this->assertEquals('Priorities', $configType->name);
        $this->assertEquals(\ModelConfigs::getConfigTypeRootCategoryName(), $configType->parent->name);
    }

    /** @test */
    public function create_config_types()
    {
        $configTypes = \ModelConfigs::createConfigTypes(['Priorities' => Config::class], 'Complexities');
        $this->assertCount(2, $configTypes);
    }
}
