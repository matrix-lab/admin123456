<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('issue')->nullable()->comment('修复问题');
            $table->string('branch')->nullable()->comment('发布分支');
            $table->string('customer_ids')->nullable()->comment('发布客户');
            $table->string('customer_alias')->nullable()->comment('发布客户别名');
            $table->string('reason')->nullable()->comment('发布原因');
            $table->timestamp('appointed_at')->nullable()->comment('发布时间');

            $table->integer('applyer_id')->nullable()->comment('申请人ID');
            $table->string('applyer_alias')->nullable()->comment('申请人姓名');
            $table->timestamp('applyed_at')->nullable()->comment('申请时间');

            $table->integer('approver_id')->nullable()->comment('审批人ID');
            $table->string('approver_alias')->nullable()->comment('审批人姓名');
            $table->timestamp('approved_at')->nullable()->comment('审批时间');

            $table->integer('publisher_id')->nullable()->comment('发布人ID');
            $table->string('publisher_alias')->nullable()->comment('发布人姓名');
            $table->timestamp('published_at')->nullable()->comment('发布时间');

            $table->string('progress', 24)->nullable()->comment('发布进度阶段:待审核，待发布，已发布');
            $table->string('status', 24)->nullable()->comment('发布是否完成，未完成，已完成');
            $table->string('note')->nullable()->comment('备注');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('versions');
    }
}
