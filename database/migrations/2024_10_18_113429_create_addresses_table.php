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
            $table->id();
            $table->unsignedBigInteger('enquiries_id');

            $table->enum('type', ['home', 'work']);

            $table->string('house_number', 50)->nullable();
            $table->string('building_name', 100)->nullable();
            $table->string('road_name', 100)->nullable();
            $table->string('area_colony', 100)->nullable();


            $table->string('address1', 191);
            $table->string('address2', 191)->nullable();
            $table->string('landmark', 191)->nullable();
            $table->string('district', 100);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('country', 100);
            $table->string('pincode', 20);

            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Additional details
            $table->string('phone_number', 20)->nullable(); // Contact phone number (optional)
            $table->text('address_note')->nullable(); // Any additional address notes (optional)

            // Audit fields (created by and updated by)
            $table->unsignedBigInteger('created_by')->nullable(); // User who created the record
            $table->unsignedBigInteger('updated_by')->nullable(); // User who last updated the record

            // Timestamps for created_at and updated_at
            $table->timestamps();

            // Foreign key constraint for enquiries_id
            $table->foreign('enquiries_id')->references('id')->on('enquiries')->onDelete('cascade');

            // Foreign key constraints for created_by and updated_by (referencing users table)
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
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
