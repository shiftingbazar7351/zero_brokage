<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->unsignedBigInteger('enquiries_id');  // Foreign key for enquiry
            $table->string('address1');  // Address line 1
            $table->string('address2')->nullable();  // Address line 2 (optional)
            $table->timestamps();  // Created at and updated at timestamps

            // Foreign key constraint for enquiry_id (optional)
            // $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
