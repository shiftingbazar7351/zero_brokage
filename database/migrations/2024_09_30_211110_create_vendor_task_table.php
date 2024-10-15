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
        Schema::create('vendor_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->onDelete('set null');
            $table->string('comments')->nullable();
            $table->string('note')->nullable();
            $table->string('next_followup_date_time')->nullable();
            $table->string('tags')->nullable();
            $table->string('call_record')->nullable();
            $table->string('call_history_img')->nullable();
            $table->string('client_type')->nullable();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->enum('status', ['pending', 'in_progress', 'cancelled', 'on_hold', 'completed'])->default('pending');
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
        Schema::dropIfExists('vendor_tasks');
    }
};
