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
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->string('total_price')->nullable();
            $table->string('discount')->nullable();
            $table->string('discounted_price')->nullable();
            $table->string('category_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->string('menu_id')->nullable();
            $table->string('city_id')->nullable();
            $table->boolean('status')->default(1)->comment('0=>inactive,1=>active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_menus');
    }
};
