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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('quantity')->nullable();

            $table->string('city_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->string('menu_id')->nullable();
            $table->string('submenu_id')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('status')->default(1)->comment('0=>inactive,1=>active');
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('packages');
    }
};
