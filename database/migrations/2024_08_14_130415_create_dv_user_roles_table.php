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
        // Disable the foreign keys checkss to avoid conflicts during the creation of the table
        Schema::disableForeignKeyConstraints();

        // Create the dv_users_roles table
        Schema::create('dv_users_roles', function (Blueprint $table) {
            // Define the 'id' column as an auto-incrementing integer primary key
            $table->increments('id');

            $table->string('name')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamp('date_created')->useCurrent();
            $table->timestamp('last_changed')->useCurrent()->useCurrentOnUpdate();

            // // The primary key
            // $table->primary('id');
        });

        // Re-enable foreign key checks after the table creation
        Schema::enableForeignKeyConstraints();
    }


    /**
     * Drop the table - Reverse the migration
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dv_user_roles');
    }
};
