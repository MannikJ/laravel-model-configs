<?php

namespace MannikJ\Laravel\ModelConfigs\Tests;

use Orchestra\Testbench\TestCase;
use Rinvex\Categories\Providers\CategoriesServiceProvider;
use MannikJ\Laravel\ModelConfigs\ModelConfigsServiceProvider;
use Spatie\SchemalessAttributes\SchemalessAttributesServiceProvider;
use MannikJ\Laravel\SingleTableInheritance\SingleTableInheritanceServiceProvider;
use Mpociot\Versionable\Providers\ServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LaravelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__ . '/factories');
        $this->loadLaravelMigrations();
    }


    protected function getPackageProviders($app)
    {
        return [
            ModelConfigsServiceProvider::class,
            CategoriesServiceProvider::class,
            SchemalessAttributesServiceProvider::class,
            ServiceProvider::class,
            SingleTableInheritanceServiceProvider::class,
        ];
    }
}
