<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use MannikJ\Laravel\SingleTableInheritance\Facades\STI;

class CreateModelConfigsTables extends Migration
{
    public function up()
    {
        \DB::transaction(function () {
            Schema::create(config('model-configs.configs.table'), function (Blueprint $table) {
                $table->increments('id');
                // $table->bigInteger('category_id')->nullable();
                // $table->foreign('category_id')->references('id')->on('categories');
                $table->string('name');
                $table->schemalessAttributes('data');
                $table->timestamps();
                $table->softDeletes();
            });

            Schema::create(config('model-configs.configurables.table'), function (Blueprint $table) {
                $table->increments('id');
                $table->bigInteger('config_id');
                $table->foreign('id')->references('id')->on('configs');
                $table->morphs('configurable');
                $table->timestamps();
            });

            if (Schema::hasTable(config('rinvex.categories.tables.categories'))) {
                Schema::table(config('rinvex.categories.tables.categories'), function (Blueprint $table) {
                    $table->sti()->nullable()->after('description');
                    $table->schemalessAttributes('meta');
                });
            } else {
                throw new Exception('Make sure the rinvex/laravel-categories tables are created before!');
            }
        });
    }

    public function down()
    {
        \DB::transaction(function () {
            Schema::dropIfExists(config('model-configs.config.table'));
            Schema::dropIfExists(config('model-configs.configurables.table'));
            Schema::table(config('rinvex.categories.tables.categories'), function (Blueprint $table) {
                $table->dropColumn(config('single-table-inheritance.column_name', 'type'));
            });
        });
    }
}
