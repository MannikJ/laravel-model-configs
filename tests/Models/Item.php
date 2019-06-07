<?php

namespace MannikJ\Laravel\ModelConfigs\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use MannikJ\Laravel\ModelConfigs\Traits\HasConfigs;

class Item extends Model
{
    use HasConfigs;
}
