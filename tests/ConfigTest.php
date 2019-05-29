<?php

namespace MannikJ\Laravel\ModelConfigs\Tests;

use MannikJ\Laravel\ModelConfigs\Models\Config;

class ConfigTest extends LaravelTest
{
    /** @test */
    public function test_type()
    {
        $config = factory(Config::class)
            ->create();
        $type = $config
            ->categories()
            ->create(['name' => ['TEST' => 'asd']]);
        dd($type);
        $config->configurables()->get();
    }
}
