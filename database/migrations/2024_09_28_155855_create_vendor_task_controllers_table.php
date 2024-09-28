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
        Schema::create('vendor_task_controllers', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_id')->nullable();
            $table->string('comments')->nullable();
            $table->string('note')->nullable();
            $table->string('next_followup_date_time_am_pm')->nullable();
            $table->string('tags')->nullable();
            $table->string('call_record')->nullable();
            $table->string('call_history_img')->nullable();
            $table->string('client_type')->nullable();
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
        Schema::dropIfExists('vendor_task_controllers');
    }
};
