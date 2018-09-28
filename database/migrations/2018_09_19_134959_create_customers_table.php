<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->nullable()->comment('客户名称');
            $table->string('city', 24)->nullable()->comment('客户所在城市');
            $table->string('master', 24)->nullable()->comment('客户负责人');
            $table->string('contact', 64)->nullable()->comment('客户联系方式');
            $table->string('position', 64)->nullable()->comment('客户职务');
            $table->string('note')->nullable()->comment('客户备注');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
