<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',32)->notNull()->unique()->comment('管理员名称');
            $table->string('password')->notNull()->comment('管理员密码');
            $table->string('city',12)->notNull()->comment('所在城市');
            $table->char('phone',11)->notNull()->comment('电话号码');
            $table->string('email',64)->notNull()->comment('邮箱');
            $table->string('address',64)->notNull()->comment('地址');
            $table->string('company',64)->notNull()->comment('公司');
            $table->string('face',100)->notNull()->comment('头像');
            $table->string('intro')->notNull()->comment('个人宣言');
            $table->integer('role_id')->notNull()->comment('所属角色');
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
        Schema::dropIfExists('manager');
    }
}
