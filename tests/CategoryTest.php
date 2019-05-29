<?php

namespace MannikJ\Laravel\ModelConfigs\Tests;

use MannikJ\Laravel\ModelConfigs\Models\Config;
use MannikJ\Laravel\ModelConfigs\Models\Category;

class CategoryTest extends LaravelTest
{
    /** @test */
    public function test_type()
    {
        $configCategory = Category::create(['name' => 'Config Types']);
        $schemaCategory = Category::create(['name' => 'JSON Schema']);
        $schemaCategory->configs()->create([]);
        $priceCategory = $configCategory->children()->create(['name' => 'Price']);
        $currencyCategory = Category::create(['name' => 'Currencies']);
        $currencies = collect(['EUR', 'USD']);
        foreach ($currencies as $currency) {
            $currencyCategory->children()->create(['name' => $currency]);
        }
        $priceAttributeCategory = factory(Category::class)->create(['name' => 'Attribute']);
        $priceAttributes = collect(['Base', 'Priority', 'Complexity']);
        foreach ($priceAttributes as $priceAttribute) {
            $priceAttributeCategory->children()->create(['name' => $priceAttribute]);
        }
        $basePriceCategory = $priceAttributeCategory->children()->where("name->{}", 'Priority')->first();
        dd($basePriceCategory);
        $complexityCategory = $priceAttributeCategory->children()->where('name', 'Complexity')->first();
        $priorityCategory = $priceAttributeCategory->children()->where('name', 'Priority');
        $complexities = collect(['AA', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N']);
        foreach ($complexities as $complexity) {
            $complexityCategory->children()->create(['name' => $complexity]);
        }
        for ($i = 1; $i <= 24; $i++) {
            $priority->children()->create(['name' => $i]);
        }
        $category = factory(Category::class)->create(['name' => 'Base']);
        $config = factory(Config::class)->create(['name' => 'default']);

        $config->attachCategories(1);
        dd($config->categories);
        dd(\DB::getSchemaBuilder()->getColumnListing('configs'));
    }
}
