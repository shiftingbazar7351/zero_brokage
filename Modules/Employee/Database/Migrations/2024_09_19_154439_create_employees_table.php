<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('dob')->nullable(); // Changed to 'date' type
            $table->string('email')->nullable()->unique(); // Added unique constraint for email
            $table->string('role')->nullable();
            $table->string('password'); // Password should not be nullable
            $table->string('country')->nullable();
            $table->string('number')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('company')->nullable();
            $table->string('no_of_experience')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('office_shift')->nullable();
            $table->string('reporting_head')->nullable();
            $table->string('hr_head')->nullable();
            $table->string('hr_executive')->nullable();
            $table->string('official_mobile')->nullable();
            $table->string('official_email')->nullable()->unique();
            $table->string('high_school_certificate')->nullable();
            $table->string('intermediate_certificate')->nullable();
            $table->string('graduation_certificate')->nullable();
            $table->string('experience_letter')->nullable();
            $table->string('relieving_letter')->nullable();
            $table->string('offer_letter')->nullable();
            $table->string('salary_slip ')->nullable();
            $table->string('bank_statement')->nullable();
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('character_certificate')->nullable();
            $table->string('medical_certificate')->nullable();
            $table->string('previous_ref_name')->nullable();
            $table->string('previous_ref_email')->nullable();
            $table->string('previous_ref_number')->nullable();
            $table->string('previous_ref_designation')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
