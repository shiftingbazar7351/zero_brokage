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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('category_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->string('menu_id')->nullable();
            $table->string('submenu_id')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('price')->nullable();
            $table->string('hsn')->nullable();
            $table->string('product_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('total_ammount')->nullable();
            $table->string('gst')->nullable();
            $table->string('grand_total')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
