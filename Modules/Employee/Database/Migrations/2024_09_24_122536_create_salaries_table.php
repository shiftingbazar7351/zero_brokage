<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('department_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('house_rent_allowance')->nullable();
            $table->string('conveyance_allowance')->nullable();
            $table->string('other_allowance')->nullable();
            $table->string('personal_pay')->nullable();
            $table->string('food_allowance')->nullable();
            $table->string('medical_allowance')->nullable();
            $table->string('telephone_allowance')->nullable();
            $table->string('provident_fund')->nullable();
            $table->string('voluntary_provident_fund')->nullable();
            $table->string('professional_tax')->nullable();
            $table->string('personal_loan_principal')->nullable();
            $table->string('personal_loan_interest')->nullable();
            $table->string('food_relief')->nullable();
            $table->boolean('status')->default(1)->comment('0 => inactive, 1 => active');
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
        Schema::dropIfExists('salaries');
    }
}
