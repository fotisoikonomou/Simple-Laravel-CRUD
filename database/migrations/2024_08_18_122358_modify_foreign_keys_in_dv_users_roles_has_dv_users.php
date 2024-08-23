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
        Schema::table('dv_users_roles_has_dv_users', function (Blueprint $table) {
            
            // Drop existing foreign keys
            $table->dropForeign('fk_dv_users_roles_has_dv_users_dv_users1');
            $table->dropForeign('fk_dv_users_roles_has_dv_users_dv_users_roles1');
    
           
            $table->foreign('dv_users_roles_id', 'fk_dv_users_roles_has_dv_users_dv_users_roles1')
                  ->references('id')
                  ->on('dv_users_roles')
                  ->onDelete('CASCADE')
                  ->onUpdate('NO ACTION');
    
            $table->foreign('dv_users_id', 'fk_dv_users_roles_has_dv_users_dv_users1')
                  ->references('id')
                  ->on('dv_users')
                  ->onDelete('CASCADE')
                  ->onUpdate('NO ACTION');
        });
    }
    
    public function down()
    {
        Schema::table('dv_users_roles_has_dv_users', function (Blueprint $table) {
           
            // Restore  original foreign keys
            $table->dropForeign('fk_dv_users_roles_has_dv_users_dv_users_roles1');
            $table->dropForeign('fk_dv_users_roles_has_dv_users_dv_users1');
    
            $table->foreign('dv_users_roles_id', 'fk_dv_users_roles_has_dv_users_dv_users_roles1')
                  ->references('id')
                  ->on('dv_users_roles')
                  ->onDelete('NO ACTION') // ondelete is no action in order to be able to individually delete a user when he has an assigned role otherwise it will log sql error
                  ->onUpdate('NO ACTION');
    
            $table->foreign('dv_users_id', 'fk_dv_users_roles_has_dv_users_dv_users1')
                  ->references('id')
                  ->on('dv_users')
                  ->onDelete('NO ACTION') // ondelete is no action in order to be able to individually delete a user when he has an assigned role otherwise it will log sql error
                  ->onUpdate('NO ACTION');
        });
    }

};
