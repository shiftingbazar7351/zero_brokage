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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->string('utr')->nullable();
            $table->string('screenshot')->nullable();
            $table->longText('reason')->nullable();
            $table->boolean('is_used')->default(0)->comment('0=>no, 1=>yes');
            $table->string('payment_time')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default(2)->comment('0=>rejected,1=>approved');
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
        Schema::dropIfExists('transactions');
    }
};
