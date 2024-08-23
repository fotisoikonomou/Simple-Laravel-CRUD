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
        // Disable the foreign keys checks to avoid conflicts during the creation of the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('dv_users_roles');
        // Create the dv_users_roles table
        Schema::create('dv_users_roles', function (Blueprint $table) {
            // Define the 'id' column as an auto-incrementing integer primary key
            $table->increments('id');

            $table->string('name')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->boolean('is_deleted')->default(false); // Soft delete flag
            $table->timestamp('date_created')->useCurrent();
            $table->timestamp('last_changed')->useCurrent()->useCurrentOnUpdate();

            
        });

        // Re-enable foreign key checks after the table creation
        Schema::enableForeignKeyConstraints();
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
