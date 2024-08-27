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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('manager_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('company_name')->nullable();
            $table->string('legal_company_name')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->longText('address')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('number')->nullable();
            $table->string('website')->nullable();
            $table->string('verified')->nullable();
            $table->string('submenu_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('vendor_image')->nullable();
            $table->string('gst_image')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('pan_image')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('adhar_image')->nullable();
            $table->string('adhar_numbere')->nullable();
            $table->string('visiting_card')->nullable();
            $table->string('client_sign')->nullable();
            $table->string('video')->nullable();
            $table->string('location_lat')->nullable();
            $table->string('location_lang')->nullable();
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
        Schema::dropIfExists('vendors');
    }
};
