<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTestTables extends Migration
{
    public function up()
    {
        Schema::create('items', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }
}
