<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsPostCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('posts') && Schema::hasTable('admins')) {
            Schema::table('posts', function(Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->foreign('po_admin_id')->references('id')->on('admins')->onDelete('cascade');
            });
        }
         
    }
  

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //$table->dropForeign('po_admin_id');
    }
}
