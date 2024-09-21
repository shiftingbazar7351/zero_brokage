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
        Schema::table('users', function (Blueprint $table) {
            $table->string('employee_code')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('dob')->nullable(); // Changed to 'date' type
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
            $table->enum('experience_type', ['fresher', 'experienced'])->default('fresher');
            $table->string('high_school_certificate')->nullable();
            $table->string('intermediate_certificate')->nullable();
            $table->string('graduation_certificate')->nullable();
            $table->string('experience_letter')->nullable();
            $table->string('relieving_letter')->nullable();
            $table->string('offer_letter')->nullable();
            $table->string('salary_slip')->nullable(); // Make sure there is no trailing space here
            $table->string('bank_statement')->nullable();
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('character_certificate')->nullable();
            $table->string('medical_certificate')->nullable();
            $table->string('previous_ref_name')->nullable();
            $table->string('previous_ref_email')->nullable();
            $table->string('previous_ref_number')->nullable();
            $table->string('previous_ref_designation')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'employee_code',
                'fname',
                'lname',
                'gender',
                'dob',
                'country',
                'number',
                'joining_date',
                'company',
                'no_of_experience',
                'department',
                'designation',
                'office_shift',
                'reporting_head',
                'hr_head',
                'hr_executive',
                'official_mobile',
                'official_email',
                'experience_type',
                'high_school_certificate',
                'intermediate_certificate',
                'graduation_certificate',
                'experience_letter',
                'relieving_letter',
                'offer_letter',
                'salary_slip',
                'bank_statement',
                'current_address',
                'permanent_address',
                'character_certificate',
                'medical_certificate',
                'previous_ref_name',
                'previous_ref_email',
                'previous_ref_number',
                'previous_ref_designation',
            ]);
        });
    }
};
