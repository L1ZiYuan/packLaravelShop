<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('auth_name','64')->default('0')->comment('权限名称');
            $table->string('auth_pid','20')->default('0')->comment('分类权限ID，第一级为 0');
            $table->string('auth_c','60')->default('0')->comment('权限对应的控制器名称');
            $table->string('auth_a','60')->default('0')->comment('权限对应的控制器方法名称');
            $table->string('auth_path','60')->default('0')->comment('控制器-方法 controler-method');
            $table->string('auth_route','60')->default('0')->comment('路由的别名');
            $table->string('auth_sort',10)->default('0')->comment('权限级别，第一级权限为1');
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
        Schema::dropIfExists('auth');
    }
}
