<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKechengTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profression', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profession_name',32)->notNull()->unique()->comment('专业的名称');
            $table->string('profession_desc')->notNull()->comment('专业的介绍');
            $table->string('cover_img',100)->notNull()->default('')->comment('封面图');
            $table->timestamps();
        });
        Schema::create('course',function(Blueprint $table){
            $table->increments('id');
            $table->string('profession_id')->notNull()->comment('所属专业的id');
            $table->integer('course_price')->notNull()->comment('课程的价格');
            $table->decimal('course_desc')->notNull()->comment('课程的介绍');
            $table->string('cover_img',100)->notNull()->default('')->comment('课程的封面图');
            $table->timestamps();
        });
        Schema::create('lesson',function(Blueprint $table){
            $table->increments('id');
            $table->string('lesson_name',64)->noyNull()->comment('课时的名称');
            $table->integer('course_id')->notNull()->comment('所属课程的id');
            $table->string('lesson_desc')->notNull()->comment('课时的介绍');
            $table->string('lesson_length')->notNull()->comment('课时的长度');
            $table->string('cover_img',100)->notNull()->comment('课时的封面图');
            $table->string('video_address',100)->notNull()->default('')->comment('课时的视频地址');
            $table->string('teacher_name',32)->notNull()->default('')->comment('讲师名称');
            $table->tinyInteger('status')->notNull()->default(1)->comment('课时状态');
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
        Schema::dropIfExists('profression');
    }
}
