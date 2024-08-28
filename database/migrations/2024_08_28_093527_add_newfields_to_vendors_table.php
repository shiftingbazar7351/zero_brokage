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
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('vendor_name')->nullable();
            $table->string('menu_id')->nullable();
            $table->string('review_count')->nullable();
            $table->boolean('status')->default(1)->comment('0=>inactive,1=>active');
            $table->integer('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn('vendor_name');
            $table->dropColumn('menu_id');
            $table->dropColumn('review_count');
            $table->dropColumn('status');
            $table->dropColumn('created_by');
        });
    }
};
