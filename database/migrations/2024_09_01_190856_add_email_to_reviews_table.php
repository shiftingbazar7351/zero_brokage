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
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->unsignedTinyInteger('rating')->nullable(); // Assuming rating is an integer between 1 and 5
            $table->unsignedTinyInteger('type')->nullable()->comment('1 => frontend, 2 => backend'); // Assuming type is an integer
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('phone_number');
            $table->dropColumn('rating');
            $table->dropColumn('type');
        });
    }
};
