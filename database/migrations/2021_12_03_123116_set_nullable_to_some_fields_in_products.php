<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNullableToSomeFieldsInProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('thumbnail_url')->nullable()->change();
            $table->string('demo_url')->nullable()->change();
            $table->string('source_url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('thumbnail_url')->change()->nullable(false);
            $table->string('demo_url')->change()->nullable(false);
            $table->string('source_url')->change()->nullable(false);
        });
    }
}
