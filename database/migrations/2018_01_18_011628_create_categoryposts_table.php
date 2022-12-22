<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorypostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoryposts', function (Blueprint $table) {
            $table->increments('id');
            $table->string("cpo_name",50)->unique();
            $table->string("cpo_slug",50)->nullable();
            $table->tinyInteger("cpo_sort")->default(0)->nullable();
            $table->tinyInteger("cpo_type")->default(0)->nullable();
            $table->tinyInteger("cpo_hot")->nullable()->default(0);
            $table->integer("cpo_count_post")->default(0)->nullable();
            $table->integer("cpo_parent_id")->default(0)->nullable();
            $table->longText("cpo_content")->nullable();
            $table->integer("cpo_active")->default(0)->nullable();
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
        Schema::dropIfExists('categoryposts');
    }
}
