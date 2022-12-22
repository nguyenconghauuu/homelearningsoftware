<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name');
             $table->string('email')->unique();
             $table->string('password');
             $table->tinyInteger('age')->nullable();
             $table->string('phone')->nullable();
             $table->string('facebook')->nullable();
             $table->string('youtube')->nullable();
             $table->string('avatar')->nullable();
             $table->string('address')->nullable();
             $table->string('descriptions')->nullable();
             $table->date('birthday')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
