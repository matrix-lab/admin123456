<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMottoesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mottoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email')->comment('用户邮箱');
            $table->integer('user_id')->comment('用户ID');
            $table->string('user_alias')->comment('用户别名');
            $table->integer('star')->default(1)->comment('点赞数量');
            $table->text('content')->comment('推荐内容');
            $table->boolean('status')->default(0)->comment('点赞数量');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('mottoes');
    }
}
