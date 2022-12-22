<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try{
            Schema::create('exams', function (Blueprint $table) {
                $table->increments('id');
                $table->string('e_code')->nullable();
                $table->tinyInteger('e_level')->default(0)->nullable();
                $table->integer('e_user_id');
                $table->timestamps();
            });
        }catch (\Exception $e)
        {
            \Log::info(" Error Create Exams " . $e->getMessage());
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return voi
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
