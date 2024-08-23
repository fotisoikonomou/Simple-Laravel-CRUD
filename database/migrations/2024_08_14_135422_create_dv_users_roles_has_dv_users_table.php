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

        // Create the dv_users_roles_has_dv_users table
        Schema::create('dv_users_roles_has_dv_users', function (Blueprint $table) {
            // Foreign keys 
            $table->unsignedInteger('dv_users_roles_id');
            $table->unsignedInteger('dv_users_id');

            // Define the 2 primary keys (composite primary key)
            $table->primary(['dv_users_roles_id', 'dv_users_id']);

            // Indexes for foreign keys
            $table->index('dv_users_id', 'fk_dv_users_roles_has_dv_users_dv_users1_idx');
            $table->index('dv_users_roles_id', 'fk_dv_users_roles_has_dv_users_dv_users_roles1_idx');

            // Define the foreign key constraints
            $table->foreign('dv_users_roles_id', 'fk_dv_users_roles_has_dv_users_dv_users_roles1')// create index
                  ->references('id') // references id column
                  ->on('dv_users_roles') // of this table
                  ->onDelete('CASCADE') // Automatically delete when parent is deleted - I changed it later
                  ->onUpdate('NO ACTION');  //no update if it is used

            $table->foreign('dv_users_id', 'fk_dv_users_roles_has_dv_users_dv_users1') // create index
                  ->references('id') // references id column
                  ->on('dv_users') // of this table
                  ->onDelete('CASCADE') // Automatically delete when parent is deleted - I changed it later
                  ->onUpdate('NO ACTION'); //no update if it is used
        });

        // Re-enable foreign key checks after the table is created
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Drop the table - Reverse the migration
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('create_dv_users_roles_has_dv_users_tables');
    }
};
