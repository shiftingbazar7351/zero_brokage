<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_products', function (Blueprint $table) {
            $table->id();
            $table->string('hoffice_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->longText('address')->nullable();
            $table->boolean('status')->default(1)->comment('0=>inactive,1=>active');
            $table->string('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_products');
    }
}
