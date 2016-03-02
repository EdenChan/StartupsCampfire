<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('gender')->default(2);
            $table->string('avatar')->nullable();
            $table->string('description')->nullable();
            $table->text('education')->nullable();
            $table->text('occupation')->nullable();
            $table->text('experience')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('qq')->nullable();
            $table->string('wechat')->nullable();
            $table->string('weibo')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
    }
}
