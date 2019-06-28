<?php

declare (strict_types = 1);

use MannikJ\Laravel\ModelConfigs\Models\Categories\Category;

return [
    'autoload_migrations' => true,
    // Categories Database Tables
    'tables' => [
        'categories' => 'categories',
        'categorizables' => 'categorizables',
    ],

    // Categories Model
    'models' => [
        'category' => Category::class,
    ],

];
