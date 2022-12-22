<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string("po_title")->nullable();
            $table->string("po_slug")->nullable();
            $table->string("po_keywords")->nullable();
            $table->string("po_description")->nullable();
            $table->string("po_tags")->nullable();
            $table->tinyInteger("po_hot")->nullable()->default(0);
            $table->integer("po_category_post_id")->default(0)->nullable()->unsigned();
            $table->integer("po_active")->default(0)->nullable();
            $table->integer("po_admin_id")->nullable()->unsigned();
            $table->string("po_thunbar")->nullable();
            $table->longText("po_content")->nullable();
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
        Schema::dropIfExists('posts');
    }
}
