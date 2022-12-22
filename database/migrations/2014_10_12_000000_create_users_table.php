<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('u_name');
            $table->string('u_email')->unique();
            $table->string('u_password')->nullable();
            $table->char('u_phone')->nullable();
            $table->tinyInteger('u_age')->nullable()->default(0);
            $table->string('u_avatar')->nullable();
            $table->string('u_address')->nullable();
            $table->tinyInteger('u_online')->nullable()->default(0);
            $table->tinyInteger('u_active')->nullable()->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
