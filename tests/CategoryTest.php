<?php

namespace MannikJ\Laravel\ModelConfigs\Tests;

use MannikJ\Laravel\ModelConfigs\Models\Config;
use MannikJ\Laravel\ModelConfigs\Models\Categories\Category;
use MannikJ\Laravel\ModelConfigs\Models\Categories\ConfigType;

class CategoryTest extends LaravelTest
{
    public function type()
    {
        $configCategory = Category::create(['name' => 'Config Types']);
        $schemaCategory = Category::create(['name' => 'JSON Schema']);
        $schemaCategory->configs()->create(['name' => 'Default']);
        $priceCategory = $configCategory->children()->create(['name' => 'Price']);
        $currencyCategory = Category::create(['name' => 'Currencies']);
        $currencies = collect(['EUR', 'USD']);
        foreach ($currencies as $currency) {
            $currencyCategory->children()->create(['name' => $currency]);
        }
        $priceAttributeCategory = factory(Category::class)->create(['name' => 'Attribute']);
        $priceAttributes = collect([
            'Base Price' => [],
            'Priorities' => ['AA', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'],
            'Complexities' => range(1, 24)
        ]);
        foreach ($priceAttributes as $key => $subCategories) {
            $priceAttributeCategory->children()->create(['name' => $key]);
            foreach ($subCategories as $subCategory) {
                $priceAttributeCategory->children()->create(['name' => $subCategory . '']);
            }
        }
        $basePriceCategory = $priceAttributeCategory->children()->where('name->en', 'Base Price')->first();

        $config = factory(Config::class)
            ->create([
                'name' => 'default',
                'data' => ['base_price' => 5]
            ]);

        $config->attachCategories($basePriceCategory);
    }

    /** @test */
    public function category_can_use_sti()
    {
        $sub = factory(ConfigType::class)->create();
        $this->assertInstanceOf(ConfigType::class, $sub);
    }

    public function scope_config_types()
    {
        $configTypes = \ModelConfigs::getConfigTypes();
        $this->assertInstanceOf(Collection::class, $configTypes);
    }
}
