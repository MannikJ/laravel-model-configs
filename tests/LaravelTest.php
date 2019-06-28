<?php

namespace MannikJ\Laravel\ModelConfigs\Tests;

use Orchestra\Testbench\TestCase;
use Rinvex\Categories\Providers\CategoriesServiceProvider;
use MannikJ\Laravel\ModelConfigs\ModelConfigsServiceProvider;
use Spatie\SchemalessAttributes\SchemalessAttributesServiceProvider;
use MannikJ\Laravel\SingleTableInheritance\SingleTableInheritanceServiceProvider;
use Mpociot\Versionable\Providers\ServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MannikJ\Laravel\ModelConfigs\ModelConfigsFacades;
use MannikJ\Laravel\ModelConfigs\ModelConfigsFacade;

class LaravelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__ . '/database/factories');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadLaravelMigrations();
    }


    protected function getPackageProviders($app)
    {
        return [
            SingleTableInheritanceServiceProvider::class,
            ModelConfigsServiceProvider::class,
            CategoriesServiceProvider::class,
            SchemalessAttributesServiceProvider::class,
            ServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ModelConfigs' => ModelConfigsFacade::class
        ];
    }

    /** @test */
    public function app_context_exists() {
        $this->assertTrue(app()->environment('testing'));
    }
}
