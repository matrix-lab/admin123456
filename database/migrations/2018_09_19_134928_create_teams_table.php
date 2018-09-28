<?php

use App\Models\Team;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->default('开发部')->comment('团队负责人');
            $table->string('alias', 128)->nullable()->comment('团队别名');
            $table->string('note')->nullable()->comment('团队备注');
            $table->timestamps();
        });

        Team::create([
            'name'  => '研发中心',
            'alias' => '房信网研发中心',
            'note'  => '北京房信网络科技有限责任公司(郑州研发中心)',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
