<?php

namespace MannikJ\Laravel\ModelConfigs\Tests;

use MannikJ\Laravel\ModelConfigs\Models\Config;
use MannikJ\Laravel\ModelConfigs\Models\Categories\Category;
use MannikJ\Laravel\ModelConfigs\Tests\Models\PriorityConfig;

class ConfigTest extends LaravelTest
{
    /** @test */
    public function has_type()
    {
        $config = factory(Config::class)
            ->create(['name' => 'Test']);
        $this->assertEquals('Test', $config->name);
        $configType = \ModelConfigs::createConfigType('Priorities');
        $config->typeCategory()->attach($configType);
        $this->assertNotNull($config->typeCategory()->first());
        $this->assertInstanceOf(Category::class, $config->typeCategory()->first());
    }

    /** @test */
    public function can_resolve_config_class_through_type_category()
    {
        $config = factory(Config::class)
            ->create(['name' => 'Test']);
        $configType = \ModelConfigs::createConfigType('Priorities', PriorityConfig::class);
        $this->assertEquals('Priorities', $configType->name);
        $this->assertEquals(PriorityConfig::class, $configType->meta->config_class);
        $config->typeCategory()->attach($configType);
        $this->assertNotNull($config->typeCategory()->first());
        $config->unsetRelation('typeCategory');
        $this->assertInstanceOf(Category::class, $config->typeCategory()->first());
        $this->assertInstanceOf(PriorityConfig::class, $config->fresh());
    }

    /** @test */
    public function automatically_attaches_type_category_when_subclass_is_used()
    {
        $configType = \ModelConfigs::createConfigType('Priorities', PriorityConfig::class);
        $config = factory(PriorityConfig::class)
            ->create(['name' => 'My Priorities']);
        $this->assertEquals('Priorities', $configType->name);
        $this->assertEquals(PriorityConfig::class, $configType->meta->config_class);
        $this->assertTrue($config->typeCategory->first()->is($configType));
    }

    /** @test */
    public function scope_sti()
    {
        \ModelConfigs::createConfigType('Priorities', PriorityConfig::class);
        factory(Config::class)
            ->create(['name' => 'Test']);
        factory(PriorityConfig::class)
            ->create(['name' => 'My Priorities']);
        $this->assertEquals(2, Config::count());
        $this->assertEquals(1, PriorityConfig::count());
    }

    /** @test */
    public function schemaless_attributes()
    {
        $config = factory(Config::class)->make();
        $config->save();
        $config = factory(Config::class)->make();
        $config->data = [
            'base_price' => 10
        ];
        $config->save();
        $configs = $config->withData(['base_price' => 10])->get();
        $this->assertCount(1, $configs);
    }
}
