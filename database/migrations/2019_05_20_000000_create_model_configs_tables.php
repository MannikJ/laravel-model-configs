<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateModelConfigsTables extends Migration
{
    public function up()
    {
        Schema::create(config('model-configs.configs.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->schemalessAttributes('attributes');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(config('model-configs.configurables.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('configurable');
            $table->timestamps();
        });

        // Add class_name column to categories table
        Schema::table(config('rinvex.categories.tables.categories'), function (Blueprint $table) {
            \STI::column()->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('model-configs.config.table'));
        Schema::dropIfExists(config('model-configs.configurables.table'));
    }
}
