<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            $table->string('std_name',20)->notNull()->default('')->comment('学生姓名');
            $table->string('std_password',50)->notNull()->default('')->comment('密码');
            $table->string('std_email',50)->notNull()->default('')->comment('邮箱');
            $table->string('std_birthday',30)->notNull()->default('')->comment('出生年月');
            $table->char('std_phone',11)->notNull()->default('')->comment('手机号');
            $table->enum('std_sex',['男','女'])->notNull()->default('男')->comment('性别');
            $table->string('std_pic',50)->notNull()->default('')->comment('图片');
            $table->string('std_desc',50)->notNull()->default('')->comment('介绍');
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
        Schema::dropIfExists('student');
    }
}
