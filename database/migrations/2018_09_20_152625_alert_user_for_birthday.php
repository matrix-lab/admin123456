<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertUserForBirthday extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('alias')->nullable();
            $table->integer('team_id');
            $table->string('team_alias');
            $table->string('mobile')->nullable();
            $table->date('birthday')->nullable();
        });

        User::create([
            'name'       => 'Hui Lee',
            'alias'      => '骑着毛驴儿追宝马',
            'team_id'    => 1,
            'team_alias' => '研发中心',
            'mobile'     => '18937166730',
            'birthday'   => '1987-09-20',
            'email'      => 'admin@fangxin.com',
            'password'   => Hash::make('123456'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('alias');
            $table->dropColumn('team_id');
            $table->dropColumn('team_alias');
            $table->dropColumn('mobile');
            $table->dropColumn('birthday');
        });
    }
}
