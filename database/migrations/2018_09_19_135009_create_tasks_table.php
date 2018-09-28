<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->nullable()->comment('所属团队');
            $table->string('team_alias')->nullable()->comment('所属团队负责人');
            $table->string('product')->nullable()->comment('所属产品线');
            $table->string('come_from')->nullable()->comment('发起客户');
            $table->string('category')->nullable()->comment('所属分类');
            $table->string('content')->nullable()->comment('任务');
            $table->string('type')->nullable()->comment('工程师类型');
            $table->integer('uier_id')->nullable()->comment('前端工程师ID');
            $table->string('uier_alias')->nullable()->comment('前端工程师姓名');
            $table->string('uier_start_at')->nullable()->comment('前端工程师开始时间');
            $table->string('uier_end_at')->nullable()->comment('前端工程师结束时间');
            $table->integer('phper_id')->nullable()->comment('PHP工程师ID');
            $table->string('phper_alias')->nullable()->comment('PHP工程师姓名');
            $table->string('phper_start_at')->nullable()->comment('PHP工程师开始时间');
            $table->string('phper_end_at')->nullable()->comment('PHP工程师结束时间');
            $table->integer('ioser_id')->nullable()->comment('IOS工程师ID');
            $table->string('ioser_alias')->nullable()->comment('IOS工程师姓名');
            $table->string('ioser_start_at')->nullable()->comment('IOS工程师开始时间');
            $table->string('ioser_end_at')->nullable()->comment('IOS工程师结束时间');
            $table->integer('androider_id')->nullable()->comment('Android工程师ID');
            $table->string('androider_alias')->nullable()->comment('Android工程师姓名');
            $table->string('androider_start_at')->nullable()->comment('Android工程师开始时间');
            $table->string('androider_end_at')->nullable()->comment('Android工程师结束时间');
            $table->integer('tester_id')->nullable()->comment('测试工程师ID');
            $table->string('tester_alias')->nullable()->comment('测试工程师姓名');
            $table->string('tester_start_at')->nullable()->comment('测试工程师开始时间');
            $table->string('tester_end_at')->nullable()->comment('测试工程师结束时间');
            $table->integer('devopser_id')->nullable()->comment('运维工程师ID');
            $table->string('devopser_alias')->nullable()->comment('运维工程师姓名');
            $table->string('devopser_start_at')->nullable()->comment('运维工程师开始时间');
            $table->string('devopser_end_at')->nullable()->comment('运维工程师结束时间');
            $table->string('published_at')->nullable()->comment('上线时间');
            $table->string('progress', 24)->nullable()->comment('任务进度阶段, 排版中，已排版，开发中，已开发，测试中，已测试，待发布，已发布');
            $table->string('status', 24)->nullable()->comment('任务是否完成，未完成，已完成');
            $table->string('note')->nullable()->comment('备注');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
