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

        // found the shema from google...i don't know if it is ok
        Schema::create('wp_users', function (Blueprint $table) {
            $table->bigIncrements('ID'); // Primary key
            $table->string('user_login')->unique();
            $table->string('user_pass');
            $table->string('user_email')->unique();
            $table->string('user_nicename')->nullable();
            $table->string('user_url')->nullable();
            $table->timestamp('user_registered')->useCurrent();
            $table->string('user_activation_key')->nullable();
            $table->integer('user_status')->default(0);
            $table->string('display_name')->nullable();
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
        Schema::dropIfExists('wp_users');
    }
    
};
