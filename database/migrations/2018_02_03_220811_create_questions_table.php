<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('qs_name')->nullable()->comment(' câu hỏi ');
            $table->string('qs_suggestion')->nullable()->comment(' gợi ý câu hỏi ');
            $table->string('qs_answer1')->nullable()->comment('câu trả lời ');
            $table->string('qs_answer2')->nullable()->comment('câu trả lời ');
            $table->string('qs_answer3')->nullable()->comment('câu trả lời ');
            $table->string('qs_answer4')->nullable()->comment('câu trả lời ');
            $table->string('qs_answer_true')->nullable()->comment(' đáp án đúng ');
            $table->string('qs_thunbar')->nullable()->comment(' hình ảnh câu hỏi nếu có  ');
            $table->integer('qs_post_id')->nullable()->comment(' khoas ngoai id bai viet ');
            $table->integer('ps_category_post_id')->nullable()->comment(' khoas ngoai danh muc ');
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
        Schema::dropIfExists('questions');
    }
}
