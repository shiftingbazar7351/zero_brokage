<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('india_service_descriptions', function (Blueprint $table) {
            $table->string('category_id')->nullable();
            $table->string('sub_category_id')->nullable();
            $table->string('menu_id')->nullable();
            $table->string('submenu_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('india_service_descriptions', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->dropColumn('sub_category_id');
            $table->dropColumn('menu_id');
            $table->dropColumn('submenu_id');
        });
    }
};
