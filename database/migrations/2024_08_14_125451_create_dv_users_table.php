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

        // dv_users table
        Schema::create('dv_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamp('date_created')->useCurrent();
            $table->timestamp('last_changed')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedBigInteger('wp_users_ID');
            
           
            
            // Here I define the  foreign key and it's constraint base don the shema
            $table->foreign('wp_users_ID')
                  ->references('ID')
                  ->on('wp_users')
                  ->onDelete('NO ACTION')
                  ->onUpdate('NO ACTION');

            // Add an index for the wp_users_ID column with the name of index fk_dv_users_wp_users1_idx to speed the queries
            $table->index('wp_users_ID', 'fk_dv_users_wp_users1_idx');

           
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
        Schema::dropIfExists('dv_users');
    }
};
